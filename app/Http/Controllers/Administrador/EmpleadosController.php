<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use App\Models\Cargo;
use App\Models\Empleado;
use Illuminate\Http\Request;

class EmpleadosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('SoloAdministrador', ['only' => ['index']]);
    }
    public function index(Request $request)
    {
        $cargos = Cargo::all();
        $Empleados = Empleado::select('*')->orderBy('num_empleado', 'ASC');
        $limit = (isset($request->limit)) ? $request->limit : 5;

        if (isset($request->search)) {
            $Empleados = $Empleados->where('num_empleado', 'like', '%' . $request->search . '%')
                ->orWhere('nombre', 'like', '%' . $request->search . '%')
                ->orWhere('apellido_paterno', 'like', '%' . $request->search . '%')
                ->orWhere('apellido_materno', 'like', '%' . $request->search . '%')
                ->orWhere('cargo_id', 'like', '%' . $request->search . '%');
        }
        $Empleados = $Empleados->paginate($limit)->appends($request->all());
        return view('Administrador.Empleados.index', compact('Empleados','cargos'));
    }
    public function store(Request $request)
    {
        $Empleado = new Empleado();
        $Empleado = $this->createUpdateEmpleado($request, $Empleado);
        return redirect()
            ->route('Empleados.index');
    }
    public function createUpdateEmpleado(Request $request, $Empleado)
    {
        $Empleado->num_empleado = $request->num_empleado;
        $Empleado->nombre = $request->nombre;
        $Empleado->apellido_paterno = $request->apellido_paterno;
        $Empleado->apellido_materno = $request->apellido_materno;
        $Empleado->cargo_id = $request->cargo_id;
        $Empleado->save();
        return  $Empleado;
    }
    public function edit(string $id)
    {
        $cargos = Cargo::all();
        $Empleado = Empleado::where('num_empleado', $id)->firstOrFail();
        return view('Administrador.Empleados.edit', compact('Empleado', 'cargos'));
    }
    public function update(Request $request, string $id)
    { {
            $Empleado = Empleado::where('num_empleado', $id)->firstOrFail();
            $Empleado = $this->createUpdateEmpleado($request, $Empleado);
            return redirect()
                ->route('Empleados.index');
        }
    }
    public function destroy(string $id)
    {
        try {
            $Empleado = Empleado::findOrFail($id);
            $Empleado->delete();

            return redirect()->route('Empleados.index');
        } catch (\Exception $e) {
            // Maneja la excepción aquí (puedes mostrar un mensaje de error, registrar la excepción, etc.)
            return redirect()->route('Empleados.index')->with('error', 'No se pudo eliminar el registro.');
        }
    }
}
