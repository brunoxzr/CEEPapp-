<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmartAgroInscricao extends Model
{
    protected $table = 'smart_agro_inscricoes';

    protected $fillable = [
        'aluno_nome',
        'aluno_email',
        'aluno_telefone',
        'turma',
        'ano',
        'professor_orientador',
        'titulo_projeto',
        'area',
        'problema',
        'solucao',
        'potencial_startup',
        'diferencial',
        'integrantes',
        'nota_inovacao',
        'nota_aplicabilidade',
        'nota_mercado',
        'nota_clareza',
        'nota_viabilidade',
        'nota_total',
        'status'
    ];

    protected $casts = [
        'integrantes' => 'array',
    ];
}
