<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Mail\EventReminderMail;
use Illuminate\Support\Facades\Mail;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::orderBy('start_time')->get();
        return view('admin.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_time' => 'required|date|after:now',
            'end_time' => 'required|date|after:start_time',
            'members' => 'required|string',
        ]);

        // Convert to an array
        $members = array_map('trim', explode(',', $request->members));

        // Save the event with JSON encoded members
        $event = new Event($validated);
        $event->reminder_id = 'EVT-' . strtoupper(uniqid());
        $event->members = json_encode($members);
        $event->save();

        return redirect()->route('events.index')->with('success', 'Event created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        return view('admin.events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        return view('admin.events.create', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_time' => 'required|date|after:now',
            'end_time' => 'required|date|after:start_time',
            'status' => 'required|string',
            'members' => 'required|string',
        ]);

        // Convert to an array and JSON encode them
        $validated['members'] = json_encode(array_map('trim', explode(',', $request->members)));

        // Update the event
        $event->update($validated);

        return redirect()->route('events.index')->with('success', 'Event updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Event deleted successfully');
    }

    public function downloadDemoCsv()
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="event_reminder_demo.csv"',
        ];

        $columns = ['title', 'description', 'start_time', 'end_time', 'status', 'members'];

        $callback = function () use ($columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns); // Column headers

            // Add some sample data
            fputcsv($file, [
                'Sample Event 1',
                'This is a description for event 1',
                '2024-12-25 10:00:00',
                '2024-12-25 12:00:00',
                'upcoming',
                'email1@example.com,email2@example.com',
            ]);
            fputcsv($file, [
                'Sample Event 2',
                'This is a description for event 2',
                '2024-11-01 15:00:00',
                '2024-11-01 18:00:00',
                'upcoming',
                'email3@example.com,email4@example.com',
            ]);

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }


    public function importCsv(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt',
        ]);

        $file = $request->file('csv_file');
        $path = $file->getRealPath();

        // Read the CSV file
        $data = array_map('str_getcsv', file($path));

        // Remove the headers
        $headers = array_shift($data);

        DB::beginTransaction();
        try {
            foreach ($data as $row) {
                // Convert the date format from 'm/d/Y H:i' to 'Y-m-d H:i:s'
                $start_time = Carbon::createFromFormat('m/d/Y H:i', trim($row[2]))->format('Y-m-d H:i:s');
                $end_time = Carbon::createFromFormat('m/d/Y H:i', trim($row[3]))->format('Y-m-d H:i:s');

                // Validate each row
                $validator = Validator::make([
                    'title' => $row[0],
                    'description' => $row[1],
                    'start_time' => $start_time,
                    'end_time' => $end_time,
                    'status' => $row[4],
                    'members' => $row[5],
                ], [
                    'title' => 'required|string|max:255',
                    'description' => 'nullable|string',
                    'start_time' => 'required|date|after:now',
                    'end_time' => 'required|date|after:start_time',
                    'status' => 'required|in:upcoming,completed',
                    'members' => 'required|string',
                ]);

                if ($validator->fails()) {
                    return back()->withErrors($validator)->withInput();
                }

                // Convert members to JSON
                $members = json_encode(array_map('trim', explode(',', $row[5])));

                // Create the event
                Event::create([
                    'title' => $row[0],
                    'description' => $row[1],
                    'start_time' => $start_time,
                    'end_time' => $end_time,
                    'status' => $row[4],
                    'members' => $members,
                    'reminder_id' => 'EVT-' . strtoupper(uniqid()),
                ]);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error while importing events: ' . $e->getMessage());
        }

        return redirect()->route('events.index')->with('success', 'Events imported successfully!');
    }

    public function sendReminder($id)
    {
        $event = Event::findOrFail($id);
        $members = json_decode($event->members);

        foreach ($members as $member) {
            Mail::to(trim($member))->send(new EventReminderMail($event)); //Send email
        }

        return redirect()->route('events.index')->with('success', 'Reminder emails sent successfully!');
    }



}
