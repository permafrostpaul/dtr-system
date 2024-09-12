<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function fetchEvents()
    {
        $events = Event::all();
        return response()->json($events);
    }

    public function ajaxHandler(Request $request)
    {
        switch ($request->type) {
            case 'add':
                $event = Event::create([
                    'title' => $request->title,
                    'start' => $request->start_date,
                    'end' => $request->end_date,
                ]);
                return response()->json($event);
                break;

            case 'update':
                $event = Event::find($request->id);
                if ($event) {
                    $event->update([
                        'title' => $request->title,
                        'start' => $request->start_date,
                        'end' => $request->end_date,
                    ]);
                    return response()->json($event);
                } else {
                    return response()->json(['error' => 'Event not found'], 404);
                }
                break;

            case 'delete':
                $event = Event::find($request->id);
                if ($event) {
                    $event->delete();
                    return response()->json(['status' => 'Event deleted']);
                } else {
                    return response()->json(['error' => 'Event not found'], 404);
                }
                break;

            default:
                return response()->json(['error' => 'Invalid action'], 400);
        }
    }
    // Fetch birthdays and format them
    public function getBirthdays()
    {
        $birthdays = User::selectRaw('firstname, lastname, DATE_FORMAT(birthday, "%m-%d") as start')
            ->whereNotNull('birthday')
            ->get()
            ->map(function ($birthday) {
                return [
                    'title' => $birthday->firstname . ' ' . $birthday->lastname . "'s Birthday",
                    'start' => $birthday->start,
                    'end' => $birthday->start, // End date is the same as start date for all-day events
                    'allDay' => true,
                    'backgroundColor' => '#FF5733', // Custom color for birthdays
                    'borderColor' => '#FF5733',
                ];
            });

        return response()->json($birthdays);
    }
}
