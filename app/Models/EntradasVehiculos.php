<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntradasVehiculos extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_entrada_vehiculo'; // Clave primaria personalizada

    protected $fillable = [
        'salidavehiculo_id',
        'kilometrosentrada',
        'fechaentrada',
        'horaentrada',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'fechaentrada' => 'date', // Cast para el campo de fecha
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
     * Define relationship with Salida model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function salida()
    {
        return $this->belongsTo(Salida::class, 'salidavehiculo_id', 'id_salida_vehiculo');
    }
}
