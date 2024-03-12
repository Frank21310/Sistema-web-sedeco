<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class inventario extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_articulo';
    protected $table = 'unidadmedida';
    protected $fillable = [
        'marca_id',
        'modelo',
        'codigo',
        'descripcion',
        'categoria_id',
        'estante',
        'unidad_id',
        'cantidad',
        'existencia',
        'fecha_elaboracion',
    ];
    public function Marca()
    {
        return $this->belongsTo(Marca::class, 'marca_id', 'id_marca');
    }
    public function Categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id', 'id_categoria');
    }
    public function Unidad()
    {
        return $this->belongsTo(Categoria::class, 'unidad_id', 'id_unidad');
    }
}
