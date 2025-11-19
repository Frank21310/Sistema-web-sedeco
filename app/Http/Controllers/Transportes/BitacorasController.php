<?php

namespace App\Http\Controllers\Transportes;

use App\Http\Controllers\Controller;
use App\Models\Bitacora;
use App\Models\Departamento;
use App\Models\Municipio;
use App\Models\Vehichulos;
use Illuminate\Http\Request;

class BitacorasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('SoloTransportes', ['only' => ['index']]);
    }
    public function index(Request $request)
    {
        $Bitacoras = Bitacora::select('*')->orderBy('id_bitacora', 'ASC');
        $limit = (isset($request->limit)) ? $request->limit : 5;

        if (isset($request->search)) {
            $Bitacoras = $Bitacoras->where('id_bitacora', 'like', '%' . $request->search . '%')
                ->orWhere('departamento_id', 'like', '%' . $request->search . '%');
        }
        $Bitacoras = $Bitacoras->paginate($limit)->appends($request->all());
        return view('Transportes.Bitacoras.index', compact('Bitacoras'));
    }
    public function create()
    {
        $municipios = Municipio::all();
        $vehiculos = Vehichulos::all();
        $departamentos = Departamento::all();

        return view('Transportes.Bitacoras.create', compact('municipios', 'vehiculos', 'departamentos'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'departamento_id' => 'required|integer',
            'municipio_id' => 'required|integer',
            'vehiculo_id' => 'required|integer',
            'fecha_elaboracion' => 'required|date',
            'num_control' => 'required',
            'elaboro' => 'required',
            'reviso' => 'required',
            'autorizo' => 'required',
            'tanque_final' => 'nullable|numeric',
            'importe_final' => 'nullable|numeric',
            'k_recorrido' => 'nullable|numeric',
            'kilometro_inicial' => 'nullable|numeric',
            'kilometro_final' => 'nullable|numeric',
            'asfalto_recorrido' => 'nullable|numeric',
            'rendimiento' => 'nullable|numeric',
        ]);

        Bitacora::create($request->all());

        return redirect()->route('bitacoras.general')
            ->with('success', 'Bitácora creada correctamente');
    }

    public function edit($id)
    {
        $bitacora = Bitacora::findOrFail($id);
        return view('bitacoras.edit', compact('Bitacoras'));
    }
}
