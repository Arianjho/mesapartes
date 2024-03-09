<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Cliente;
use App\Models\Incidencia;
use App\Models\IncidenciaOSI;
use App\Models\Perfil;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /*$arrayNewPerfiles = [
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
        }*/

        $incidencias = IncidenciaOSI::all();

        foreach ($incidencias as $incidencia) {
            $cliente = Cliente::where('ruc', $incidencia->ruc)->first();
            if ($cliente) {
                $incidencia->partner = $cliente->partner;
                $incidencia->save();
            }
        }
    }
}
