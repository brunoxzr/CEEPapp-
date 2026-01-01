<?php
namespace App\Mail;

use App\Models\Comunicado;
use Illuminate\Mail\Mailable;

class ComunicadoMail extends Mailable
{
    public function __construct(public Comunicado $comunicado) {}

    public function build()
    {
        return $this
            ->subject('📢 Comunicado - ' . $this->comunicado->titulo)
            ->view('emails.comunicado');
    }
}
