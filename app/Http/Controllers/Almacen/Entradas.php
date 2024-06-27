<?php

namespace App\Http\Controllers\Almacen;

use App\Http\Controllers\Controller;
use App\Models\Departamento;
use App\Models\DetalleEntrada;
use App\Models\Entrada;
use Illuminate\Http\Request;
use App\Models\Inventario;
use App\Models\Proveedor;
use App\Models\UnidadMedida;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;


class Entradas extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('SoloAlmacen', ['only' => ['index']]);
    }
    public function index(Request $request)
{
    $medidas = UnidadMedida::all();
    $proveedores = Proveedor::all();
    $Departamentos = Departamento::all();

    $Entradas = Entrada::select('*')->orderBy('id_entrada', 'DESC');
    $limit = $request->limit ?? 4;

    if ($request->has('search')) {
        $searchTerm = $request->search;
        $Entradas = $Entradas->where(function ($query) use ($searchTerm) {
            $query->where('id_entrada', 'like', '%' . $searchTerm . '%')
                ->orWhere('factura', 'like', '%' . $searchTerm . '%')
                ->orWhere('entrega', 'like', '%' . $searchTerm . '%')
                ->orWhere('cargoentrega', 'like', '%' . $searchTerm . '%')
                ->orWhere('folio', 'like', '%' . $searchTerm . '%')
                ->orWhere('fechaentrada', 'like', '%' . $searchTerm . '%')
                ->orWhere('fechafactura', 'like', '%' . $searchTerm . '%');
        })
        ->orWhereHas('Departamento', function ($query) use ($searchTerm) {
            $query->where('nombre_departamento', 'like', '%' . $searchTerm . '%');
        })
        ->orWhereHas('Proveedor', function ($query) use ($searchTerm) {
            $query->where('nombre', 'like', '%' . $searchTerm . '%');
        });
    }

    $Entradas = $Entradas->paginate($limit)->appends($request->all());
    return view('Almacen.Entradas.index', compact('Entradas', 'medidas', 'proveedores', 'Departamentos'));
}

    public function store(Request $request)
    {
        $entrada = new Entrada();
        $entrada->factura = $request->factura;
        $entrada->entrega = $request->entrega;
        $entrada->cargoentrega = $request->cargoentrega;
        $entrada->folio = $request->folio;
        $entrada->fechaentrada = $request->fechaentrada;
        $entrada->fechafactura = $request->fechafactura;
        $entrada->departamento_id = $request->departamento_id;
        $entrada->proveedor_id = $request->proveedor_id;
        $entrada->empleado_num = auth()->user()->empleado_num;
        $entrada->save();

        foreach ($request->descripcion as $key => $descripcion) {
            $articulo = new Inventario();
            $articulo->descripcion = $descripcion;
            $articulo->categoria_id = '7';
            $articulo->unidad_id = $request->unidad_id[$key];
            $articulo->cantidad = $request->cantidad[$key];
            $articulo->existencia = $request->cantidad[$key];

            $articulo->save();
            $entrada->detalles()->create([
                'articulo_id' => $articulo->id_articulo,
            ]);
        }


        return redirect()->route('Entradas.index');
    }

    public function edit(string $id)
    {
        $medidas = UnidadMedida::all();
        $proveedores = Proveedor::all();
        $Departamentos = Departamento::all();
        $Entrada = Entrada::where('id_entrada', $id)->firstOrFail();
        $detallentradas = DetalleEntrada::where('entrada_id', $Entrada->id_entrada)->get();
        $articulos = [];
        foreach ($detallentradas as $detalle) {
            $articulo = Inventario::find($detalle->articulo_id);
            if ($articulo) {
                $articulos[] = $articulo;
            }
        }
        return view('Almacen.Entradas.edit', compact('Entrada', 'medidas', 'proveedores', 'Departamentos', 'articulos'));
    }

    public function update(Request $request, string $id)
    {
        $Entrada = Entrada::where('id_entrada', $id)->firstOrFail();
        $Entrada->factura = $request->factura;
        $Entrada->entrega = $request->entrega;
        $Entrada->cargoentrega = $request->cargoentrega;
        $Entrada->folio = $request->folio;
        $Entrada->fechaentrada = $request->fechaentrada;
        $Entrada->fechafactura = $request->fechafactura;
        $Entrada->departamento_id = $request->departamento_id;
        $Entrada->proveedor_id = $request->proveedor_id;
        $Entrada->empleado_num = auth()->user()->empleado_num;
        $Entrada->save();

        $detallesEntrada = $Entrada->detalles()->get();

        $Entrada->detalles()->delete();

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
            $Entrada->detalles()->create([
                'articulo_id' => $articulo->id_articulo,
            ]);
        }
        return redirect()->route('Entradas.index');
    }


    public function generarPDF($id)
    {
        $Entrada = Entrada::find($id);
        $detallentradas = DetalleEntrada::where('entrada_id', $Entrada->id_entrada)->get();
        $articulos = [];
        foreach ($detallentradas as $detalle) {
            $articulo = Inventario::find($detalle->articulo_id);
            if ($articulo) {
                $articulos[] = $articulo;
            }
        }

        $pdf = Pdf::loadView('Almacen.Entradas.pdf.pdf', compact('Entrada', 'articulos'));
        $pdf->setPaper('letter', 'landscape');
        $pdf->render();
        return $pdf->stream('Entrada_' . $id . '.pdf');
    }
}
