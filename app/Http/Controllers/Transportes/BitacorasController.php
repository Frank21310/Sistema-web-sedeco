<?php

namespace App\Http\Controllers\Transportes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BitacorasController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('SoloTransportes',['only'=>['index']]);
    }
    public function index(Request $request)
    {
        return view('Transportes.Bitacoras.index');
    }
}
