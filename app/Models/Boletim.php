<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Boletim extends Model
{
    // força o nome certo da tabela
    protected $table = 'boletins';

    protected $fillable = [
        'aluno_id',
        'disciplina',
        'nota',
        'tipo',
        'etapa',
        'ano',
        'observacoes'
    ];

    public function aluno(): BelongsTo
    {
        return $this->belongsTo(Aluno::class);
    }
}
