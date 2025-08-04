<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EventRSVPMail extends Mailable
{
    use Queueable, SerializesModels;

    public $event;

    public function __construct($event)
    {
        $this->event = $event;
    }

    public function build()
    {
        return $this->subject('RSVP Confirmation')
                    ->view('emails.event-rsvp');
    }
}
