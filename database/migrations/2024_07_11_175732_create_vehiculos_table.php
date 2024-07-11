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
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->bigIncrements('id_vehiculo',);
            $table->string('marca');
            $table->string('modelo');
            $table->string('año');
            $table->string('placas');
            $table->string('color');
            $table->string('condicion');
            $table->string('kilometros');
            $table->string('tipoaceite');
            $table->string('rines');
            $table->string('llantas');
            $table->string('filtro');
            $table->string('suspension');
            $table->string('motor');
            $table->string('bujias');
            $table->string('bateria');
            $table->boolean('disponibilidad');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehiculos');
    }
};
