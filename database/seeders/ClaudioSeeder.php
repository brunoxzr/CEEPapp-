<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class ClaudioSeeder extends Seeder
{
    public function run(): void
    {
        Admin::updateOrCreate(
            ['email' => 'silva.filho.claudio@escola.pr.gov.br'],
            [
                'nome'  => 'Claudio Cordeiro da Silva Filho',
                'email' => 'silva.filho.claudio@escola.pr.gov.br',
                'senha' => Hash::make('ClaudioCeep2026?'),
                'role'  => 'diretor',
            ]
        );
    }
}
