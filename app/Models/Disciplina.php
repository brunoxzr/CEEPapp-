<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin;

class Disciplina extends Model
{
    protected $fillable = ['nome', 'codigo'];

    public function professores()
    {
        return $this->belongsToMany(
            Admin::class,
            'admin_disciplina',   // tabela pivot
            'disciplina_id',      // FK desta tabela
            'admin_id'            // FK do admin
        );
    }
}
