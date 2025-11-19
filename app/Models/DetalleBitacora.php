<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleBitacora extends Model
{
     protected $table = 'detallebitacora';

    protected $fillable = [
        'bitacora_id',
        'fechadma',
        'localidad_inicial',
        'localidad_final',
        'recorrido_inicio',
        'recorrido_fin',
        'num_comision',
        'factura',
        'n_factura',
        'importe',
        'gasolina',
        'kilometro_inicial',
        'k_final',
        'asfalto',
        'observaciones'
    ];

    public function bitacora()
    {
        return $this->belongsTo(Bitacora::class, 'bitacora_id');
    }

    public function localidadInicial()
    {
        return $this->belongsTo(Localidad::class, 'localidad_inicial');
    }

    public function localidadFinal()
    {
        return $this->belongsTo(Localidad::class, 'localidad_final');
    }
}
