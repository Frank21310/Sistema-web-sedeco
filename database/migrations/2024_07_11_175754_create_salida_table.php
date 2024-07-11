<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('salida', function (Blueprint $table) {
            $table->bigIncrements('id_salida_vehiculo',);
            $table->foreignId('vehiculo_id')
            ->references('id_vehiculo')
            ->on('vehiculos');
            $table->string('kilometrossalida');
            $table->string('descripcion');
            $table->date('fechasalida');
            $table->string('horasaldida');
            $table->foreignId('entrega')
            ->references('num_empleado')
            ->on('empleados');
            $table->foreignId('recibe')
            ->references('num_empleado')
            ->on('empleados');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salida');
    }
};
