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
        Schema::create('vales', function (Blueprint $table) {
            $table->bigIncrements('id_vale',);

            $table->string('fechasalida');

            $table->foreignId('solicitante')
            ->references('num_empleado')
            ->on('empleados');

            $table->foreignId('departamento_id')
            ->references('id_departamento')
            ->on('departamento');
            
            $table->date('iniciosemana');

            $table->date('finsemana');

            $table->foreignId('entrega')
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
        Schema::dropIfExists('vales');
    }
};
