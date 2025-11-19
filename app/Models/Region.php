<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table = 'region';

    protected $fillable = [
        'nombre_region'
    ];

    public function municipios()
    {
        return $this->hasMany(Municipio::class, 'region_id');
    }
}
