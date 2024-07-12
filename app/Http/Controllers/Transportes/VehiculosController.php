<?php

namespace App\Http\Controllers\Transportes;

use App\Http\Controllers\Controller;
use App\Models\Vehichulos;
use Illuminate\Http\Request;

class VehiculosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('SoloTransportes', ['only' => ['index']]);
    }
    public function index(Request $request)
    {
        $vehiculos = Vehichulos::select('*')->orderBy('id_vehiculo', 'ASC');
        $limit = (isset($request->limit)) ? $request->limit : 5;

        if (isset($request->search)) {
            $vehiculos = $vehiculos->where('id_vehiculo', 'like', '%' . $request->search . '%')
                ->orWhere('marca', 'like', '%' . $request->search . '%');
        }
        $vehiculos = $vehiculos->paginate($limit)->appends($request->all());
        return view('Transportes.Vehiculos.index', compact('vehiculos'));
    }
    public function store(Request $request)
    {
        $Vehiculo = new Vehichulos();
        $Vehiculo = $this->createUpdateVehiculo($request, $Vehiculo);
        return redirect()
            ->route('Vehiculos.index');
    }
    public function createUpdateVehiculo(Request $request, $Vehiculo)
    {
        $Vehiculo->marca = $request->marca;
        $Vehiculo->modelo = $request->modelo;
        $Vehiculo->año = $request->año;
        $Vehiculo->placas = $request->placas;
        $Vehiculo->color = $request->color;
        $Vehiculo->condicion = $request->condicion;
        $Vehiculo->kilometros = $request->kilometros;
        $Vehiculo->tipoaceite = $request->tipoaceite;
        $Vehiculo->rines = $request->rines;
        $Vehiculo->llantas = $request->llantas;
        $Vehiculo->filtro = $request->filtro;
        $Vehiculo->suspension = $request->suspension;
        $Vehiculo->motor = $request->motor;
        $Vehiculo->bujias = $request->bujias;
        $Vehiculo->bateria = $request->bateria;
        $Vehiculo->disponibilidad = $request->disponibilidad;
        $Vehiculo->save();
        return  $Vehiculo;
    }
    public function edit(string $id)
    {
        $Vehiculo = Vehichulos::where('id_vehiculo', $id)->firstOrFail();
        return view('Transportes.Vehiculos.edit', compact('Vehiculo'));
    }
    public function update(Request $request, string $id)
    { {
            $Vehiculo = Vehichulos::where('id_vehiculo', $id)->firstOrFail();
            $Vehiculo = $this->createUpdateVehiculo($request, $Vehiculo);
            return redirect()
                ->route('Vehiculos.index');
        }
    }
    public function destroy(string $id)
    {
        try {
            $Vehiculo = Vehichulos::findOrFail($id);
            $Vehiculo->delete();
            return redirect()->route('Vehiculos.index');
        } catch (\Exception $e) {
            return redirect()->route('Vehiculos.index')->with('error', 'No se pudo eliminar el registro.');
        }
    }
}
