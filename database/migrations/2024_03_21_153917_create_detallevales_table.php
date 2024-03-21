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
        Schema::create('detallevales', function (Blueprint $table) {
            $table->bigIncrements('id_detallevale',);
            $table->foreignId('vale_id')
            ->references('id_vale')
            ->on('vales');
            $table->foreignId('articulo_id')
            ->references('id_articulo')
            ->on('inventario');
            $table->float('salida');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detallevales');
    }
};
