<?php

namespace App\Http\Controllers\Almacen;

use App\Http\Controllers\Controller;
use App\Models\Entrada;
use App\Models\inventario;
use App\Models\Salida;
use Illuminate\Http\Request;

class Salidas extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('SoloAlmacen', ['only' => ['index']]);
    }
    public function index(Request $request)
    {
        $Salidas = Salida::select('*')->orderBy('id_salida', 'ASC');
        $limit = (isset($request->limit)) ? $request->limit : 4;

        if (isset($request->search)) {
            $Salidas = $Salidas->where('id_salida', 'like', '%' . $request->search . '%')
                ->orWhere('empleado_num', 'like', '%' . $request->search . '%');
        }
        $Salidas = $Salidas->paginate($limit)->appends($request->all());
        return view('Almacen.Salidas.index', compact('Salidas'));
    }

    public function store(Request $request)
    {
    $entradaExistente = Entrada::where('id_entrada', $request->entrada_id)->exists();

    if (!$entradaExistente) {
        return back()->with('Error', 'Folio no encontrado en la base de datos.');
    }
        $salida = new Salida();
        $salida->entrada_id = $request->entrada_id;
        $salida->fechasalida = $request->fechasalida;
        $salida->empleado_num = auth()->user()->empleado_num;
        $salida->save();
        return redirect()->route('Salidas.index');
    }

    public function edit(string $id)
    {
        $Salida = Salida::where('id_entrada', $id)->firstOrFail();
        return view('Almacen.Salidas.edit', compact('Salida'));
    }

    public function update(Request $request, string $id)
    {
        $Salida = Salida::where('id_entrada', $id)->firstOrFail();
        $Salida->fechasalida = $request->fechasalida;
        $Salida->empleado_num = auth()->user()->empleado_num;
        $Salida->entrada_id = $request->entrada_id;
        $Salida->save();
        return redirect()->route('Salidas.index');
    }

    public function destroy(string $id)
    {
        try {
            $Salida = Salida::findOrFail($id);
            $Salida->delete();

            return redirect()->route('Salidas.index');
        } catch (\Exception $e) {
            return redirect()->route('Salidas.index')->with('error', 'No se pudo eliminar el registro.');
        }
    }
}
