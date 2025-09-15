<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Criar usuário admin se não existir
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('admin123'),
                'role' => 'admin'
            ]
        );

        // Criar usuário comum para teste
        User::firstOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'Usuário Teste',
                'password' => Hash::make('user123'),
                'role' => 'user'
            ]
        );
    }
}
