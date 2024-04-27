<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\CentroController;
use App\Http\Controllers\Admin\GestionController;

use App\Http\Controllers\Admin\UserController;
use App\Mail\MovimientoCreado;

Route::get('', [HomeController::class, 'index']);

Route::get('Gestiones', [HomeController::class, 'gestiones']);
Route::get('ListaGestiones', [HomeController::class, 'lista_gestiones']);
Route::post('gestiones_store', [GestionController::class, 'store'])->name('gestiones.store');
Route::get('gestiones_edit/{Gestion}', [GestionController::class, 'edit'])->name('gestiones.edit');
Route::put('gestiones_update/{Gestion}', [GestionController::class, 'update'])->name('gestiones.update');
Route::delete('gestion/eliminar/{id}', [GestionController::class, 'destroy'])->name('gestiones.destroy');
Route::post('gestion/getAll', [GestionController::class, 'getAll'])->name('gestion.getAll');


Route::get('Centros', [HomeController::class, 'centros']);
Route::get('ListaCentros', [HomeController::class, 'lista_centros']);
Route::get('SetDiasCentros', [HomeController::class, 'dias_centros']);
Route::post('centros_store', [CentroController::class, 'store'])->name('centros.store');
Route::get('centros_edit/{centro}', [CentroController::class, 'edit'])->name('centros.edit');
Route::put('centros_update/{centro}', [CentroController::class, 'update'])->name('centros.update');
Route::post('centro/getFilteredData', [CentroController::class, 'getFilteredData'])->name('centro.getFilteredData');
Route::post('centro/reporte', [CentroController::class, 'reporte'])->name('centro.reporte');
Route::get('centro/{GestionId}', [CentroController::class, 'getCentrosByGestion']);
Route::get('centro/detalles_activos/{centroId}', [CentroController::class, 'detalles_activos']);
Route::delete('centro/eliminar/{id}', [CentroController::class, 'destroy'])->name('centros.destroy');

Route::get('pruebas', [CentroController::class, 'detalles_activos']);

Route::get('Reportes', [HomeController::class, 'reportes']);
Route::get('ReportesGuias', [HomeController::class, 'reportes_guias']);
Route::get('GraficoCentros', [CentroController::class, 'grafico_centro_x_activo']);

Route::get('Users', [HomeController::class, 'users']);
Route::post('user/listar', [UserController::class, 'listar'])->name('user.listar');
Route::post('user/store', [UserController::class, 'store'])->name('user.store');
Route::get('user/detalle/{id}', [UserController::class, 'detalle'])->name('usuario.detalle');


Route::get('detalle_movimiento/{movimientoId}', [MovimientoDetController::class, 'detalle']);

Route::get('notificacionMovimiento', function(){

    Mail::to('csoto@pclink.cl')->send(new MovimientoCreado);

    return "Mensaje Enviado";

})->name('notificacionMovimiento');
