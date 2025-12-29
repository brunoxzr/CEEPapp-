<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerfilTecnicoAluno extends Model
{
    use HasFactory;

    protected $table = 'perfil_tecnico_alunos';

    protected $fillable = [
        'aluno_id',
        'bio',
        'foto',
        'linkedin',
        'github',
        'habilidades',
    ];

    protected $casts = [
        'habilidades' => 'array',
    ];

    public function aluno()
    {
        return $this->belongsTo(Aluno::class);
    }
}
