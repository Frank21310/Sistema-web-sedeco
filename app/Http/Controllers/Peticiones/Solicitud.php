<?php

namespace App\Http\Controllers\Peticiones;

use App\Http\Controllers\Controller;
use App\Models\Solicitud as ModelsSolicitud;
use Illuminate\Http\Request;

class Solicitud extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('SoloPeticiones', ['only' => ['index']]);
    }
    public function index(Request $request)
    {
        $Solicitud = ModelsSolicitud::select('*')->orderBy('id_solicitud', 'ASC');
        $limit = (isset($request->limit)) ? $request->limit : 4;

        if (isset($request->search)) {
            $Solicitud = $Solicitud->where('id_solicitud', 'like', '%' . $request->search . '%')
                ->orWhere('empleado_num', 'like', '%' . $request->search . '%');
        }
        $Solicitud = $Solicitud->paginate($limit)->appends($request->all());
        return view('Peticiones.Solicitudes.index', compact('Solicitud'));
    }
}
