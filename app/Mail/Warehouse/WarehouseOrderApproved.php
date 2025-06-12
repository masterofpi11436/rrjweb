<?php

namespace App\Mail\Warehouse;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

// Notice of Warehouse order was approved

class WarehouseOrderApproved extends Mailable
{
    use Queueable, SerializesModels;

    public $supervisor;
    public $section;
    public $cart;

    /**
     * Create a new message instance.
     */
    public function __construct($supervisor, $section, $cart)
    {
        $this->supervisor = $supervisor;
        $this->section = $section;
        $this->cart = $cart;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Warehouse Order Approved',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.Warehouse.warehouse-order-confirmation',
                with: [
                    'supervisor' => $this->supervisor,
                    'section' => $this->section,
                    'cart' => $this->cart,
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
