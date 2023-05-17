<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EjemploController;
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

