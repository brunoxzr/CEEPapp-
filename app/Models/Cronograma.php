<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cronograma extends Model
{
    protected $fillable = ['dia_semana', 'turma', 'disciplina', 'professor', 'inicio', 'fim', 'sala', 'observacoes'];

    protected $casts = ['data' => 'date', 'inicio' => 'datetime:H:i', 'fim' => 'datetime:H:i'];
}
