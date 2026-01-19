<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfessorTurmaDisciplina extends Model
{
    protected $table = 'professor_turma_disciplinas';

    protected $fillable = [
        'admin_id',
        'turma',
        'disciplina_id',
        'aulas_semana',
    ];

    public function professor()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function disciplina()
    {
        return $this->belongsTo(Disciplina::class);
    }
}
