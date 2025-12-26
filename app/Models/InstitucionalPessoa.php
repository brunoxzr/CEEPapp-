<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class InstitucionalPessoa extends Model
{
    use HasFactory;

    protected $table = 'institucional_pessoas';

protected $fillable = [
    'nome',
    'slug',
    'cargo',
    'nivel',
    'biografia',
    'foto',
    'ativo'
];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($pessoa) {
            if (empty($pessoa->slug)) {
                $pessoa->slug = Str::slug($pessoa->nome);
            }
        });
    }
    public function getNivelLabelAttribute(): string
    {
        return match ($this->nivel) {
            1 => 'Direção',
            2 => 'Coordenação',
            3 => 'Pedagogia',
            4 => 'Suporte Técnico',
            5 => 'Desenvolvedores',
            default => 'Equipe'
        };
    }
}
