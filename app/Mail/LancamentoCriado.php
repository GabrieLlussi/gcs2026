<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class LancamentoCriado extends Mailable
{
    public $lancamento;

    public function __construct($lancamento)
    {
        $this->lancamento = $lancamento;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Lançamento criado/atualizado',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.lancamento', // ✅ AQUI
        );
    }
}