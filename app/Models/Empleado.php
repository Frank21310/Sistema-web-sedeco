<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;
    protected $primaryKey = 'num_empleado';
    protected $table = 'empleados';
    protected $fillable = [
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'cargo_id',
    ];
    public function Cargos()
    {
        return $this->belongsTo(Cargo::class, 'cargo_id', 'id_cargo');
    }
}
