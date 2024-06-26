<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_categoria';
    protected $table = 'categoria';
    protected $fillable = [
        'nombre_categoria',
    ];
    public function inventario()
    {
        return $this->hasMany(inventario::class, 'categoria_id', 'id_categoria');
    }
}
