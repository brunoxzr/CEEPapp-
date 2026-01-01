<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CalendarioInstitucional extends Model
{
    protected $table = 'calendario_institucional';

    protected $fillable = [
        'titulo',
        'descricao',
        'data',
        'hora_inicio',
        'hora_fim',
        'tipo',
        'publico',
        'ativo',
    ];

    protected $casts = [
        'data' => 'date',
        'ativo' => 'boolean',
    ];
}
