<?php

namespace App\Mail\Warehouse;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WarehouseOrderSubmission extends Mailable
{
    use Queueable, SerializesModels;

    public $warehouse_manager;
    public $user;
    public $section;

    /**
     * Create a new message instance.
     */
    public function __construct($warehouse_manager, $user, $section)
    {
        $this->warehouse_manager = $warehouse_manager;
        $this->user = $user;
        $this->section = $section;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Warehouse Order',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.Warehouse.warehouse-order-submission',
                with: [
                    'user' => $this->user,
                    'section' => $this->section,
                    'warehouse_manager' => $this->warehouse_manager,
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
