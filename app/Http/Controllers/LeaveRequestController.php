<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // Import the Log facade

class LeaveRequestController extends Controller
{
    // Method to show the leave request form
    public function index()
    {
        return view('profile.request-leave');
    }

    // Method to store a new leave request
    public function store(Request $request)
    {
        // Log the request data for debugging purposes
        // Log::info($request->all());

        // Validate the request
        $request->validate([
            'date_from' => 'required|date',
            'date_to' => 'required|date',
            'leave_type' => 'required|string|max:255',
            'duration' => 'required|string|max:255',
            'reason' => 'required|string',
        ]);

        // Generate a unique leave number
        $latestLeaveRequest = LeaveRequest::latest('id')->first();
        $newNumber = $latestLeaveRequest ? str_pad($latestLeaveRequest->id + 1, 4, '0', STR_PAD_LEFT) : '0001';

        // Create a new leave request
        LeaveRequest::create([
            'user_id' => Auth::id(),
            'leave_number' => $newNumber,
            'date_from' => Carbon::parse($request->input('date_from'))->format('Y-m-d'),
            'date_to' => Carbon::parse($request->input('date_to'))->format('Y-m-d'),
            'leave_type' => $request->input('leave_type'),
            'duration' => $request->input('duration'),
            'reason' => $request->input('reason'),
        ]);

        // Redirect or respond as needed
        return redirect()->route('request-leave')->with('status', 'Leave Request submitted successfully.');
    }
}
