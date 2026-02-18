<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aprovado extends Model
{
protected $fillable = [
    'nome',
    'curso',
    'aprovado_em',
    'ano',
    'foto',
    'ativo'
];

}
