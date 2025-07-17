<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TrainingInvite extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public string $bodyText;

    public function __construct(string $bodyText)
    {
        $this->bodyText = $bodyText;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Notificação de Treinamento',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.training-invite',
            with: [
                'bodyText' => $this->bodyText,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
