<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\AttendanceSummary;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use App\Models\Attendance;

class AdminAttendanceController extends Controller
{
    public function index(Request $request)
    {
        $query = AttendanceSummary::query()->orderBy('date', 'desc'); 

        if ($request->has('user_id') && $request->user_id) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->has('start_date') && $request->start_date) {
            $query->whereDate('date', '>=', $request->start_date);
        }

        if ($request->has('end_date') && $request->end_date) {
            $query->whereDate('date', '<=', $request->end_date);
        }

        $attendanceSummaries = $query->with('user')->paginate(10);
        $users = User::all();

        return view('profile.admin.employee-dtr', compact('attendanceSummaries', 'users'));
    }

    public function timeIn(Request $request)
    {
        Log::info('Time In request received', ['user_id' => Auth::id()]);

        $userId = Auth::id();
        $currentTime = Carbon::now();
        $date = $currentTime->toDateString();
        $dayOfWeek = $currentTime->format('l'); // Get the full name of the day of the week
        $remarks = $request->input('remarks');

        Log::info('Saving Time In', ['date' => $date, 'day_of_week' => $dayOfWeek]);

        // Record time in and remarks
        AttendanceSummary::updateOrCreate(
            ['user_id' => $userId, 'date' => $date],
            ['time_in' => $currentTime->toTimeString(), 'day_of_week' => $dayOfWeek, 'remarks' => $remarks]
        );

        // Stay on the same page
        return redirect()->route('employee-dtr')->with('status', 'Time In successfully recorded.');
    }

    public function timeOut(Request $request)
    {
        Log::info('Time Out request received', ['user_id' => Auth::id()]);

        $userId = Auth::id();
        $currentTime = Carbon::now();
        $date = $currentTime->toDateString();
        $dayOfWeek = $currentTime->format('l'); // Get the full name of the day of the week
        $remarks = $request->input('remarks');

        Log::info('Saving Time Out', ['date' => $date, 'day_of_week' => $dayOfWeek]);

        // Record time out and remarks
        AttendanceSummary::updateOrCreate(
            ['user_id' => $userId, 'date' => $date],
            ['time_out' => $currentTime->toTimeString(), 'day_of_week' => $dayOfWeek, 'remarks' => $remarks]
        );

        // Stay on the same page
        return redirect()->route('employee-dtr')->with('status', 'Time Out successfully recorded.');
    }

    public function filterEmployeeDTR(Request $request)
    {
        // Retrieve the filters from the request
        $userId = $request->input('user_id');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Build the query based on filters
        $query = AttendanceSummary::query();

        if ($userId) {
            $query->where('user_id', $userId);
        }

        if ($startDate) {
            $query->whereDate('created_at', '>=', $startDate);
        }

        if ($endDate) {
            $query->whereDate('created_at', '<=', $endDate);
        }

        // Paginate the results
        $attendanceSummaries = $query->paginate(10); // 10 is the number of items per page

        // Pass the results and filters back to the view
        return view('profile.admin.employee-dtr', [
            'attendanceSummaries' => $attendanceSummaries,
            'users' => User::all(), // Assuming you're passing users for the dropdown
            'user_id' => $userId,
            'start_date' => $startDate,
            'end_date' => $endDate,
        ]);
    }
}
