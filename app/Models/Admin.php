<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Permissao;
use App\Models\Disciplina;
use App\Models\Projeto;
use App\Models\ProfessorRestricao;
use App\Models\Cronograma;

class Admin extends Model
{
    protected $fillable = [
        'nome',
        'email',
        'senha',
        'role'
    ];

    protected $hidden = ['senha'];

    // ============================
    // PERMISSÕES
    // ============================

    public function permissoes()
    {
        return $this->belongsToMany(
            Permissao::class,
            'admin_permissoes',
            'admin_id',
            'permissao_id'
        );
    }

    public function isDiretor(): bool
    {
        return $this->role === 'diretor';
    }

    public function temPermissao(string $chave): bool
    {
        if ($this->isDiretor()) {
            return true;
        }

        return $this->permissoes()->where('chave', $chave)->exists();
    }

    // ============================
    // DISCIPLINAS / PROFESSOR
    // ============================

public function disciplinas()
{
    return $this->belongsToMany(
        Disciplina::class,
        'admin_disciplina',
        'admin_id',
        'disciplina_id'
    )->withPivot('carga_horaria_max');
}



    public function projetos()
    {
        return $this->hasMany(Projeto::class, 'professor_id');
    }

    // ============================
    // RESTRIÇÕES DE HORÁRIO
    // ============================

    public function restricoes()
    {
        return $this->hasMany(ProfessorRestricao::class, 'admin_id');
    }

    /**
     * Verifica se o professor pode dar aula
     * em um dia/aula específica
     */
    public function podeDarAula(string $diaSemana, int $aula): bool
    {
        return !$this->restricoes()
            ->where('dia_semana', $diaSemana)
            ->where(function ($q) use ($aula) {
                $q->whereNull('aula')
                  ->orWhere('aula', $aula);
            })
            ->exists();
    }

    /**
     * Retorna as restrições organizadas
     * Ex:
     * [
     *   'Segunda' => 'BLOQUEADO',
     *   'Terça' => [1, 2]
     * ]
     */
    public function mapaRestricoes(): array
    {
        $map = [];

        foreach ($this->restricoes as $r) {
            if ($r->aula === null) {
                $map[$r->dia_semana] = 'BLOQUEADO';
            } else {
                $map[$r->dia_semana][] = $r->aula;
            }
        }

        return $map;
    }

    // ============================
    // CARGA HORÁRIA
    // ============================

    /**
     * Quantas aulas o professor já tem no cronograma
     */public function cargaAtualDisciplina($disciplinaNome): int
{
    return Cronograma::where('professor', $this->nome)
        ->where('disciplina', $disciplinaNome)
        ->count();
}

public function podeAssumirDisciplina($disciplina): bool
{
    $max = $disciplina->pivot->carga_horaria_max;

    // se não definiu, libera
    if ($max === null) return true;

    return $this->cargaAtualDisciplina($disciplina->nome) < $max;
}
/**
 * Quantas aulas o professor já tem
 * em uma disciplina específica
 */
// ============================
// CARGA HORÁRIA (CRONOGRAMA)
// ============================

/**
 * Quantas aulas o professor já tem
 * em uma disciplina (cronograma)
 */
public function cargaUsadaDisciplina(string $disciplinaNome): int
{
    return Cronograma::where('professor', $this->nome)
        ->where('disciplina', $disciplinaNome)
        ->count();
}

/**
 * Retorna a carga máxima permitida
 * para uma disciplina (pivot)
 */
public function cargaMaxDisciplina(string $disciplinaNome): ?int
{
    $disc = $this->disciplinas
        ->firstWhere('nome', $disciplinaNome);

    return $disc?->pivot?->carga_horaria_max;
}

/**
 * Verifica se o professor ainda pode
 * assumir mais aulas da disciplina
 */
public function podeDarMaisAula(string $disciplinaNome): bool
{
    $max = $this->cargaMaxDisciplina($disciplinaNome);

    // sem limite definido → pode
    if (!$max) {
        return true;
    }

    return $this->cargaUsadaDisciplina($disciplinaNome) < $max;
}

/**
 * Informações completas da carga
 * (usado no Blade)
 */
public function cargaInfo(Disciplina $disciplina): array
{
    $usada = $this->cargaUsadaDisciplina($disciplina->nome);
    $max   = $disciplina->pivot->carga_horaria_max;

    if (!$max) {
        return [
            'usada' => $usada,
            'max' => null,
            'percentual' => null,
        ];
    }

    return [
        'usada' => $usada,
        'max' => $max,
        'percentual' => min(100, round(($usada / $max) * 100)),
    ];
}
}
