<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegraSequencia extends Model
{
    protected $table = 'regras_sequencia';

    protected $fillable = [
        'admin_id',
        'turma',
        'dia_semana',
        'max_seguidas',
    ];

    public function professor()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}
