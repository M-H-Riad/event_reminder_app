<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // Store a new event
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_time' => 'required|date|after:now',
            'end_time' => 'nullable|date|after:start_time',
            'members' => 'required|string',
        ]);

        // Convert the comma-separated members string to an array
        $members = array_map('trim', explode(',', $request->members));

        $event = new Event($validated);
        $event->reminder_id = 'EVT-' . strtoupper(uniqid());
        $event->members = json_encode($members); // Store members as JSON
        $event->save();

        return response()->json(['message' => 'Event created successfully', 'event' => $event], 201);
    }

}
