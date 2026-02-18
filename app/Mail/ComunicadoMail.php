<?php

namespace App\Mail;

use App\Models\Comunicado;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ComunicadoMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public Comunicado $comunicado;

    /**
     * Cria a instância do e-mail
     */
    public function __construct(Comunicado $comunicado)
    {
        $this->comunicado = $comunicado;
    }

    /**
     * Monta o e-mail
     */
    public function build()
    {
        return $this
            ->from(
                config('mail.from.address'),
                config('mail.from.name')
            )
            ->subject('📢 Comunicado — ' . $this->comunicado->titulo)
            ->view('emails.comunicado', [
                'comunicado' => $this->comunicado,
            ]);
    }
}
