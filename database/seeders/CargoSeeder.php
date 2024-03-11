<?php

namespace Database\Seeders;

use App\Models\Cargo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CargoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cargo::create([
            'nombre_Cargo'=>'Administrador',
        ]);
        Cargo::create([
            'nombre_Cargo'=>'Jefe del Departamento de Recursos Materiales y Servicios Generales',
        ]);
        Cargo::create([
            'nombre_Cargo'=>'Encargada Almacen',
        ]);
    }
}
