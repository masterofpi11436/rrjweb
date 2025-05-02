<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MonthlyReportCsv extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $filePath,
        public string $monthName,
        public int $year
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Monthly Warehouse Report – {$this->monthName} {$this->year}",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.monthly-report',
            with: [
                'monthName' => $this->monthName,
                'year' => $this->year,
            ],
        );
    }

    public function attachments(): array
    {
        return [
            \Illuminate\Mail\Mailables\Attachment::fromPath(storage_path("app/{$this->filePath}"))
        ];
    }
}

