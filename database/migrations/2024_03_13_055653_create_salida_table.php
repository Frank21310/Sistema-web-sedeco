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
            $table->bigIncrements('id_salida',);
            $table->foreignId('entrada_id')
            ->references('id_entrada')
            ->on('entradas');
            $table->date('fechasalida');
            $table->foreignId('empleado_num')
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
