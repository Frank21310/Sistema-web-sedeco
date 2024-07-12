<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalidasVehiculo extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_salida_vehiculo'; // Clave primaria personalizada

    protected $fillable = [
        'vehiculo_id',
        'kilometrossalida',
        'descripcion',
        'fechasalida',
        'horasaldida',
        'entrega',
        'recibe',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'fechasalida' => 'date', // Cast para el campo de fecha
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
     * Define relationship with Empleado model for entrega.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function empleadoEntrega()
    {
        return $this->belongsTo(Empleado::class, 'entrega', 'num_empleado');
    }

    /**
     * Define relationship with Empleado model for recibe.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function empleadoRecibe()
    {
        return $this->belongsTo(Empleado::class, 'recibe', 'num_empleado');
    }
}
