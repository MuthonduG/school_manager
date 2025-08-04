<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class EventRSVPMail extends Mailable
{
    public $user;
    public $event;

    public function __construct($user, $event)
    {
        $this->user = $user;
        $this->event = $event;
    }

    public function build()
    {
        return $this->view('emails.event-rsvp')
                    ->with([
                        'user' => $this->user,
                        'event' => $this->event,
                    ]);
    }
}

