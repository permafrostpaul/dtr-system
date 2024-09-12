<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */


    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'employeeid' => 'required|string|max:255|unique:users',
            'firstname' => 'required|string|max:255',
            'middlename' => 'nullable|string|max:255',
            'lastname' => 'required|string|max:255',
            'workstation' => 'required|string|max:255',
            'contactnumber' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'employeeid' => $validatedData['employeeid'],
            'firstname' => $validatedData['firstname'],
            'middlename' => $validatedData['middlename'] ?? null, // Handle nullable field
            'lastname' => $validatedData['lastname'],
            'workstation' => $validatedData['workstation'],
            'contactnumber' => $validatedData['contactnumber'],
            'address' => $validatedData['address'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'status' => 'pending', // Set status to 'pending'
        ]);

        
        event(new Registered($user));

        return redirect()->route('login')->with('status', 'Account created successfully. Please wait for activation.');
    }
}
