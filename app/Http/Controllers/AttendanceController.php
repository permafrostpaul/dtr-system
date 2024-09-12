<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AttendanceSummary;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class AttendanceController extends Controller
{
    public function index()
    {
        $query = AttendanceSummary::query()->orderBy('date', 'desc'); 
        
        $userId = Auth::id();
        // Get current date formatted
        $currentDateFormatted = Carbon::now()->format('F j, Y, l');
        
        // Fetch all attendance records or filter as needed
        $attendanceSummaries = AttendanceSummary::where('user_id', $userId)->get();
        // Log attendance summaries
        Log::info('Attendance Summaries:', $attendanceSummaries->toArray());
        $attendanceSummaries = $query->paginate(10);
        // Pass data to view
        return view('profile.attendance', compact('attendanceSummaries', 'currentDateFormatted'));
    }

    public function timeIn(Request $request)
    {
        Log::info('Time In request received', ['user_id' => Auth::id()]);

        $userId = Auth::id();
        $currentTime = Carbon::now();
        $date = $currentTime->toDateString();
        $dayOfWeek = $currentTime->format('l'); // Get the full name of the day of the week
        $remarks = $request->input('remarks');

        // Retrieve the current shift details for the user
        $user = Auth::user();
        $currentShiftName = $user->shift_name;
        $currentShiftTimeOnly = $user->shift_time_only;

        Log::info('Saving Time In', ['date' => $date, 'day_of_week' => $dayOfWeek, 'shift_name' => $currentShiftName, 'shift_time_only' => $currentShiftTimeOnly]);

        // Record time in, shift details, and remarks
        AttendanceSummary::updateOrCreate(
            ['user_id' => $userId, 'date' => $date],
            [
                'time_in' => $currentTime->toTimeString(),
                'day_of_week' => $dayOfWeek,
                'remarks' => $remarks,
                'shift_name' => $currentShiftName, // Save current shift name
                'shift_time_only' => $currentShiftTimeOnly // Save current shift time
            ]
        );

        // Redirect back to the attendance page with a success message
        return redirect()->route('attendance')->with('status', 'Time In successfully recorded.');
    }


    public function timeOut(Request $request)
    {
        Log::info('Time Out request received', ['user_id' => Auth::id()]);

        $userId = Auth::id();
        $currentTime = Carbon::now();
        $date = $currentTime->toDateString();
        $dayOfWeek = $currentTime->format('l');
        $remarks = $request->input('remarks');

        // Retrieve the user's current shift information
        $shiftName = Auth::user()->shift_name;
        $shiftTimeOnly = Auth::user()->shift_time_only;

        Log::info('Saving Time Out', [
            'date' => $date,
            'day_of_week' => $dayOfWeek,
            'shift_name' => $shiftName,
            'shift_time_only' => $shiftTimeOnly
        ]);

        // Record time out, remarks, and shift information
        AttendanceSummary::updateOrCreate(
            ['user_id' => $userId, 'date' => $date],
            [
                'time_out' => $currentTime->toTimeString(),
                'day_of_week' => $dayOfWeek,
                'remarks' => $remarks,
                'shift_name' => $shiftName,  // Save shift name
                'shift_time_only' => $shiftTimeOnly  // Save shift time
            ]
        );

        return redirect()->route('attendance')->with('status', 'Time Out successfully recorded.');
    }


    // public function saveRemarks(Request $request)
    // {
    //     // Validate the remarks input
    //     $request->validate([
    //         'remarks' => 'required|string|max:255',
    //     ]);

    //     // Save the remarks or perform any other logic
    //     $remarks = new Remark();
    //     $remarks->user_id = auth()->id();
    //     $remarks->remarks = $request->input('remarks');
    //     $remarks->save();

    //     // Redirect or return a response
    //     return redirect()->back()->with('success', 'Remarks saved successfully.');
    // }
    public function filterDTR(Request $request)
    {
        // Retrieve the filters from the request
        $userId = $request->input('user_id') ?? auth()->id(); // Default to the logged-in user's ID if no user_id is provided
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Build the query based on filters
        $query = AttendanceSummary::where('user_id', $userId);

        if ($startDate) {
            $query->whereDate('created_at', '>=', $startDate);
        }

        if ($endDate) {
            $query->whereDate('created_at', '<=', $endDate);
        }

        // Paginate the results
        $attendanceSummaries = $query->paginate(10);

        // Pass the results and filters back to the view
        return view('profile.attendance', [
            'attendanceSummaries' => $attendanceSummaries,
            'start_date' => $startDate,
            'end_date' => $endDate,
        ]);
    }
}
