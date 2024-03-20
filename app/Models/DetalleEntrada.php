<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleEntrada extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_detalle';
    protected $table = 'detallentrada';
    protected $fillable = [
        'entrada_id',
        'articulo_id',
    ];
    public function Inventario()
    {
        return $this->belongsTo(inventario::class, 'articulo_id', 'id_articulo');
    }
    public function Entrada()
    {
        return $this->belongsTo(Entrada::class, 'entrada_id', 'id_entrada');
    }

}
