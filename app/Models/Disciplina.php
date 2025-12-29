<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Disciplina extends Model
{
    protected $fillable = ['nome', 'codigo'];

    public function professores()
    {
        return $this->belongsToMany(Admin::class, 'admin_disciplina');
    }
}
