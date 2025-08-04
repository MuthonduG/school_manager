<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\EventRSVPMail;
use App\Models\Event;
use App\Models\Club;

class EventController extends Controller
{
    public function __construct()
    {
        /** Admin-only access for event creation and management */
        $this->middleware(function ($request, $next) {
            if (!Auth::check() || Auth::user()->role_name !== 'Admin') {
                return redirect()->route('error.500')->with('error', 'Action Denied!!');
            }
            return $next($request);
        })->only(['indexEvent', 'store', 'editEvent', 'deleteEvent']);
    }

    /** Show form to create new event (Admin only) */
    public function indexEvent()
    {
        $clubs = Club::pluck('club_name', 'id');
        return view('event.add-event', compact('clubs'));
    }

    /** Store new event (Admin only) */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_name'   => 'required|string|max:255',
            'club_id'      => 'required|exists:clubs,id',
            'organizer'    => 'nullable|string|max:255',
            'description'  => 'required|string',
            'event_date'   => 'required|date',
            'price'        => 'nullable|string|max:50',
            'rsvp_limit'   => 'nullable|integer|min:1',
        ]);

        $validated['event_date'] = date('Y-m-d', strtotime($validated['event_date']));

        DB::table('events')->insert($validated);

        Toastr::success('Event created successfully!', 'Success');
        return redirect()->route('event/list/page')->with('success', 'Event created successfully!');
    }

    /** List all events (Open to all users) */
    public function eventList()
    {
        $events = DB::table('events')
            ->join('clubs', 'events.club_id', '=', 'clubs.id')
            ->select('events.*', 'clubs.club_name')
            ->get();

        return view('event.list-event', compact('events'));
    }

    /** Show event details */
    public function eventDetails($id)
    {
        $event = DB::table('events')
            ->join('clubs', 'events.club_id', '=', 'clubs.id')
            ->select('events.*', 'clubs.club_name')
            ->where('events.id', $id)
            ->first();

        if (!$event) {
            Toastr::error('Event not found!', 'Error');
            return redirect()->route('event/list/page');
        }

        return view('event.event-details', compact('event'));
    }

    /** Edit an event (Admin only) */
    public function editEvent($id)
    {
        $event = DB::table('events')->find($id);
        if (!$event) {
            Toastr::error('Event not found!', 'Error');
            return redirect()->route('event/list/page');
        }

        $clubs = Club::pluck('club_name', 'id');
        return view('event.edit-event', compact('event', 'clubs'));
    }

    /** Delete an event (Admin only) */
    public function deleteEvent($id)
    {
        $event = DB::table('events')->find($id);
        if (!$event) {
            Toastr::error('Event not found!', 'Error');
            return redirect()->route('event/list/page');
        }

        DB::table('events')->where('id', $id)->delete();

        Toastr::success('Event deleted successfully!', 'Success');
        return redirect()->route('event/list/page');
    }

    /** RSVP to an event (for users) */
    public function rsvp($id)
    {
        $user = auth()->user();

        $event = Event::findOrFail($id);

        if (!$event->rsvp_enabled || $event->attendee_count >= $event->rsvp_limit) {
            Toastr::error('RSVP is closed or full.', 'Error');
            return redirect()->back()->with('error', 'RSVP is closed or full.');
        }

        // Prevent duplicate RSVP
        if ($event->rsvps()->where('user_id', $user->id)->exists()) {
            Toastr::warning('You have already RSVPed for this event.', 'Info');
            return redirect()->back()->with('info', 'You have already RSVPed for this event.');
        }

        // Create RSVP
        $event->rsvps()->create(['user_id' => $user->id]);
        Mail::to($user->email)->send(new EventRSVPMail($user, $event));
        Toastr::success('RSVP successful!', 'Success');

        // Increment count
        $event->increment('attendee_count');

        return redirect()->back()->with('success', 'RSVP successful!');
    }

}
