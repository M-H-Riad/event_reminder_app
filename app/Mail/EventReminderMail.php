<?php

namespace App\Mail;

use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EventReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $event;

    /**
     * Create a new message instance.
     */
    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    public function build()
    {
        return $this->subject('Event Reminder: ' . $this->event->title)
                    ->view('admin.events.event_reminder');
    }
}
