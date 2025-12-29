<?php

namespace App\Mail\Warehouse;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

// Email notification to the warehouse supervisors

class ExchangeOrderConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $section;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $section)
    {
        $this->user = $user;
        $this->section = $section;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '(DO NOT REPLY) Exchange Order Submitted (BRING ITEM(S) TO THE WAREHOUSE)',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.Warehouse.exchange-order-confirmation',
                with: [
                    'user' => $this->user,
                    'section' => $this->section,
                ]);
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
