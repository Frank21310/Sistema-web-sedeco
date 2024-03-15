<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $primaryKey = 'id_proveedor';
    protected $table = 'proveedor';
    protected $fillable = [
        'nombre',
        'rfc',
        'tipopersona_id',
    ];
}
