<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\AccountActivated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Mail;


class ManageAccountController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $admins = User::where('role', 'admin')->get();
        $pendingUsers = User::where('status', 'pending')->get();

        // Fetch all users with pending status

        // Pass the data to the view
        return view('profile.admin.manage-account', compact('admins', 'pendingUsers', 'user'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'role' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'middlename' => 'nullable|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'contact_number' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'work_station' => 'required|string|max:255',
        ]);

        $user = User::create([
            'role' => $validatedData['role'],
            'firstname' => $validatedData['firstname'],
            'middlename' => $validatedData['middlename'],
            'lastname' => $validatedData['lastname'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'contact_number' => $validatedData['contact_number'],
            'address' => $validatedData['address'],
            'work_station' => $validatedData['work_station'],
        ]);

        return redirect()->route('profile.admin.manage-account')->with('status', 'Admin account created successfully!');
    }
    public function showPendingAccounts()
    {
        $user = Auth::user();
        $admins = User::where('role', 'admin')->get();
        $pendingUsers = User::where('status', 'pending')->get();

        return view('profile.admin.manage-account', compact('admins', 'pendingUsers', 'users'));
    }

    public function activateUser($id)
    {
        $user = User::find($id);

        if ($user && $user->status === 'pending') {
            $user->status = 'active';
            $user->save();

            $admins = User::where('role', 'admin')->get();
            $pendingUsers = User::where('status', 'pending')->get();

            return view('profile.admin.manage-account', compact('admins', 'pendingUsers', 'user'))
                ->with('status', 'Activated Successfully');
        }

        return redirect()->back()->with('status', 'Activated Successfully');
    }



    public function deactivateUser($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->status = 'pending';
            $user->save();

            $user = Auth::user();
            $admins = User::where('role', 'admin')->get();
            $pendingUsers = User::where('status', 'pending')->get();
            // Fetch all users with pending status

            // Pass the data to the view
            return view('profile.admin.manage-account', compact('admins', 'pendingUsers', 'user'));
        }

        return redirect()->back()->with('status', 'User deactivated successfully.');
    }
    public function searchAdmins(Request $request)
    {
        $query = $request->input('query');
        $results = User::where('role', 'admin')
            ->where(function ($queryBuilder) use ($query) {
                $queryBuilder->where('firstname', 'like', "%$query%")
                    ->orWhere('lastname', 'like', "%$query%")
                    ->orWhere('email', 'like', "%$query%");
            })
            ->get();

        return view('profile.admin.manage-account', [
            'admins' => $results,
            'pendingUsers' => User::where('status', 'pending')->get(), // Keep pending users list intact
            'query' => $query,
        ]);
    }

    public function searchPending(Request $request)
    {
        $query = $request->input('query');
        $results = User::where('status', 'pending')
            ->where(function ($queryBuilder) use ($query) {
                $queryBuilder->where('firstname', 'like', "%$query%")
                    ->orWhere('lastname', 'like', "%$query%")
                    ->orWhere('email', 'like', "%$query%");
            })
            ->get();

        return view('profile.admin.manage-account', [
            'admins' => User::where('role', 'admin')->get(), // Keep admin accounts list intact
            'pendingUsers' => $results,
            'query' => $query,
        ]);
    }
}
