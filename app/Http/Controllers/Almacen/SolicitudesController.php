<?php

namespace App\Http\Controllers\Almacen;

use App\Http\Controllers\Controller;
use App\Models\Departamento;
use App\Models\DetalleVales;
use App\Models\Empleado;
use App\Models\Solicitud;
use App\Models\Vale;
use App\Models\inventario;
use App\Models\UnidadMedida;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class SolicitudesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('SoloAlmacen', ['only' => ['index']]);
    }
    public function index(Request $request)
    {
        $Solicitud = Solicitud::select('*')->orderBy('id_solicitud', 'ASC');
        $limit = (isset($request->limit)) ? $request->limit : 4;

        if (isset($request->search)) {
            $Solicitud = $Solicitud->where('id_solicitud', 'like', '%' . $request->search . '%')
                ->orWhere('empleado_num', 'like', '%' . $request->search . '%');
        }
        $Solicitud = $Solicitud->paginate($limit)->appends($request->all());
        return view('Almacen.Solicitudes.index', compact('Solicitud'));
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
        Solicitud::create([
            'vale_id' => $vale->id_vale,
            'estatus_id' => 1, // Suponiendo que el estatus 1 representa el estatus que deseas
        ]);

        return redirect()->route('solicitud.index')->with('Vale creado exitosamente.');
    }

    public function edit($id)
    {
        $solicitud = Solicitud::findOrFail($id);
        $vale = $solicitud->vale;
        $detallevales = $vale->detalles;

        $medidas = UnidadMedida::all();
        $Empleados = Empleado::all();
        $Departamentos = Departamento::all();

        return view('Almacen.Solicitudes.edit', compact('solicitud', 'vale', 'detallevales', 'medidas', 'Empleados', 'Departamentos'));
    }

    public function update(Request $request, $id)
    {
        $solicitud = Solicitud::findOrFail($id);
        $vale = $solicitud->vale;

        $solicitud->update([
            'estatus_id' => 2,
        ]);

        $vale->update([
            'fechasalida' => $request->fechasalida,
            'entrega' => auth()->user()->empleado_num,
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

        return redirect()->route('solicitud.index')->with('success', 'Vale actualizado exitosamente.');
    }
    public function generarsalida($id)
    {
        $solicitud = Solicitud::findOrFail($id);
        $Vales = $solicitud->vale;
        $detallevales = DetalleVales::where('vale_id', $Vales->id_vale)->get();
        $pdf = Pdf::loadView('Almacen.Vales.pdf.pdf', compact('Vales', 'detallevales'));
        $pdf->setPaper('letter', 'portrait');
        $pdf->render();
        return $pdf->stream('Vale_' . $id . '.pdf');
    }
    public function actualizarEstatus($id)
    {
        $solicitud = Solicitud::findOrFail($id);

        $solicitud->update([
            'estatus_id' => 3,
        ]);

        // Puedes redirigir a alguna ruta después de actualizar si es necesario
        return redirect()->back()->with('success', 'Estatus actualizado correctamente');
    }
}
