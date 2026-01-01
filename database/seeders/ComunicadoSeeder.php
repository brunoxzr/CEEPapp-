<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Comunicado;

class ComunicadoSeeder extends Seeder
{
    public function run(): void
    {
        Comunicado::create([
            'titulo' => 'Bem-vindos ao CEEPApp',
            'conteudo' => '<p>Este é o canal oficial de comunicados do CEEP Assaí.</p>',
            'publico' => 'geral',
            'criado_por' => 1,
            'ativo' => true,
        ]);
    }
}


