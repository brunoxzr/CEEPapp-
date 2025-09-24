<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Aluno extends Model
{
    protected $fillable = [
        'nome', 'email', 'senha', 'escola', 'turma', 'nascimento', 'matricula'
    ];

    protected $hidden = ['senha'];

    protected $casts = [
        'nascimento' => 'date'
    ];

    public function boletins(): HasMany
    {
        return $this->hasMany(Boletim::class);
    }
}
