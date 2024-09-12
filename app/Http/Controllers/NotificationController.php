<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        // Fetch notifications for the authenticated user, ordered by creation date
        $notifications = Auth::user()->notifications()->orderBy('created_at', 'desc')->get();

        // Return the view with the notifications
        return view('profile.notification', compact('notifications'));
    }
    public function markAsRead($id)
    {
        $notification = Auth::user()->notifications()->find($id);
        if ($notification) {
            $notification->markAsRead();
        }

        return redirect()->back()->with('status', 'Notification marked as read.');
    }
}
