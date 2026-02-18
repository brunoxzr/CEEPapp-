<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Atividade;
use App\Models\AtividadeAluno;
use App\Models\Aluno;

class AtividadeCorrigidaMail extends Mailable
{
    use SerializesModels;

    public $atividade;
    public $registro;
    public $aluno;

    public function __construct(Atividade $atividade, AtividadeAluno $registro, Aluno $aluno)
    {
        $this->atividade = $atividade;
        $this->registro = $registro;
        $this->aluno = $aluno;
    }

    public function build()
    {
        return $this->subject('Sua atividade foi corrigida — CEEP Assaí')
                    ->view('emails.atividade-corrigida');
    }
}
