<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ScheduleMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(private $data)
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $schedule_subject = $this->data['tour_subject'];
        return new Envelope(
            subject: $schedule_subject === 'true' ? 'Your Schedule is Confirmed' : 'Your Schedule is Cancelled',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $schedule = $this->data;

        return new Content(
            view: 'mail.schedule_mail',
            with: ['schedule' => $schedule],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
