<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TurmaDisciplina extends Model
{
    use HasFactory;

    protected $table = 'turma_disciplinas';

    protected $fillable = [
        'turma',
        'disciplina_id',
        'carga_horaria',
    ];

    public function disciplina()
    {
        return $this->belongsTo(Disciplina::class);
    }
}
