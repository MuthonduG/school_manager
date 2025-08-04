<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    public function indexEvent()
    {
        $clubs = DB::table('clubs')->pluck('club_name', 'id');
        return view('event.add-event', compact('clubs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_name' => 'required|string|max:255',
            'club_id' => 'required|exists:clubs,id',
            'organizer' => 'nullable|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'price' => 'nullable|string|max:50',
            'rsvp_limit' => 'nullable|integer|min:1',
        ]);

        $validated['event_date'] = date('Y-m-d', strtotime($validated['event_date']));

        DB::table('events')->insert($validated);

        return redirect()->route('event/list/page')->with('success', 'Event created successfully!');
    }

    public function eventList()
    {
        $events = DB::table('events')->get();
        return view('event.list-event', compact('events'));
    }
}

