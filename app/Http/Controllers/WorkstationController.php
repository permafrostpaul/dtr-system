<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Workstation;

class WorkstationController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'workstation' => 'required|string|max:255|unique:workstations,name',
        ]);

        Workstation::create([
            'name' => $validated['workstation'],
        ]);

        return redirect()->back()->with('success', 'Workstation added successfully.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'workstation' => 'required|string|max:255|unique:workstations,name,' . $id,
        ]);

        $workstation = Workstation::findOrFail($id);
        $workstation->update(['name' => $validated['workstation']]);

        return redirect()->back()->with('success', 'Workstation updated successfully.');
    }
}
