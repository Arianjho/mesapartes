<?php

use App\Http\Controllers\DiccionarioController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\IncidenciaController;
use App\Http\Controllers\IncidenciaOSIController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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
    return redirect('/incidencias');
});

Route::get('iniciar-sesion', function () {
    if (Session::has('usuario')) {
        return redirect('/incidencias');
    } else {
        if (request()->ajax()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }
    return view('seguridad.login');
});

Route::post('seguridad/login', [UsuarioController::class, 'login'])->name('seguridad.login');
Route::get('seguridad/logout', [UsuarioController::class, 'logout'])->name('seguridad.logout');

Route::prefix('')->middleware(['hasUserSession'])->group(function () {
    Route::get('incidencias', [IncidenciaController::class, 'index'])->name('incidencias.list');
    Route::post('incidencias', [IncidenciaController::class, 'index'])->name('incidencias.list');
    Route::post('incidencias/show', [IncidenciaController::class, 'show'])->name('incidencias.show');
    Route::post('incidencias/review', [IncidenciaController::class, 'revisar'])->name('incidencias.review');
    Route::post('incidencias/edit', [IncidenciaController::class, 'pendiente'])->name('incidencias.edit');
    Route::post('incidencias/import', [IncidenciaController::class, 'importar'])->name('incidencias.import');

    Route::get('incidenciasose', [IncidenciaOSIController::class, 'index'])->name('incidenciasose.list');
    Route::post('incidenciasose/show', [IncidenciaOSIController::class, 'show'])->name('incidenciasose.show');
    Route::post('incidenciasose/review', [IncidenciaOSIController::class, 'revisar'])->name('incidenciasose.review');
    Route::post('incidenciasose/edit', [IncidenciaOSIController::class, 'pendiente'])->name('incidenciasose.edit');
    Route::post('incidenciasose/import', [IncidenciaOSIController::class, 'importar'])->name('incidenciasose.import');

    Route::get('usuarios', [UsuarioController::class, 'index'])->name('usuarios');
    Route::post('usuarios/create', [UsuarioController::class, 'store'])->name('usuarios.store');
    Route::post('usuarios/edit', [UsuarioController::class, 'edit'])->name('usuarios.edit');
    Route::post('usuarios/delete', [UsuarioController::class, 'destroy'])->name('usuarios.delete');

    Route::get('clientes', [EmpresaController::class, 'index'])->name('clientes.list');
    Route::post('empresas/create', [EmpresaController::class, 'create'])->name('empresas.create');
    Route::post('clientes/change', [EmpresaController::class, 'cambiar'])->name('clientes.change');
    Route::post('clientes/review', [EmpresaController::class, 'revisar'])->name('clientes.review');
    Route::post('clientes/import', [EmpresaController::class, 'importar'])->name('clientes.import');

    Route::get('diccionario', [DiccionarioController::class, 'index'])->name('diccionario');
    Route::post('diccionario/create', [DiccionarioController::class, 'store'])->name('diccionario.store');
    Route::post('diccionario/edit', [DiccionarioController::class, 'edit'])->name('diccionario.edit');
    Route::post('diccionario/delete', [DiccionarioController::class, 'destroy'])->name('diccionario.delete');

    Route::get('/api', function () {
        return view('api/index');
    })->name('api');
    Route::get('/tickets', function () {
        return view('tickets.index');
    })->name('tickets');
});
