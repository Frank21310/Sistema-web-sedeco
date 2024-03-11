<?php

namespace Database\Seeders;

use App\Models\Empleado;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmpleadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Empleado::create([
            'num_empleado'=>'1234',
            'nombre'=>'Francisco Daniel',
            'apellido_paterno'=>'Santaella',
            'apellido_materno'=>'Ruiz',
            'cargo_id'=>'1',
        ]);
        Empleado::create([
            'num_empleado'=>'12345',
            'nombre'=>'Moises',
            'apellido_paterno'=>'Maza',
            'apellido_materno'=>'Ignacio',
            'cargo_id'=>'1',
        ]);
        
    }
}
