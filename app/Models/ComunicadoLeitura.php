<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComunicadoLeitura extends Model
{
    protected $fillable = [
        'comunicado_id',
        'aluno_id',
        'lido_em',
    ];

    public $timestamps = false;

    protected $casts = [
        'lido_em' => 'datetime',
    ];
}
