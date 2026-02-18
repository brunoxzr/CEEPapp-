<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AtividadeAluno extends Model
{
    protected $table = 'atividade_alunos';

    protected $fillable = [
        'atividade_id',
        'aluno_id',
        'link_drive',
        'status',
        'nota',
        'feedback',
        'entregue_em',
        'corrigido_em',
    ];

    protected $casts = [
        'entregue_em'  => 'datetime',
        'corrigido_em' => 'datetime',
    ];

    // 🔥 RELACIONAMENTOS
    public function atividade()
    {
        return $this->belongsTo(Atividade::class);
    }

    public function aluno()
    {
        return $this->belongsTo(Aluno::class);
    }
}
