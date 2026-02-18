<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Premio extends Model
{
    protected $fillable = [
        'titulo',
        'descricao',
        'imagem',
        'ano',
        'ativo',
    ];

    public function alunos()
    {
        return $this->belongsToMany(
            Aluno::class,
            'premio_aluno'
        )->withTimestamps();
    }
}
