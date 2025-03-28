<?php

use App\Http\Controllers\CarroController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ModeloController;
use App\Http\Controllers\VendaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::resource('marcas', MarcaController::class)->except('show');
Route::resource('modelos', ModeloController::class)->except('show');
Route::resource('carros', CarroController::class)->except('show');
// Route::post('carros/{id}/marcar-vendido', [CarroController::class, 'marcarComoVendido'])->name('carros.marcar_vendido');
Route::resource('vendas', VendaController::class)->only(['index', 'create', 'store', 'destroy']);
