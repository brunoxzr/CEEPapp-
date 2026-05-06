<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Comunicado;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ComunicadoSeeder extends Seeder
{
    public function run(): void
    {
        $admin = Admin::firstOrCreate(
            ['email' => 'brunin@escola.pr.gov.br'],
            ['nome' => 'Gestor', 'senha' => Hash::make('senha123')]
        );

        Comunicado::updateOrCreate(
            ['titulo' => 'Bem-vindos ao CEEPApp'],
            [
                'conteudo' => '<p>Este e o canal oficial de comunicados do CEEP Assai.</p>',
                'publico' => 'geral',
                'criado_por' => $admin->id,
                'ativo' => true,
            ]
        );
    }
}
