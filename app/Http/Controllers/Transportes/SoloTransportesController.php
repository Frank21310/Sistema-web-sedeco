<?php

namespace App\Http\Controllers\Transportes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SoloTransportesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('SoloTransportes',['only'=>['index']]);
    }
}
