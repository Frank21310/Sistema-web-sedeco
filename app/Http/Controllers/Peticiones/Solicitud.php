<?php

namespace App\Http\Controllers\Peticiones;

use App\Http\Controllers\Controller;
use App\Models\DetalleVales;
use App\Models\inventario;
use App\Models\Solicitud as ModelsSolicitud;
use App\Models\Vale;
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

    public function store(Request $request)
    {
                                        
        $vale = Vale::create([

            'fechasalida' => $request->fechasalida,
            'solicitante' =>  auth()->user()->empleado_num,
            'departamento_id' =>  auth()->user()->Empleados->departamento,
            'iniciosemana' => $request->fechasalida,
            'finsemana' => $request->fechasalida,

        ]);

        $descripciones = $request->descripcion;
        $salidas = $request->salida;
        $articulo_ids = $request->articulo_id;

        for ($i = 0; $i < count($descripciones); $i++) {
            DetalleVales::create([
                'vale_id' => $vale->id_vale,
                'articulo_id' => $articulo_ids[$i],
                'salida' => $salidas[$i],
            ]);

            $inventario = Inventario::find($articulo_ids[$i]);
            $inventario->salida += $salidas[$i];
            $inventario->existencia -= $salidas[$i];
            $inventario->save();
        }

        // Crear una nueva solicitud
        ModelsSolicitud::create([
            'vale_id' => $vale->id_vale,
            'estatus_id' => 1, // Suponiendo que el estatus 1 representa el estatus que deseas
        ]);

        return redirect()->route('Vales.index')->with('Vale creado exitosamente.');
    }
}
