<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SoloAdminController extends Controller
{
    public function __construct()
        {
            $this->middleware('auth');
            $this->middleware('soloadministrador',['only'=>['index']]);
        }
}
