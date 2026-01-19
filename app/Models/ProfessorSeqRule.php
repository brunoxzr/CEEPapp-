<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfessorSeqRule extends Model
{
    protected $table = 'professor_seq_rules';

    protected $fillable = [
        'admin_id',
        'disciplina_id',
        'turma',
        'dia_semana',
        'max_seguidas',
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
