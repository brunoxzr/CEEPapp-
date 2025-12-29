<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permissao;

class PermissaoSeeder extends Seeder
{
    public function run(): void
    {
        Permissao::insert([
            ['chave' => 'gerenciar_usuarios', 'descricao' => 'Gerenciar usuários'],
            ['chave' => 'gerenciar_projetos', 'descricao' => 'Gerenciar projetos técnicos'],
            ['chave' => 'gerenciar_professores', 'descricao' => 'Gerenciar professores'],
            ['chave' => 'publicar_noticias', 'descricao' => 'Publicar notícias'],
            ['chave' => 'ver_relatorios', 'descricao' => 'Visualizar relatórios'],
            ['chave' => 'gerenciar_cronograma', 'descricao' => 'Gerenciar cronograma'],
        ]);
    }
}
