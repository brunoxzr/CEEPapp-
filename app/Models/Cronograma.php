<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cronograma extends Model
{
    protected $fillable = [
        'dia_semana',
        'turma',
        'aula',
        'inicio',
        'fim',
        'disciplina',
        'professor',
        'data',
        'sala',
        'observacoes',
    ];

    public function professor()
    {
        return $this->belongsTo(Admin::class, 'professor_id');
    }

    public function disciplina()
    {
        return $this->belongsTo(Disciplina::class);
    }
}

