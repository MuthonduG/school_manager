<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Club;
use App\Models\User;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'club_id',
        'event_name',
        'organizer',
        'description',
        'event_date',
        'price',
        'rsvp_limit',
        'attendee_count',
        'rsvp_enabled',
    ];

    public function club()
    {
        return $this->belongsTo(Club::class);
    }

    public function attendees()
    {
        return $this->belongsToMany(User::class, 'event_rsvps')->withTimestamps();
    }

    public function rsvps()
    {
        return $this->hasMany(EventRSVP::class);
    }
}
