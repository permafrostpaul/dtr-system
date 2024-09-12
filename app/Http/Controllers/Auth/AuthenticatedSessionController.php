<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $credentials = $request->only('email', 'password');

        // Check if the user exists and their status
        $user = Auth::getProvider()->retrieveByCredentials($credentials);

        if ($user && $user->status === 'pending') {
            // If the user's status is pending, deny login and inform the user
            throw ValidationException::withMessages([
                'email' => 'Your account is still pending. Please wait for confirmation.',
            ]);
        }

        if ($user && $user->status !== 'active') {
            // If the user's status is not active, deny login
            throw ValidationException::withMessages([
                'email' => 'Your account is not active.',
            ]);
        }

        // Attempt to log in the user
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if ($user->role === 'admin') {
                return redirect()->route('admin-dashboard'); // Admin dashboard route
            } else {
                return redirect()->route('dashboard'); // Employee dashboard route
            }
        }

        // If the login attempt fails
        throw ValidationException::withMessages([
            'email' => __('The provided credentials do not match our records.'),
        ]);
    }

    /**
     * Log out the authenticated user.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
