<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distrito extends Model
{
    protected $table = 'distrito';

    protected $fillable = [
        'nombre_distrito'
    ];

    public function municipios()
    {
        return $this->hasMany(Municipio::class, 'distrito_id');
    }
}
