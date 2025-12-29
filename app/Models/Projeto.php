<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Projeto extends Model
{
    protected $fillable = [
        'titulo','slug','descricao','area',
        'tecnologias','professor_id','status','capa_imagem'
    ];

    protected $casts = [
        'tecnologias' => 'array',
    ];

    public function professor()
    {
        return $this->belongsTo(Admin::class, 'professor_id');
    }

    public function alunos()
    {
        return $this->belongsToMany(Aluno::class, 'projeto_alunos')
            ->withPivot('papel','aprovado')
            ->withTimestamps();
    }

    public function contribuicoes()
    {
        return $this->hasMany(ProjetoContribuicao::class);
    }
}
