<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehichulos extends Model
{
    use HasFactory;
    use HasFactory;

    protected $primaryKey = 'id_vehiculo'; // Clave primaria personalizada
    protected $table = 'vehiculos';

    protected $fillable = [
        'marca',
        'modelo',
        'año',
        'placas',
        'color',
        'condicion',
        'kilometros',
        'tipoaceite',
        'rines',
        'llantas',
        'filtro',
        'suspension',
        'motor',
        'bujias',
        'bateria',
        'disponibilidad',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'disponibilidad' => 'boolean', // Cast para el campo booleano
    ];

    /**
     * Get the formatted date for the timestamp.
     *
     * @param  string  $value
     * @return string
     */
    public function getCreatedAtAttribute($value)
    {
        return date('Y-m-d H:i:s', strtotime($value));
    }

    public function getUpdatedAtAttribute($value)
    {
        return date('Y-m-d H:i:s', strtotime($value));
    }
}

