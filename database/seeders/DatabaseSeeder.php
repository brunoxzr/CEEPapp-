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

        $this->call([
            PermissaoSeeder::class,
            DiretorSeeder::class,
            ClaudioSeeder::class,
            Alunos2AgroASeeder::class,
            Alunos2AgroESeeder::class,
            Alunos2DsSeeder::class,
            Alunos2EdfSeeder::class,
            Alunos2EnfSeeder::class,
            Alunos2MecSeeder::class,
            Alunos3AgroSeeder::class,
            Alunos3DsSeeder::class,
            Alunos3EdfSeeder::class,
            Alunos3EletroSeeder::class,
            Alunos3MecSeeder::class,
            ComunicadoSeeder::class,
        ]);
    }
}
