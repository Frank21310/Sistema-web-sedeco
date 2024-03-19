<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Dompdf\Dompdf;
use Dompdf\Options;

class Entrada extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_entrada';
    protected $table = 'entradas';
    protected $fillable = [
        'factura',
        'folio',
        'codigo',
        'fechaentrada',
        'fechafactura',
        'departamento_id',
        'proveedor_id',
        'empleado_num',
    ];
    public function detalles()
    {
        return $this->hasMany(DetalleEntrada::class, 'entrada_id');
    }
    public function Departamento()
    {
        return $this->belongsTo(Departamento::class, 'departamento_id', 'id_departamento');
    }
    public function Proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_id', 'id_proveedor');
    }
    public function Empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_num', 'num_empleado');
    }
    
}

