<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $useradmin=User::create([
            'empleado_num'=>'1234',
            'email'=>'administrador@sedeco.com.mx',
            'password'=>Hash::make('admin'),
            'rol_id'=>'1',
        ]);
        $useradmin=User::create([
            'empleado_num'=>'12345',
            'email'=>'administrador@admin.com.mx',
            'password'=>Hash::make('admin'),
            'rol_id'=>'1',
        ]);
    }
}
