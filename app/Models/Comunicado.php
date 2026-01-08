<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comunicado extends Model
{
    protected $table = 'comunicados';

    protected $fillable = [
        'titulo',
        'conteudo',
        'publico',
        'turma',
        'curso',
        'criado_por',
        'ativo',
    ];

    protected $casts = [
        'ativo' => 'boolean',
    ];

    // 🔗 quem criou
    public function autor()
    {
        return $this->belongsTo(Admin::class, 'criado_por');
    }
    public function leituras()
{
    return $this->hasMany(ComunicadoLeitura::class);
}

}
