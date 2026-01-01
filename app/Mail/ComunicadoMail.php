<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ComunicadoMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public string $titulo;
    public string $conteudo;

    public function __construct(string $titulo, string $conteudo)
    {
        $this->titulo = $titulo;
        $this->conteudo = $conteudo;
    }

    public function build()
    {
        return $this
            ->from(
                config('mail.from.address'),
                config('mail.from.name')
            )
            ->subject('📢 Comunicado - ' . $this->titulo)
            ->view('emails.comunicado');
    }
}
