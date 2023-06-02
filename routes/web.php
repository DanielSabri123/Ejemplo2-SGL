<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\EjemploController;
use App\Http\Controllers\Ejemplo2Controller;
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

Route::get('/ejemplo', [EjemploController::class, 'index'])->name('ejemplo.index');
Route::post('/ejemplo/store', [EjemploController::class, 'store'])->name('ejemplo.store');
Route::GET('/ejemplo/fetch', [EjemploController::class, 'fetch'])->name('ejemplo.fetch');
Route::GET('/ejemplo/consultar', [EjemploController::class, 'show'])->name('ejemplo.show');
Route::post('/ejemplo/actualizar', [EjemploController::class, 'update'])->name('ejemplo.update');
Route::post('/ejemplo/eliminar', [EjemploController::class, 'destroy'])->name('ejemplo.destroy');

Route::get('/ejemplo2', [Ejemplo2Controller::class, 'index'])->name('ejemplo2.index');
Route::get('/ejemplo2/fetch', [Ejemplo2Controller::class, 'fetch'])->name('ejemplo2.fetch');
Route::post('/ejemplo2/store', [Ejemplo2Controller::class, 'store'])->name('ejemplo2.store');
Route::GET('/ejemplo2/consultar', [Ejemplo2Controller::class, 'show'])->name('ejemplo2.show');
Route::post('/ejemplo2/actualizar', [Ejemplo2Controller::class, 'update'])->name('ejemplo2.update');
Route::post('/ejemplo2/eliminar', [Ejemplo2Controller::class, 'destroy'])->name('ejemplo2.destroy');



