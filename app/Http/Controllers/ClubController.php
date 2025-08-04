<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;
use App\Mail\ClubJoinedMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Club;

class ClubController extends Controller
{
    public function __construct()
    {
        /** Apply admin-only middleware to sensitive methods */
        $this->middleware(function ($request, $next) {
            if (!Auth::check() || Auth::user()->role_name !== 'Admin') {
                return redirect()->route('error.500')->with('error', 'Action Denied!!');
            }
            return $next($request);
        })->only(['indexClub', 'store', 'editClub']);
    }

    /** Show the form to create a new club (Admin only) */
    public function indexClub()
    {
        return view('clubs.add-club');
    }

    /** Store the new club in the database (Admin only) */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'club_id' => 'required|string|max:10',
            'club_name' => 'required|string|max:255',
            'club_leader' => 'required|string|max:255',
            'founded_date' => 'required|date',
            'member_count' => 'required|integer|min:1',
        ]);

        // Normalize date
        $validated['founded_date'] = date('Y-m-d', strtotime($validated['founded_date']));

        DB::table('clubs')->insert($validated);

        Toastr::success('Club created successfully!', 'Success');
        return redirect()->route('club/list/page')->with('success', 'Club created successfully!');
    }

    /** Show the form to edit an existing club (Admin only) */
    public function editClub()
    {
        return redirect()->route('clubs/edit-club')->with('error', 'Club not found!');
    }

    /** Show a list of all clubs (Open to all authenticated users) */
    public function clubList()
    {
        $clubs = DB::table('clubs')->get();
        return view('clubs.list-club', compact('clubs'));
    }

    /** Show the details of a specific club */
    public function clubDetails($id)
    {
        $club = DB::table('clubs')->find($id);
        if (!$club) {   
            return redirect()->route('club/list/page')->with('error', 'Club not found!');
        }
        return view('clubs.club-details', compact('club'));
    }

    /** Delete a club (Admin only) */
    public function deleteClub($id)
    {
        $club = DB::table('clubs')->find($id);
        if (!$club) {
            return redirect()->route('club/list/page')->with('error', 'Club not found!');
        }
        DB::table('clubs')->where('id', $id)->delete();
        return redirect()->route('club/list/page')->with('success', 'Club deleted successfully!');
    }

    /** Join club */
    public function join($id)
    {
        $club = Club::find($id); // Use Eloquent model, not DB facade
        if (!$club) {
            Toastr::error('Club not found!', 'Error');
            return redirect()->route('club/list/page')->with('error', 'Club not found!');
        }

        $user = Auth::user();

        // Avoid ambiguous column error by specifying pivot table
        if ($club->members()->where('club_user.user_id', $user->id)->exists()) {
            Toastr::warning('You are already a member of this club!', 'Warning');
            return redirect()->route('club/list/page')->with('error', 'You are already a member of this club!');
        }

        $club->members()->attach($user->id);
        Mail::to($user->email)->send(new ClubJoinedMail($club));
        Toastr::success('You have joined the club successfully!', 'Success');

        return redirect()->route('club/list/page')->with('success', 'You have joined the club successfully!');
    }

}
