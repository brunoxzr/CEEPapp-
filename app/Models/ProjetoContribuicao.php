<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjetoContribuicao extends Model
{
    use HasFactory;

    protected $fillable = [
        'projeto_id',
        'aluno_id',
        'titulo',
        'descricao',
        'imagem',
    ];

    public function projeto()
    {
        return $this->belongsTo(Projeto::class);
    }

    public function aluno()
    {
        return $this->belongsTo(Aluno::class);
    }
}
