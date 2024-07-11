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
        Schema::create('detallevehiculo', function (Blueprint $table) {
            $table->bigIncrements('id_detallevehiculo',);
            $table->foreignId('vehiculo_id')
            ->references('id_vehiculo')
            ->on('vehiculos');
            $table->string('observacion');
            $table->foreignId('id_salida_vehiculo')
            ->references('id_salida_vehiculo')
            ->on('salida');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detallevehiculo');
    }
};
