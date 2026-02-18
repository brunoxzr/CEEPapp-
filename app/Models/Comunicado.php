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
        'turmas',     // 👈 agora é plural
        'curso',
        'criado_por',
        'ativo',
    ];

    protected $casts = [
        'ativo'  => 'boolean',
        'turmas' => 'array',   // 👈 MUITO IMPORTANTE
    ];

    /* ================= RELAÇÕES ================= */

    // 🔗 Admin que criou o comunicado
    public function autor()
    {
        return $this->belongsTo(Admin::class, 'criado_por');
    }

    // 📖 Leituras dos alunos
    public function leituras()
    {
        return $this->hasMany(ComunicadoLeitura::class);
    }

    /* ================= HELPERS ================= */

    // Retorna se o comunicado é para turma específica
    public function isPorTurma(): bool
    {
        return $this->publico === 'turma' && !empty($this->turmas);
    }

    // Verifica se uma turma específica pode ver o comunicado
    public function visivelParaTurma(string $turma): bool
    {
        if ($this->publico === 'geral') {
            return true;
        }

        if ($this->publico === 'turma') {
            return in_array($turma, $this->turmas ?? []);
        }

        return false;
    }
}
