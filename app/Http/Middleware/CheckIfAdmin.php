<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckIfAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the authenticated user is an admin
        // if (Auth::check() && Auth::user()->role_id === 1) {
        //     return $next($request); // Allow access
        // }

        // // If not an admin, redirect to home or an unauthorized page
        // return redirect('/')->with('error', 'You do not have admin access.');
    }
}
