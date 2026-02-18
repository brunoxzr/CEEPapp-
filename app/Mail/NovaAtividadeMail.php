<?php

namespace App\Mail;

use App\Models\Atividade;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NovaAtividadeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $atividade;

    public function __construct(Atividade $atividade)
    {
        $this->atividade = $atividade;
    }

    public function build()
    {
        return $this->subject('📚 Nova atividade — ' . $this->atividade->titulo)
            ->view('emails.nova_atividade');
    }
}
