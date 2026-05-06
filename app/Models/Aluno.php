<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\ProjetoContribuicao;
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
    public function projetos()
{
    return $this->belongsToMany(Projeto::class, 'projeto_alunos')
        ->withPivot('papel','aprovado')
        ->withTimestamps();
}

public function perfilTecnico()
{
    return $this->hasOne(PerfilTecnicoAluno::class);
}

public function contribuicoes()
{
    return $this->hasMany(ProjetoContribuicao::class);
}
public function leituras()
{
    return $this->hasMany(ComunicadoLeitura::class, 'aluno_id');
}
public function comunicadosLidos()
{
    return $this->hasMany(ComunicadoLeitura::class);
}
public function perfil()
{
    return $this->hasOne(AlunoPerfil::class);
}

    public function premios()
    {
        return $this->belongsToMany(
            Premio::class,
            'premio_aluno'
        )->withTimestamps();
    }

public function reconhecimentos()
{
    return $this->belongsToMany(
        \App\Models\Premio::class,
        'premio_aluno', // tabela pivot
        'aluno_id',
        'premio_id'
    )->withTimestamps();
}
public function entregas()
{
    return $this->hasMany(AtividadeAluno::class);
}
public function presidencias()
{
    return $this->hasMany(\App\Models\PresidenteTurma::class, 'aluno_id');
}

public function isPresidenteTurma(): bool
{
    return $this->presidencias()
        ->where('turma', $this->turma)
        ->where('ativo', true)
        ->exists();
}
}
