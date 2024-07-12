<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVehiculos extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_detallevehiculo'; // Clave primaria personalizada

    protected $fillable = [
        'vehiculo_id',
        'observacion',
        'id_salida_vehiculo',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        //
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

    /**
     * Define relationship with Vehiculo model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vehiculo()
    {
        return $this->belongsTo(Vehichulos::class, 'vehiculo_id', 'id_vehiculo');
    }

    /**
     * Define relationship with Salida model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function salida()
    {
        return $this->belongsTo(Salida::class, 'id_salida_vehiculo', 'id_salida_vehiculo');
    }
}
