<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.profile', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->update($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'Profile successfully updated');
    }

    /**
     * Update the user's profile information specifically for personal details.
     */
    public function updateProfile(Request $request): RedirectResponse
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

        return redirect()->route('profile.edit')->with('status', 'Profile updated successfully.');
    }

    /**
     * Update the user's work information.
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

        return redirect()->route('profile.edit')->with('status', 'Work information updated successfully.');
    }

    /**
     * Delete the user's account.
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
        return redirect()->route('profile.edit')->with('status', 'Password updated successfully.');
    }
}
