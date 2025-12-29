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
            ['email' => 'bruno@gmail.com'],
            [
                'nome'  => 'Bruno Yudi Kay',
                'email' => 'bruno@gmail.com',
                'senha' => Hash::make('senha123'),
                'role'  => 'diretor',
            ]
        );
    }
}
