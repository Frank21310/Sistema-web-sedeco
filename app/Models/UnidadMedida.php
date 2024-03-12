<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnidadMedida extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_unidad';
    protected $table = 'unidadmedida';
    protected $fillable = [
        'nombre_unidad',
    ];
}
