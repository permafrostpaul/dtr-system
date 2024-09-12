<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShiftController extends Controller
{
    public function saveShifts(Request $request)
    {
        $shifts = $request->all();

        // Validate shifts data if needed
        // Save each shift in the database
        foreach ($shifts as $shift) {
            // Example of saving a shift
            Shift::create([
                'shift' => $shift['shift'],
                'rest_day' => $shift['restDay'],
                'time' => $shift['time'],
                'days' => json_encode($shift['days']),
            ]);
        }

        return response()->json(['message' => 'Shifts saved successfully!']);
    }
}
