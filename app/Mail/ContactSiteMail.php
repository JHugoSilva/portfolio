<?php

namespace App\Mail;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class ContactSiteMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contact;
    public $about;
    public $medias;

    /**
     * Create a new message instance.
     */
    public function __construct(Contact $contact, $about = '', $medias = '')
    {
        $this->contact = $contact;
        $this->about = $about;
        $this->medias = $medias;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Novo Contato via Site' . $this->contact->assunto,
            // Opcional: Define um "Responder para" automático
            replyTo: [
                new Address(
                    $this->contact->email,
                    $this->contact->nome,
                )
            ],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.contato',
            with: [
                'data' => $this->contact,
                'about' => $this->about,
                'medias' => $this->medias
            ],
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
