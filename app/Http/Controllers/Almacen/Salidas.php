<?php

namespace App\Http\Controllers\Almacen;

use App\Http\Controllers\Controller;
use App\Models\DetalleEntrada;
use App\Models\DetalleSalida;
use App\Models\Empleado;
use App\Models\Entrada;
use App\Models\inventario;
use App\Models\Salida;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class Salidas extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('SoloAlmacen', ['only' => ['index']]);
    }
    public function index(Request $request)
    {
        $Receptor = Empleado::all();
        $Salidas = Salida::select('*')->orderBy('id_salida', 'DESC');
        $limit = (isset($request->limit)) ? $request->limit : 4;

        if (isset($request->search)) {
            $Salidas = $Salidas->where('id_salida', 'like', '%' . $request->search . '%')
                ->orWhere('empleado_num', 'like', '%' . $request->search . '%');
        } 
        $Salidas = $Salidas->paginate($limit)->appends($request->all());
        return view('Almacen.Salidas.index', compact('Salidas','Receptor'));
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
        $salida->recibe = $request->recibe;
        $salida->empleado_num = 1234;
        $salida->save();
        return redirect()->route('Salidas.index');
    }

    public function edit(string $id)
    {
        $Receptor = Empleado::all();
        $Salida = Salida::where('id_salida', $id)->firstOrFail();
        return view('Almacen.Salidas.edit', compact('Salida','Receptor'));
    }

    public function update(Request $request, string $id)
    {
        $Salida = Salida::where('id_salida', $id)->firstOrFail();
        $Salida->fechasalida = $request->fechasalida;
        $Salida->empleado_num = auth()->user()->empleado_num;
        $Salida->recibe = $request->recibe;
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
    public function generarsalidaPDF($id)
    {
        $Salida = Salida::find($id);

        // Verificar si se encontró la salida
        if (!$Salida) {
            return response()->json(['error' => 'Salida no encontrada'], 404);
        }

        // Obtener la entrada relacionada con la salida
        $Entrada = $Salida->Entrada;

        // Verificar si se encontró la entrada
        if (!$Entrada) {
            return response()->json(['error' => 'Entrada no encontrada'], 404);
        }

        // Obtener los detalles de la entrada
        $detallesEntrada = $Entrada->detalles;

        // Inicializar un arreglo para los artículos
        $articulos = [];

        // Iterar sobre los detalles de la entrada para obtener los artículos
        foreach ($detallesEntrada as $detalle) {
            $articulo = $detalle->Inventario;

            if ($articulo) {
                $articulos[] = $articulo;
            }
        }

        $pdf = Pdf::loadView('Almacen.Salidas.pdf.pdf', compact('Salida', 'Entrada', 'articulos'));
        $pdf->setPaper('letter', 'portrait');

        return $pdf->stream('Salida_' . $id . '.pdf');
    }
}
