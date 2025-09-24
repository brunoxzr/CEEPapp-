<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Aluno;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Admin::firstOrCreate(
            ['email' => 'brunin@escola.pr.gov.br'],
            ['nome' => 'Gestor', 'senha' => Hash::make('senha123')]
        );

        Aluno::firstOrCreate(
            ['email' => 'bruno@escola.pr.gov.br'],
            [
                'nome' => 'Bruno Kay',
                'senha' => Hash::make('senha123'),
                'escola' => 'CEEP',
                'turma' => '2º DS-A',
                'matricula' => '2025-0001'
            ]
        );
    }
}
