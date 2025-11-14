<?php

namespace App\Http\Controllers\Almacen;

use App\Http\Controllers\Controller;
use App\Models\Departamento;
use App\Models\DetalleVales;
use App\Models\Empleado;
use App\Models\inventario;
use App\Models\Solicitud;
use App\Models\UnidadMedida;
use App\Models\Vale;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ValesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('SoloAlmacen', ['only' => ['index']]);
    }
    public function index(Request $request)
    {
        $medidas = UnidadMedida::all();
        $Departamentos = Departamento::all();
        $Solicitantes = Empleado::all();

        $Vales = Vale::select('*')->orderBy('fechasalida', 'DESC');
        $limit = $request->limit ?? 4;
    

        if  ($request->has('search')) {
            $searchTerm = $request->search;
            $Vales = $Vales->where(function ($query) use ($searchTerm){
                $query->where('id_vale', 'like', '%' . $searchTerm . '%')
                ->orWhere('fechasalida', 'like', '%' . $searchTerm . '%')
                ->orWhere('solicitante', 'like', '%' . $searchTerm . '%')
                ->orWhere('iniciosemana', 'like', '%' . $searchTerm. '%')
                ->orWhere('finsemana', 'like', '%' . $searchTerm . '%')
                ->orWhere('entrega', 'like', '%' . $searchTerm. '%')
                ->orWhere('memo', 'like', '%' . $searchTerm . '%')
                ->orWhere('solicitud', 'like', '%' . $searchTerm . '%');
            })
            ->orWhereHas('Departamento', function ($query) use ($searchTerm) {
                $query->where('nombre_departamento', 'like', '%' . $searchTerm . '%');
            })
            ->orWhereHas('Solicitante', function ($query) use ($searchTerm) {
                $query->where('nombre', 'like', '%' . $searchTerm . '%');
            })
            ->orWhereHas('Entrega', function ($query) use ($searchTerm) {
                $query->where('nombre', 'like', '%' . $searchTerm . '%');
            });
        } 
        // Agrega la condición para que solo muestre vales con solicitud igual a 1
        $Vales = $Vales->where('solicitud', 1);
            $Vales->orWhereNull('solicitud');


        $Vales = $Vales->paginate($limit)->appends($request->all());
        return view('Almacen.Vales.index', compact('Vales', 'medidas', 'Departamentos', 'Solicitantes'));
    }

    /*public function index(Request $request)
    {
        $medidas = UnidadMedida::all();
        $Departamentos = Departamento::all();
        $Solicitantes = Empleado::all();

        $Vales = Vale::select('*')->orderBy('fechasalida', 'DESC');
        $limit = (isset($request->limit)) ? $request->limit : 6;

        if (isset($request->search)) {
            $Vales = $Vales->where('id_vale', 'like', '%' . $request->search . '%')
                ->orWhere('solicita', 'like', '%' . $request->search . '%');
        }
        $Vales = $Vales->paginate($limit)->appends($request->all());
        return view('Almacen.Vales.index', compact('Vales', 'medidas', 'Departamentos', 'Solicitantes'));
    }*/

    public function store(Request $request)
    {

        $vale = Vale::create([
            'fechasalida' => $request->fechasalida,
            'solicitante' => $request->solicitante,
            'departamento_id' => $request->departamento_id,
            'iniciosemana' => $request->fechasalida,
            'finsemana' => $request->fechasalida,
            'memo' => $request->memo,
            'entrega' => 1234,
            'solicitud' => $request->solicitud,
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

        return redirect()->route('Vales.index')->with('Vale creado exitosamente.');
    }


    public function edit(string $id)
    {
        $medidas = UnidadMedida::all();
        $Empleados = Empleado::all();
        $Departamentos = Departamento::all();
        $Vale = Vale::where('id_vale', $id)->firstOrFail();
        $detallevales = DetalleVales::where('vale_id', $Vale->id_vale)->get();

        return view('Almacen.Vales.edit', compact('Vale', 'medidas', 'Departamentos', 'detallevales', 'Empleados'));
    }

    public function update(Request $request, $id)
    {
        $vale = Vale::findOrFail($id);

        $vale->update([
            'fechasalida' => $request->fechasalida,
            'solicitante' => $request->solicitante,
            'departamento_id' => $request->departamento_id,
            'iniciosemana' => $request->fechasalida,
            'finsemana' => $request->fechasalida,
            'memo' => $request->memo,
            'entrega' => 1234,
        ]);

        $vale->detalles()->delete();

        $descripciones = $request->descripcion;
        $salidas = $request->salida;
        $articulo_ids = $request->articulo_id;

        for ($i = 0; $i < count($descripciones); $i++) {
            if (!is_null($articulo_ids[$i])) { // Validar que articulo_id no sea null
                $detalle = DetalleVales::create([
                    'vale_id' => $vale->id_vale,
                    'articulo_id' => $articulo_ids[$i],
                    'salida' => $salidas[$i],
                ]);

                // Actualizar el inventario correspondiente
                $inventario = Inventario::find($articulo_ids[$i]);
                $inventario->salida += $salidas[$i] - $detalle->salida; // Restar la salida anterior y agregar la nueva
                $inventario->existencia -= $salidas[$i] - $detalle->salida; // Restar la salida anterior y agregar la nueva
                $inventario->save();
            }
        }

        return redirect()->route('Vales.index')->with('success', 'Vale actualizado exitosamente.');
    }

    public function buscarArticulos(Request $request)
    {
        $searchTerm = $request->input('query'); // Obtener el valor del parámetro 'query'

        $articulos = Inventario::where('descripcion', 'like', '%' . $searchTerm . '%')
            ->whereNotIn('categoria_id', [7]) // Excluir categoría 7
            ->get();

        $data = [];

        foreach ($articulos as $articulo) {
            $data[] = [
                'label' => $articulo->descripcion, // 'label' es la descripción del artículo
                'value' => $articulo->id_articulo // 'value' es el ID del artículo
            ];
        }

        return response()->json($data);
    }

    public function generarvalePDF($id)
    {
        // Obtener el usuario autenticado
         $user = Auth::user();

        // Obtener el número de empleado del usuario autenticado
        $empleado_num = $user->empleado_num;

        $Vales = Vale::find($id);
        $detallevales = DetalleVales::where('vale_id', $Vales->id_vale)->get();
        $pdf = Pdf::loadView('Almacen.Vales.pdf.pdf', compact('Vales', 'detallevales'));
        $pdf->setPaper('letter', 'portrait');
        $pdf->render();
        return $pdf->stream('Vale_' . $id . '.pdf');
    }
    public function destroy(string $id)
    {
        try {
            $Vales = Vale::findOrFail($id);
            $Vales->delete();

            return redirect()->route('Vales.index');
        } catch (\Exception $e) {
            // Maneja la excepción aquí (puedes mostrar un mensaje de error, registrar la excepción, etc.)
            return redirect()->route('Vales.index')->with('error', 'No se pudo eliminar el registro.');
        }
    }
}
