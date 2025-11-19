<?php

namespace App\Http\Controllers\Transportes;

use App\Http\Controllers\Controller;
use App\Models\Bitacora;
use Illuminate\Http\Request;

class BitacorasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('SoloTransportes', ['only' => ['index']]);
    }
    public function index(Request $request)
    {
        $Bitacoras = Bitacora::select('*')->orderBy('id_bitacora', 'ASC');
        $limit = (isset($request->limit)) ? $request->limit : 5;

        if (isset($request->search)) {
            $Bitacoras = $Bitacoras->where('id_bitacora', 'like', '%' . $request->search . '%')
                ->orWhere('departamento_id', 'like', '%' . $request->search . '%');
        }
        $Bitacoras = $Bitacoras->paginate($limit)->appends($request->all());
        return view('Transportes.Bitacoras.index', compact('Bitacoras'));
    }
    public function edit($id)
    {
        $bitacora = Bitacora::findOrFail($id);
        return view('bitacoras.edit', compact('Bitacoras'));
    }
}
