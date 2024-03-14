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
        Schema::create('entradas', function (Blueprint $table) {
            $table->bigIncrements('id_entrada',);
            $table->string('factura');
            $table->string('folio');
            $table->date('fechaentrada');
            $table->date('fechafactura');
            $table->foreignId('departamento_id')
            ->references('id_departamento')
            ->on('departamento');
            $table->foreignId('proveedor_id')
            ->references('id_proveedor')
            ->on('proveedor');
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
        Schema::dropIfExists('entradas');
    }
};
