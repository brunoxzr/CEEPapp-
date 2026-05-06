<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChamadaTurma extends Model
{
    protected $table = 'chamadas_turma';

    protected $fillable = [
        'turma',
        'data',
        'aula',
        'observacao',
        'presidente_id',
    ];

    protected $casts = [
        'data' => 'date',
    ];

    public function presidente()
    {
        return $this->belongsTo(Aluno::class, 'presidente_id');
    }

    public function alunos()
    {
        return $this->belongsToMany(
            Aluno::class,
            'chamada_turma_alunos',
            'chamada_turma_id',
            'aluno_id'
        )->withPivot('presente')->withTimestamps();
    }
}