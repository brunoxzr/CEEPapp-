<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SaebResultado extends Model
{
    protected $table = 'saeb_resultados';

    protected $fillable = [
        'aluno_id',
        'disciplina',
        'ano',
        'etapa',
        'media',
        'detalhes',
    ];

    protected $casts = [
        'detalhes' => 'array',
    ];

    public function aluno(): BelongsTo
    {
        return $this->belongsTo(Aluno::class);
    }
}
