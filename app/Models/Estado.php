<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table = 'estado';

    protected $fillable = [
        'nombre_estado'
    ];

    public function municipios()
    {
        return $this->hasMany(Municipio::class, 'estado_id');
    }
}
