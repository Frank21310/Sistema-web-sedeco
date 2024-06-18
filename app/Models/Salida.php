<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salida extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_salida';
    protected $table = 'salida';
    protected $fillable = [
        'entrada_id',
        'fechasalida',
        'empleado_num',
        'recibe',
    ];
    public function Empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_num', 'num_empleado');
    }
    public function Entrada()
    {
        return $this->belongsTo(Entrada::class, 'entrada_id', 'id_entrada');
    }
    public function Recibe()
    {
        return $this->belongsTo(Empleado::class, 'recibe', 'num_empleado');
    }
    
}
