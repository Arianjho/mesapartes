<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Perfil;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $arrayNewPerfiles = [
            [
                'perfil' => 'Administrador'
            ],
            [
                'perfil' => 'Soporte'
            ],
            [
                'perfil' => 'Partner'
            ],
        ];

        foreach ($arrayNewPerfiles as $perfilData) {
            Perfil::create($perfilData);
        }
    }
}
