<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVales extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_detallevale';
    protected $table = 'detallevales';
    protected $fillable = [
        'vale_id',
        'articulo_id',
        'salida',

    ];
    public function Inventario()
    {
        return $this->belongsTo(inventario::class, 'articulo_id', 'id_articulo');
    }
    public function Vale()
    {
        return $this->belongsTo(Vale::class, 'vale_id', 'id_vale');
    }

}
