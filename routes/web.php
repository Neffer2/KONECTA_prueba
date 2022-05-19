<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\VentasController;
use App\Http\Controllers\ConsultasController;

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

//Rutas para consultas adicionales
Route::get('/max', [ConsultasController::class, 'max']);

//Rutas para el modulo ventas
Route::post('/vender', [VentasController::class, 'vender'])->name('vender');
Route::get('/vender', [VentasController::class, 'index']);

//Rutas para el modulo productos
Route::get('/', [ProductosController::class, 'index']);
Route::resource('productos', ProductosController::class);
  