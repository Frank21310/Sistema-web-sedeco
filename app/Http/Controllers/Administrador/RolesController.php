<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use App\Models\Rol;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('SoloAdministrador', ['only' => ['index']]);
    }
    public function index(Request $request)
    {
        $rols = Rol::select('*')->orderBy('id_rol', 'ASC');
        $limit = (isset($request->limit)) ? $request->limit : 4;

        if (isset($request->search)) {
            $rols = $rols->where('id_rol', 'like', '%' . $request->search . '%')
                ->orWhere('nombre_rol', 'like', '%' . $request->search . '%');
        }
        $rols = $rols->paginate($limit)->appends($request->all());
        return view('Administrador.roles.index', compact('rols'));
    }
    public function create()
    {
        return view('Administrador.roles.create');
    }
    public function store(Request $request)
    {
        $rol = new Rol();
        $rol = $this->createUpdateRol($request, $rol);
        return redirect()
            ->route('roles.index');
    }
    public function createUpdateRol(Request $request, $rol)
    {
        $rol->nombre_rol = $request->nombre_rol;
        $rol->save();
        return  $rol;
    }
    public function show(string $id)
    {
        $rol = Rol::where('id_rol', $id)->firstOrFail();
        return view('Administrador.roles.show', compact('rol', 'permisos'));
    }
    public function edit(string $id)
    {
        $rol = Rol::where('id_rol', $id)->firstOrFail();
        return view('Administrador.roles.edit', compact('rol', 'permisos'));
    }
    public function update(Request $request, string $id)
    { {
            $rol = Rol::where('id_rol', $id)->firstOrFail();
            $rol = $this->createUpdateRol($request, $rol);
            return redirect()
                ->route('roles.index');
        }
    }
    public function destroy(string $id)
    {
        try {
            $rol = Rol::findOrFail($id);
            $rol->delete();

            return redirect()->route('roles.index');
        } catch (\Exception $e) {
            // Maneja la excepción aquí (puedes mostrar un mensaje de error, registrar la excepción, etc.)
            return redirect()->route('roles.index')->with('error', 'No se pudo eliminar el registro.');
        }
    }

}
