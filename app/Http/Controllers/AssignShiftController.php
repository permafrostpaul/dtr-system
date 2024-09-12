<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AssignShiftController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Fetch users based on the search query
        $users = User::when($search, function ($query, $search) {
            return $query->where('firstname', 'like', '%' . $search . '%')
                ->orWhere('lastname', 'like', '%' . $search . '%');
        })->get();

        return view('profile.admin.assign-shift', compact('users'));
    }
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('profile.admin.assign-shift', compact('user'));
    }


    public function update(Request $request)
    {
        // Validate all the form data
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'shift_name' => 'nullable|string',
            'shift_time_only' => 'nullable|string',
            'rest_day' => 'nullable|string',
            'days' => 'nullable|array',
            'days.*' => 'nullable|string',
            'shift_name1' => 'nullable|string',
            'shift_time_only1' => 'nullable|string',
            'rest_day1' => 'nullable|string',
            'days1' => 'nullable|array',
            'days1.*' => 'nullable|string',
            'shift_name2' => 'nullable|string',
            'shift_time_only2' => 'nullable|string',
            'rest_day2' => 'nullable|string',
            'days2' => 'nullable|array',
            'days2.*' => 'nullable|string',
        ]);

        // Find the user by ID
        $user = User::find($validatedData['user_id']);

        if ($user) {
            // Update shift 1 data if it's not empty
            if (!empty($validatedData['shift_name']) || !empty($validatedData['shift_time_only']) || !empty($validatedData['rest_day']) || !empty($validatedData['days'])) {
                $user->shift_name = $validatedData['shift_name'] ?? null;
                $user->shift_time_only = $validatedData['shift_time_only'] ?? null;
                $user->rest_day = $validatedData['rest_day'] ?? null;
                $user->days = !empty($validatedData['days']) ? json_encode($validatedData['days']) : null;
            }

            // Update shift 2 data if it's not empty
            if (!empty($validatedData['shift_name1']) || !empty($validatedData['shift_time_only1']) || !empty($validatedData['rest_day1']) || !empty($validatedData['days1'])) {
                $user->shift_name1 = $validatedData['shift_name1'] ?? null;
                $user->shift_time_only1 = $validatedData['shift_time_only1'] ?? null;
                $user->rest_day1 = $validatedData['rest_day1'] ?? null;
                $user->days1 = !empty($validatedData['days1']) ? json_encode($validatedData['days1']) : null;
            }

            // Update shift 3 data if it's not empty
            if (!empty($validatedData['shift_name2']) || !empty($validatedData['shift_time_only2']) || !empty($validatedData['rest_day2']) || !empty($validatedData['days2'])) {
                $user->shift_name2 = $validatedData['shift_name2'] ?? null;
                $user->shift_time_only2 = $validatedData['shift_time_only2'] ?? null;
                $user->rest_day2 = $validatedData['rest_day2'] ?? null;
                $user->days2 = !empty($validatedData['days2']) ? json_encode($validatedData['days2']) : null;
            }

            // Save the user with the updated shift information
            $user->save();
        }

        // Redirect with success message
        return redirect()->route('assign-shift.index')->with('status', 'Shift updated successfully.');
    }

    public function storeShift(Request $request)
    {
        $validatedData = $request->validate([
            'shift_name' => 'required|string',
            'shift_time_only' => 'required|string',
            'shift_type' => 'required|in:shift1,shift2,shift3', // Validate shift type
            'rest_day' => 'nullable|string',
            'days' => 'nullable|array',
        ]);

        $user = User::find($request->user_id); // Adjust as needed

        switch ($validatedData['shift_type']) {
            case 'shift1':
                $user->shift_name = $validatedData['shift_name'];
                $user->shift_time_only = $validatedData['shift_time_only'];
                break;

            case 'shift2':
                $user->shift_name1 = $validatedData['shift_name'];
                $user->shift_time_only1 = $validatedData['shift_time_only'];
                break;

            case 'shift3':
                $user->shift_name2 = $validatedData['shift_name'];
                $user->shift_time_only2 = $validatedData['shift_time_only'];
                break;
        }

        $user->save();

        return redirect()->back()->with('status', 'Shift updated successfully.');
    }
}
