<?php

namespace App\Http\Controllers\Almacen;

use App\Http\Controllers\Controller;
use App\Models\Departamento;
use App\Models\DetalleVales;
use App\Models\Empleado;
use App\Models\inventario;
use App\Models\UnidadMedida;
use App\Models\Vale;
use Illuminate\Http\Request;
use Carbon\Carbon;

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

        $Vales = Vale::select('*')->orderBy('id_vale', 'ASC');
        $limit = (isset($request->limit)) ? $request->limit : 4;

        if (isset($request->search)) {
            $Vales = $Vales->where('id_vale', 'like', '%' . $request->search . '%')
                ->orWhere('solicita', 'like', '%' . $request->search . '%');
        }
        $Vales = $Vales->paginate($limit)->appends($request->all());
        return view('Almacen.Vales.index', compact('Vales', 'medidas', 'Departamentos', 'Solicitantes'));
    }

    public function store(Request $request)
    {
        $fechasalida = Carbon::parse($request->fechasalida);
        $iniciosemana = $fechasalida->startOfWeek();
        $finsemana = $fechasalida->endOfWeek();

        $vale = Vale::create([
            'fechasalida' => $fechasalida,
            'solicitante' => $request->solicitante,
            'departamento_id' => $request->departamento_id,
            'iniciosemana' => $iniciosemana,
            'finsemana' => $finsemana,
            'entrega' => auth()->user()->empleado_num,
        ]);

        // Obtener las descripciones y salidas enviadas en el formulario
        $descripciones = $request->descripcion;
        $salidas = $request->salida;
        $articulo_ids = $request->articulo_id;

        // Iterar sobre las descripciones y salidas para crear los detalles
        for ($i = 0; $i < count($descripciones); $i++) {
            DetalleVales::create([
                'vale_id' => $vale->id_vale,
                'articulo_id' => $articulo_ids[$i], // Obtener el artículo_id correspondiente
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
        $Departamentos = Departamento::all();
        $Vale = Vale::where('id_vale', $id)->firstOrFail();
        $detallevales = DetalleVales::where('vales_id', $Vale->id_vale)->get();
        $articulos = [];
        foreach ($detallevales as $detalle) {
            $articulo = Inventario::find($detalle->articulo_id);
            if ($articulo) {
                $articulos[] = $articulo;
            }
        }
        return view('Almacen.Vales.edit', compact('Vale', 'medidas', 'proveedores', 'Departamentos', 'articulos'));
    }

    public function update(Request $request, string $id)
    {
        $Vale = Vale::where('id_vale', $id)->firstOrFail();
        $Vale->factura = $request->factura;
        $Vale->folio = $request->folio;
        $Vale->fechaentrada = $request->fechaentrada;
        $Vale->fechafactura = $request->fechafactura;
        $Vale->departamento_id = $request->departamento_id;
        $Vale->proveedor_id = $request->proveedor_id;
        $Vale->empleado_num = auth()->user()->empleado_num;
        $Vale->save();

        $detallesEntrada = $Vale->detalles()->get();

        $Vale->detalles()->delete();

        foreach ($detallesEntrada as $detalle) {
            Inventario::where('id_articulo', $detalle->articulo_id)->delete();
        }

        foreach ($request->descripcion as $key => $descripcion) {
            $articulo = new Inventario();
            $articulo->descripcion = $descripcion;
            $articulo->categoria_id = '7';
            $articulo->unidad_id = $request->unidad_id[$key];
            $articulo->cantidad = $request->cantidad[$key];
            $articulo->existencia = $request->cantidad[$key];

            $articulo->save();
            $Vale->detalles()->create([
                'articulo_id' => $articulo->id_articulo,
            ]);
        }
        return redirect()->route('Vales.index');
    }
    public function buscarArticulos(Request $request)
{
    $searchTerm = $request->input('query'); // Obtener el valor del parámetro 'query'

    $articulos = Inventario::where('descripcion', 'like', '%' . $searchTerm . '%')->get();

    $data = [];

    foreach ($articulos as $articulo) {
        $data[] = [
            'label' => $articulo->descripcion, // 'label' es la descripción del artículo
            'value' => $articulo->id_articulo // 'value' es el ID del artículo (opcional)
        ];
    }

    return response()->json($data);
}
}
