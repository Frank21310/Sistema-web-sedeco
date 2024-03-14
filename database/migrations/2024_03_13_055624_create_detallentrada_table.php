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
        Schema::create('detallentrada', function (Blueprint $table) {
            $table->bigIncrements('id_detalle',);
            $table->foreignId('entrada_id')
            ->references('id_entrada')
            ->on('entradas');
            $table->foreignId('articulo_id')
            ->references('id_articulo')
            ->on('inventario');
            $table->float('cantidad');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detallentrada');
    }
};
