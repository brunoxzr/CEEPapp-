<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProfessorRestricao extends Model
{
    use HasFactory;

    protected $table = 'professor_restricoes';

    protected $fillable = [
        'admin_id',
        'dia_semana',
        'aula',
        'motivo',
    ];

    /**
     * Relacionamento:
     * Restrição pertence a um professor (Admin)
     */
    public function professor()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    /**
     * Verifica se a restrição é para o dia inteiro
     */
    public function isDiaInteiro(): bool
    {
        return is_null($this->aula);
    }
}
