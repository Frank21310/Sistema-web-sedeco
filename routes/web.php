<?php

use App\Http\Controllers\Administrador\EmpleadosController;
use App\Http\Controllers\Administrador\RolesController;
use App\Http\Controllers\Administrador\SoloAdminController;
use App\Http\Controllers\Administrador\UsuariosController;
use App\Http\Controllers\Almacen\Entradas;
use App\Http\Controllers\Almacen\Inventario;
use App\Http\Controllers\Almacen\Salidas;
use App\Http\Controllers\Almacen\SoloAdminController as AlmacenSoloAdminController;
use App\Http\Middleware\SoloAlmacen;
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





})->namespace('root');




Route::group(['middleware' => ['auth']], function () {
    Route::get('/Almancen', [SoloAlmacen::class, 'index'])->name(' administrador');
    Route::resource('/Almancen/Inventario', Inventario::class);
    Route::resource('/Administrador/Entradas', Entradas::class);
    Route::resource('/Administrador/Salidas', Salidas::class);
})->namespace('root');