<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permissao extends Model
{
    protected $table = 'permissoes'; // 🔥 FORÇADO

    public $timestamps = false;

    protected $fillable = [
        'chave',
        'descricao'
    ];
}
