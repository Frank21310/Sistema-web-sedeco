<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Localidad extends Model
{
    protected $table = 'localidad';

    protected $fillable = [
        'municipio_id',
        'nombre_localidad',
        'kilometraje'
    ];

    public function municipio()
    {
        return $this->belongsTo(Municipio::class, 'municipio_id');
    }

    public function detallebitacoraInicio()
    {
        return $this->hasMany(DetalleBitacora::class, 'localidad_inicial');
    }

    public function detallebitacoraFin()
    {
        return $this->hasMany(DetalleBitacora::class, 'localidad_final');
    }
}
