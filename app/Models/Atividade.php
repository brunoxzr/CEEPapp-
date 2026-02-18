<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Atividade extends Model
{
    protected $table = 'atividades';

    protected $fillable = [
    'professor_id',
    'disciplina_id',
    'titulo',
    'descricao',
    'turma',
    'data_limite',
    'tipo',
    'visivel_aluno',
];


    protected $casts = [
        'data_limite' => 'datetime',
    ];

    // 🔥 ENTREGAS DOS ALUNOS
    public function entregas()
    {
        return $this->hasMany(AtividadeAluno::class);
    }
}
