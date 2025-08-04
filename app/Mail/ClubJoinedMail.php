<?php

namespace App\Mail;

use App\Models\Club;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ClubJoinedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $club;

    public function __construct(Club $club)
    {
        $this->club = $club;
    }

    public function build()
    {
        return $this->subject('Welcome to ' . $this->club->club_name)
                    ->view('emails.club-joined');
    }
}
