<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PresidenteTurma extends Model
{
    protected $table = 'presidentes_turma';

    protected $fillable = [
        'aluno_id',
        'turma',
        'ativo',
    ];

    protected $casts = [
        'ativo' => 'boolean',
    ];

    public function aluno()
    {
        return $this->belongsTo(Aluno::class);
    }
}