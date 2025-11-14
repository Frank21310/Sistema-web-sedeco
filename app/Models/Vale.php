<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vale extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_vale';
    protected $table = 'vales';
    protected $fillable = [
        'fechasalida',
        'solicitante',
        'departamento_id',
        'iniciosemana',
        'finsemana',
        'entrega',
        'memo',
        'solicitud',

    ];
    public function detalles()
    {
        return $this->hasMany(DetalleVales::class, 'vale_id');
    }
    public function Departamento()
    {
        return $this->belongsTo(Departamento::class, 'departamento_id', 'id_departamento');
    }
    public function Solicitante()
    {
        return $this->belongsTo(Empleado::class, 'solicitante', 'num_empleado');
    }
    public function Entrega()
    {
        return $this->belongsTo(Empleado::class, 'entrega', 'num_empleado');
    }
    
}


