<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class DiretorSeeder extends Seeder
{
    public function run(): void
    {
        Admin::updateOrCreate(
            ['email' => 'aislan.correia@escola.pr.gov.br'],
            [
                'nome'  => 'Aislan Correia',
                'email' => 'aislan.correia@escola.pr.gov.br',
                'senha' => Hash::make('AislanCeep2026?'),
                'role'  => 'diretor',
            ]
        );
    }
}
