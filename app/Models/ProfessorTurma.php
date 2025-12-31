<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class ProfessorTurma extends Model
{
    use HasFactory;

    protected $table = 'professor_turmas';

    protected $fillable = [
        'turma',
        'carga_max',
        'admin_id',
    ];

    public function professor()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}
