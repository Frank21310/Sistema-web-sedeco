<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\inventario;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Total de artículos en inventario
        $totalArticulos = Inventario::count();

        // Total de artículos por categoría
        $categorias = Categoria::withCount('inventario')->get();

        // Artículo por agotarse (suponiendo que existe un campo 'salida' que indica la cantidad de salida de un artículo)
        $articuloPorAgotarse = Inventario::where('existencia', '>', 0)->whereRaw('cantidad - salida <= ?', [10])->get();

        return view('home', compact('totalArticulos', 'categorias', 'articuloPorAgotarse'));
    }
}
