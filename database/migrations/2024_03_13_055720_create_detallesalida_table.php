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
        Schema::create('detallesalida', function (Blueprint $table) {
            $table->bigIncrements('id_detallesalida',);
            $table->foreignId('salida_id')
            ->references('id_salida')
            ->on('salida');
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
        Schema::dropIfExists('detallesalida');
    }
};
