<?php

namespace App\Http\Controllers\Peticiones;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SoloPeticionescontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('SoloPeticiones',['only'=>['index']]);
    }
}
