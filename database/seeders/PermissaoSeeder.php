<?php

namespace Database\Seeders;

use App\Models\Permissao;
use Illuminate\Database\Seeder;

class PermissaoSeeder extends Seeder
{
    public function run(): void
    {
        $permissoes = [
            ['chave' => 'gerenciar_usuarios', 'descricao' => 'Gerenciar usuarios'],
            ['chave' => 'gerenciar_projetos', 'descricao' => 'Gerenciar projetos tecnicos'],
            ['chave' => 'gerenciar_professores', 'descricao' => 'Gerenciar professores'],
            ['chave' => 'publicar_noticias', 'descricao' => 'Publicar noticias'],
            ['chave' => 'ver_relatorios', 'descricao' => 'Visualizar relatorios'],
            ['chave' => 'gerenciar_cronograma', 'descricao' => 'Gerenciar cronograma'],
        ];

        foreach ($permissoes as $permissao) {
            Permissao::updateOrCreate(
                ['chave' => $permissao['chave']],
                ['descricao' => $permissao['descricao']]
            );
        }
    }
}
