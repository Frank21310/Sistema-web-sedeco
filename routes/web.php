<?php

use App\Http\Controllers\Administrador\EmpleadosController;
use App\Http\Controllers\Administrador\RolesController;
use App\Http\Controllers\Administrador\SoloAdminController;
use App\Http\Controllers\Administrador\UsuariosController;
use App\Http\Controllers\Almacen\Entradas;
use App\Http\Controllers\Almacen\Inventario;
use App\Http\Controllers\Almacen\Salidas;
use App\Http\Controllers\Almacen\SoloAdminController as AlmacenSoloAdminController;
use App\Http\Controllers\Almacen\ValesController;
use App\Http\Controllers\Peticiones\Solicitud;
use App\Http\Middleware\SoloAlmacen;
use App\Models\Salida;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/Administrador', [SoloAdminController::class, 'index'])->name(' administrador');
    Route::resource('/Administrador/Roles', RolesController::class);
    Route::resource('/Administrador/Empleados', EmpleadosController::class);
    Route::resource('/Administrador/Usuarios', UsuariosController::class);

})->namespace('Administrador');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/Almancen', [SoloAlmacen::class, 'index'])->name(' administrador');
    Route::resource('/Almancen/Inventario', Inventario::class);
    // Rutas para generar reportes
    Route::get('/Almacen/Inventario/generar-reporte-general', [Inventario::class, 'generarReporteGeneral'])->name('almacen.inventario.generar-reporte-general');
    Route::get('/Almacen/Inventario/generar-reporte-categoria/{categoria}', [Inventario::class, 'generarReporteCategoria'])->name('almacen.inventario.generar-reporte-categoria');
    Route::resource('/Almancen/Entradas', Entradas::class);
    Route::resource('/Almancen/Vales', ValesController::class);
    Route::get('/Almancen/Vales//buscar-articulos', [ValesController::class, 'buscarArticulos'])->name('buscarArticulos');
    
    Route::get('/Almancen/Entradas/generar-pdf/{id}', [Entradas::class, 'generarPDF'])->name('generar.pdf');
    Route::get('/Almancen/Salidas/generar-pdf/{id}', [Salidas::class, 'generarSalidaPDF'])->name('generarsalida.pdf');
    Route::get('/Almancen/Vales/generar-pdf/{id}', [ValesController::class, 'generarvalePDF'])->name('generarvalePDF.pdf');

    Route::resource('/Almancen/Salidas', Salidas::class);
})->namespace('Almancen');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('/Peticiones/Solicitudes', Solicitud::class);

})->namespace('Peticiones');