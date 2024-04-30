<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_solicitud';
    protected $table = 'solicitud';
    protected $fillable = [
        'vale_id',
    ];
    public function Vale()
    {
        return $this->belongsTo(Vale::class, 'vale_id', 'id_vale');
    }
}
