<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin;

class Disciplina extends Model
{
    protected $fillable = [
        'nome',
        'codigo',
        // se depois quiser:
        // 'carga_horaria_semanal'
    ];

    /**
     * Professores que podem lecionar essa disciplina
     * (com carga horária máxima)
     */
public function professores()
{
    return $this->belongsToMany(
        Admin::class,
        'admin_disciplina',
        'disciplina_id',
        'admin_id'
    )->withPivot('carga_horaria_max');
}

    /**
     * Turmas que exigem essa disciplina
     * (quantas aulas por semana)
     */
    public function turmas()
    {
        return $this->hasMany(TurmaDisciplina::class, 'disciplina_id');
    }
}
