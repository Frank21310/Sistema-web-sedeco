<?php

namespace App\Http\Controllers\Almacen;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\inventario as ModelsInventario;
use App\Models\UnidadMedida;
use Illuminate\Http\Request;

class Inventario extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('SoloAlmacen', ['only' => ['index']]);
    }
    public function index(Request $request)
    {
        $categorias = Categoria::all();
        $medidas = UnidadMedida::all();

        $Articulos = ModelsInventario::select('*')->orderBy('descripcion', 'ASC');
        $limit = (isset($request->limit)) ? $request->limit : 4;

        if (isset($request->search)) {
            $Articulos = $Articulos->where('id_articulo', 'like', '%' . $request->search . '%')
                ->orWhere('descripcion', 'like', '%' . $request->search . '%')
                ->orWhere('categoria_id', 'like', '%' . $request->search . '%');
                
        }
        $Articulos = $Articulos->paginate($limit)->appends($request->all());
        return view('Almacen.Inventario.index', compact('Articulos','categorias','medidas'));
    }
    public function store(Request $request)
    {
        $Articulo = new ModelsInventario();
        $Articulo = $this->createUpdateArticulo($request, $Articulo);
        return redirect()
            ->route('Inventario.index');
    }
    public function createUpdateArticulo(Request $request, $Articulo)
    {
        $Articulo->descripcion = $request->descripcion;
        $Articulo->categoria_id = $request->categoria_id;
        $Articulo->estante = $request->estante;
        $Articulo->unidad_id = $request->unidad_id;
        $Articulo->cantidad = $request->cantidad;
        $Articulo->existencia = $request->existencia;
        $Articulo->fecha_elaboracion = $request->fecha_elaboracion;
        $Articulo->save();
        return  $Articulo;
    }
    public function edit(string $id)
    {
        $Articulo = ModelsInventario::where('id_articulo', $id)->firstOrFail();
        return view('Almacen.Inventario.edit', compact('Articulo'));
    }
    public function update(Request $request, string $id)
    { {
            $Articulo = ModelsInventario::where('id_articulo', $id)->firstOrFail();
            $Articulo = $this->createUpdateArticulo($request, $Articulo);
            return redirect()
                ->route('Inventario.index');
        }
    }
    public function destroy(string $id)
    {
        try {
            $Articulo = ModelsInventario::findOrFail($id);
            $Articulo->delete();

            return redirect()->route('Inventario.index');
        } catch (\Exception $e) {
            // Maneja la excepción aquí (puedes mostrar un mensaje de error, registrar la excepción, etc.)
            return redirect()->route('Inventario.index')->with('error', 'No se pudo eliminar el registro.');
        }
    }

}
