<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = [
        'nome',
        'email',
        'senha',
        'role'
    ];

    protected $hidden = ['senha'];

public function permissoes()
{
    return $this->belongsToMany(
        Permissao::class,
        'admin_permissoes',
        'admin_id',
        'permissao_id'
    );
}

    public function isDiretor(): bool
    {
        return $this->role === 'diretor';
    }

    public function temPermissao(string $chave): bool
    {
        if ($this->isDiretor()) {
            return true;
        }

        return $this->permissoes()->where('chave', $chave)->exists();
    }
public function disciplinas()
{
    return $this->belongsToMany(
        Disciplina::class,
        'admin_disciplina'
    );
}
public function projetos()
{
    return $this->hasMany(Projeto::class, 'professor_id');
}


}
