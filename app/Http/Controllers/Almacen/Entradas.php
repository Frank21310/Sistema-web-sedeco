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
use Dompdf\Dompdf;

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

        $Entradas = Entrada::select('*')->orderBy('id_entrada', 'ASC');
        $limit = (isset($request->limit)) ? $request->limit : 4;

        if (isset($request->search)) {
            $Entradas = $Entradas->where('id_entrada', 'like', '%' . $request->search . '%')
                ->orWhere('proveedor_id', 'like', '%' . $request->search . '%');
        }
        $Entradas = $Entradas->paginate($limit)->appends($request->all());
        return view('Almacen.Entradas.index', compact('Entradas', 'medidas', 'proveedores', 'Departamentos'));
    }

    public function store(Request $request)
    {
        $entrada = new Entrada();
        $entrada->factura = $request->factura;
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
        $Entrada->folio = $request->folio;
        $Entrada->fechaentrada = $request->fechaentrada;
        $Entrada->fechafactura = $request->fechafactura;
        $Entrada->departamento_id = $request->departamento_id;
        $Entrada->proveedor_id = $request->proveedor_id;
        $Entrada->empleado_num = auth()->user()->empleado_num;
        $Entrada->save();

        // Eliminar detalles de artículos existentes asociados a la entrada
        $Entrada->detalles()->delete();

        // Iterar sobre los detalles de los artículos del formulario y agregarlos a la entrada
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

    public function destroy(string $id)
    {
        try {
            $Entrada = Entrada::findOrFail($id);
            $Entrada->delete();

            return redirect()->route('Entradas.index');
        } catch (\Exception $e) {
            return redirect()->route('Entradas.index')->with('error', 'No se pudo eliminar el registro.');
        }
    }

    public function generarPDF($id)
    {
        $Entrada = Entrada::find($id);
        
        $pdf = new Dompdf();
        $pdf->loadHtml(view('Almacen.Entradas.pdf.pdf', compact('Entrada')));
        $pdf->getOptions()->setIsPhpEnabled(true);
        $pdf->setPaper('letter', 'landscape');
        $pdf->render();
        return $pdf->stream('Entrada.pdf');
    }
}
