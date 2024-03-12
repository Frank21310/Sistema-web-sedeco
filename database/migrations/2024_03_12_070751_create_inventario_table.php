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
        Schema::create('inventario', function (Blueprint $table) {
            $table->id('id_articulo');
            $table->foreignId('marca_id')
            ->references('id_marca')
            ->on('marca');
            $table->string('modelo');
            $table->string('codigo');
            $table->string('descripcion');
            $table->foreignId('categoria_id')
            ->references('id_categoria')
            ->on('categoria');
            $table->string('estante');
            $table->foreignId('unidad_id')
            ->references('id_unidad')
            ->on('unidadmedida');
            $table->float('cantidad');
            $table->float('existencia');
            $table->date('fecha_elaboracion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventario');
    }
};
