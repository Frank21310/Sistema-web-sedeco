<?php

namespace App\Http\Controllers\Almacen;

use App\Http\Controllers\Controller;
use App\Models\Entrada;
use Illuminate\Http\Request;

class Entradas extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('SoloAlmacen', ['only' => ['index']]);
    }
    public function index(Request $request)
    {
        $Entradas = Entrada::select('*')->orderBy('id_entrada', 'ASC');
        $limit = (isset($request->limit)) ? $request->limit : 4;

        if (isset($request->search)) {
            $Entradas = $Entradas->where('id_entrada', 'like', '%' . $request->search . '%')
                ->orWhere('proveedor_id', 'like', '%' . $request->search . '%');                
        }
        $Entradas = $Entradas->paginate($limit)->appends($request->all());
        return view('Almacen.Entradas.index', compact('Entradas'));
    }
    public function store(Request $request)
    {
        $Entrada = new Entrada();
        $Entrada = $this->createUpdateEntrada($request, $Entrada);
        return redirect()
            ->route('Entradas.index');
    }
    public function createUpdateEntrada(Request $request, $Entrada)
    {
        $Entrada->descripcion = $request->descripcion;
        $Entrada->categoria_id = $request->categoria_id;
        $Entrada->estante = $request->estante;
        $Entrada->unidad_id = $request->unidad_id;
        $Entrada->cantidad = $request->cantidad;
        $Entrada->existencia = $request->existencia;
        $Entrada->fecha_elaboracion = $request->fecha_elaboracion;
        $Entrada->save();
        return  $Entrada;
    }
    public function edit(string $id)
    {
        $Entrada = Entrada::where('id_entrada', $id)->firstOrFail();
        return view('Almacen.Entradas.edit', compact('Entrada'));
    }
    public function update(Request $request, string $id)
    { {
            $Entrada = Entrada::where('id_entrada', $id)->firstOrFail();
            $Entrada = $this->createUpdateEntrada($request, $Entrada);
            return redirect()
                ->route('Entradas.index');
        }
    }
    public function destroy(string $id)
    {
        try {
            $Entrada = Entrada::findOrFail($id);
            $Entrada->delete();

            return redirect()->route('Entradas.index');
        } catch (\Exception $e) {
            // Maneja la excepción aquí (puedes mostrar un mensaje de error, registrar la excepción, etc.)
            return redirect()->route('Entradas.index')->with('error', 'No se pudo eliminar el registro.');
        }
    }
}
