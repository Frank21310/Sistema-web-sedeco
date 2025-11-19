<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model
{
     protected $table = 'bitacora';

    protected $fillable = [
        'departamento_id',
        'municipio_id',
        'vehiculo_id',
        'fecha_elaboracion',
        'num_control',
        'elaboro',
        'reviso',
        'autorizo',
        'tanque_final',
        'importe_final',
        'k_recorrido',
        'kilometro_inicial',
        'kilometro_final',
        'asfalto_recorrido',
        'rendimiento',
        'tipo'
    ];

    public function municipio()
    {
        return $this->belongsTo(Municipio::class, 'municipio_id');
    }

    public function vehiculo()
    {
        return $this->belongsTo(Vehichulos::class, 'vehiculo_id');
    }

    public function detalle()
    {
        return $this->hasMany(DetalleBitacora::class, 'bitacora_id');
    }
    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'departamento_id');
    }
}
