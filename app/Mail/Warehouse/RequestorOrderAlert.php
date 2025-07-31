<?php

namespace App\Mail\Warehouse;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RequestorOrderAlert extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $supervisor;
    public $section;
    public $cart;

    public function __construct($supervisor, $user, $section, $cart)
    {
        $this->supervisor = $supervisor;
        $this->user = $user;
        $this->section = $section;
        $this->cart = $cart;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Order Supply Request',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.Warehouse.requestor-order-alert',
            with: [
                'user' => $this->user,
                'section' => $this->section,
                'supervisor' => $this->supervisor,
                'cart' => $this->cart,
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
