<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function showSignupForm()
    {
        return view('profile.admin.admin-signup');
    }

    public function store(Request $request)
{
    $request->validate([
        'employeeid' => 'required|string|max:255',
        'firstname' => 'required|string|max:255',
        'middlename' => 'required|string|max:255',
        'lastname' => 'required|string|max:255',
        'workstation' => 'required|string|max:255',
        'contactnumber' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|confirmed|min:8',
    ]);

    $user = new User();
    $user->employeeid = $request->input('employeeid');
    $user->firstname = $request->input('firstname');
    $user->middlename = $request->input('middlename');
    $user->lastname = $request->input('lastname');
    $user->workstation = $request->input('workstation');
    $user->contactnumber = $request->input('contactnumber');
    $user->address = $request->input('address');
    $user->email = $request->input('email');
    $user->password = bcrypt($request->input('password'));
    $user->role = $request->input('role'); // Ensure this field is handled
    $user->save();

    return redirect()->route('manage-account')->with('success', 'Account created successfully.');
}
}


