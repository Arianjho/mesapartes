<?php

use App\Http\Controllers\IncidenciaController;
use App\Http\Controllers\IncidenciaOSIController;
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

Route::get('/', function () {return view('welcome');});
Route::get('incidencias', [IncidenciaController::class, 'index'])->name('incidencias');
Route::get('incidencias/show/{id}', [IncidenciaController::class, 'show']);
Route::post('incidencias/revisar/{id}', [IncidenciaController::class, 'revisar']);
Route::post('incidencias/editar/{id}', [IncidenciaController::class, 'pendiente']);
Route::post('incidencias/importar', [IncidenciaController::class, 'importar'])->name('importar');

Route::get('incidenciasosi', [IncidenciaOSIController::class, 'index'])->name('incidenciasosi');
Route::get('incidenciasosi/show/{id}', [IncidenciaOSIController::class, 'show']);
Route::post('incidenciasosi/revisar/{id}', [IncidenciaOSIController::class, 'revisar']);
Route::post('incidenciasosi/editar/{id}', [IncidenciaOSIController::class, 'pendiente']);
Route::post('incidenciasosi/importar', [IncidenciaOSIController::class, 'importar'])->name('importarosi');