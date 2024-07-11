<?php

namespace App\Http\Controllers\Peticiones;

use App\Http\Controllers\Controller;
use App\Models\DetalleVales;
use App\Models\inventario;
use App\Models\Solicitud as ModelsSolicitud;
use App\Models\Vale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Solicitud extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('SoloPeticiones', ['only' => ['index']]);
    }
    public function index(Request $request)
{
    // Obtener el usuario autenticado
    $user = Auth::user();

    // Obtener el número de empleado del usuario autenticado
    $empleado_num = $user->empleado_num;

    // Consulta inicial de solicitudes
    $Solicitud = ModelsSolicitud::query()
        ->whereHas('Vale.Solicitante', function ($query) use ($empleado_num) {
            $query->where('num_empleado', $empleado_num);
        })
        ->orderBy('id_solicitud', 'ASC');

    // Aplicar filtro de búsqueda si se especifica
    if ($request->filled('search')) {
        $search = $request->search;
        $Solicitud->where(function ($query) use ($search) {
            $query->where('id_solicitud', 'like', '%' . $search . '%')
                ->orWhereHas('Vale.Solicitante', function ($query) use ($search) {
                    $query->where('num_empleado', 'like', '%' . $search . '%');
                });
        });
    }

    // Paginar y devolver la vista con las solicitudes
    $limit = $request->input('limit', 4);
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

        ModelsSolicitud::create([
            'vale_id' => $vale->id_vale,
            'estatus_id' => 1, 
        ]);

        return redirect()->route('Solicitudes.index')->with('Vale creado exitosamente.');
    }
}
