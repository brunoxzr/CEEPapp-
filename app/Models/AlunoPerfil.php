<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlunoPerfil extends Model
{
    protected $table = 'aluno_perfis';

    protected $fillable = [
        'aluno_id',
        'foto',
        'linkedin',
        'github',
        'portfolio',
        'curso',
        'ano',
        'bio',
        'publico'
    ];

    public function aluno()
    {
        return $this->belongsTo(Aluno::class);
    }
}
