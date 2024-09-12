<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class AdminProfileController extends Controller
{
    /**
     * Display the admin's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.admin.admin-profile', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the admin's personal details.
     */
    public function updatePersonal(Request $request): RedirectResponse
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'middlename' => 'nullable|string|max:255',
            'lastname' => 'required|string|max:255',
            'contactnumber' => 'required|string|max:20',
            'address' => 'nullable|string|max:255',
            'birthday' => 'nullable|date',
        ]);

        $user = Auth::user();
        $user->firstname = $request->firstname;
        $user->middlename = $request->middlename ?? $user->middlename;
        $user->lastname = $request->lastname;
        $user->contactnumber = $request->contactnumber;
        $user->address = $request->address ?? $user->address;
        $user->birthday = $request->birthday ?? $user->birthday;
        $user->save();

        return redirect()->route('admin.profile.edit')->with('status', 'Personal details updated successfully.');
    }

    /**
     * Update the admin's work information.
     */
    public function updateWorkInfo(Request $request): RedirectResponse
    {
        $request->validate([
            'workstation' => 'required|string|max:255',
            'shift_time' => 'required|string|max:255',
        ]);

        $user = Auth::user();
        $user->workstation = $request->input('workstation');
        $user->shift_time = $request->input('shift_time');
        $user->save();

        return redirect()->route('admin.profile.edit')->with('status', 'Work information updated successfully.');
    }

    /**
     * Update the admin's password.
     */
    public function updatePassword(Request $request)
    {
        // Validate the input fields
        $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        // Update the user's password
        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->save();

        // Optionally, you can redirect back with a success message
        return redirect()->route('admin.profile.edit')->with('status', 'Password updated successfully.');
    }

    /**
     * Delete the admin's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
