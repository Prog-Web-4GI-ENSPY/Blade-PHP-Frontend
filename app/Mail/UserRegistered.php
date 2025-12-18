<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserRegistered extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * L'utilisateur qui vient de s'inscrire.
     * @var \App\Models\User
     */
    public $user;

    /**
     * Crée une nouvelle instance de message.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Définit l'enveloppe du message (sujet et expéditeur).
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            // Le sujet de l'e-mail inclut le nom de l'utilisateur
            subject: 'Bienvenue chez Shopecart, ' . $this->user->name . ' !',
            // L'adresse email d'où l'e-mail est envoyé
            from: new Address(env('MAIL_FROM_ADDRESS'), 'Équipe Shopecart'),
        );
    }

    /**
     * Définit le contenu du message (la vue utilisée).
     */
    public function content(): Content
    {
        return new Content(
            // La vue Blade Markdown à utiliser
            markdown: 'emails.registration_confirmation',
            // Les données passées à la vue
            with: [
                'name' => $this->user->name,
                'email' => $this->user->email,
            ],
        );
    }

    /**
     * Obtient les pièces jointes pour le message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}