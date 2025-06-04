<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WarehouseOrderConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $section;
    public $cart;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $section, $cart)
    {
        $this->user = $user;
        $this->section = $section;
        $this->cart = $cart;
    }

    public function build()
    {
        return $this->subject('Warehouse Order Confirmation')
                    ->view('emails.warehouse-order-confirmation');
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
