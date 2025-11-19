<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    protected $table = 'municipio';

    protected $fillable = [
        'region_id',
        'distrito_id',
        'estado_id',
        'nombre_municipio'
    ];

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    public function distrito()
    {
        return $this->belongsTo(Distrito::class, 'distrito_id');
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id');
    }

    public function localidades()
    {
        return $this->hasMany(Localidad::class, 'municipio_id');
    }

    public function bitacoras()
    {
        return $this->hasMany(Bitacora::class, 'municipio_id');
    }
}
