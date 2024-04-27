<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\CentroController;
use App\Http\Controllers\Admin\AreaController;
use App\Http\Controllers\Admin\ActivoController;
use App\Http\Controllers\Admin\EmpresaController;
use App\Http\Controllers\Admin\EspecieController;
use App\Http\Controllers\Admin\ModalidadController;
use App\Http\Controllers\Admin\ModeloProductivoController;
use App\Http\Controllers\Admin\MonitoreoController;
use App\Http\Controllers\Admin\MovimientoController;
use App\Http\Controllers\Admin\MovimientoDetController;
use App\Http\Controllers\Admin\PaiseController;
use App\Http\Controllers\Admin\ProveedorController;
use App\Http\Controllers\Admin\RegionController;
use App\Http\Controllers\Admin\TecnicoController;
use App\Http\Controllers\Admin\TipoCentroController;
use App\Http\Controllers\Admin\TipoLamparaController;
use App\Http\Controllers\Admin\TipoLamparaPisciculturaController;
use App\Http\Controllers\Admin\TrabajoController;
use App\Http\Controllers\Admin\UbicacionLamparaController;
use App\Http\Controllers\Admin\UnidadCultivoController;

Route::get('', [HomeController::class, 'index']);

Route::get('Areas', [HomeController::class, 'areas']);
Route::get('ListaAreas', [HomeController::class, 'lista_areas']);
Route::post('areas_store', [AreaController::class, 'store'])->name('areas.store');
Route::get('areas_edit/{area}', [AreaController::class, 'edit'])->name('areas.edit');
Route::put('areas_update/{area}', [AreaController::class, 'update'])->name('areas.update');

Route::get('Empresas', [HomeController::class, 'empresas']);
Route::get('ListaEmpresas', [HomeController::class, 'lista_empresas']);
Route::post('empresas_store', [EmpresaController::class, 'store'])->name('empresas.store');
Route::get('empresas_edit/{empresa}', [EmpresaController::class, 'edit'])->name('empresas.edit');
Route::put('empresas_update/{empresa}', [EmpresaController::class, 'update'])->name('empresas.update');

Route::get('Centros', [HomeController::class, 'centros']);
Route::get('ListaCentros', [HomeController::class, 'lista_centros']);
Route::get('SetDiasCentros', [HomeController::class, 'dias_centros']);
Route::post('centros_store', [CentroController::class, 'store'])->name('centros.store');
Route::get('centros_edit/{centro}', [CentroController::class, 'edit'])->name('centros.edit');
Route::put('centros_update/{centro}', [CentroController::class, 'update'])->name('centros.update');


Route::get('Modalidades', [HomeController::class, 'modalidades']);
Route::get('ListaModalidades', [HomeController::class, 'lista_modalidades']);
Route::post('modalidades_store', [ModalidadController::class, 'store'])->name('modalidades.store');
Route::get('modalidades_edit/{modalidad}', [ModalidadController::class, 'edit'])->name('modalidades.edit');
Route::put('modalidades_update/{modalidad}', [ModalidadController::class, 'update'])->name('modalidades.update');

Route::get('ModelosProductivos', [HomeController::class, 'modelosProductivos']);
Route::get('ListaModelosProductivos', [HomeController::class, 'lista_modelosProductivos']);
Route::post('modelosProductivos_store', [ModeloProductivoController::class, 'store'])->name('modelosProductivos.store');
Route::get('modelosProductivos_edit/{modeloProductivo}', [ModeloProductivoController::class, 'edit'])->name('modelosProductivos.edit');
Route::put('modelosProductivos_update/{modeloProductivo}', [ModeloProductivoController::class, 'update'])->name('modelosProductivos.update');

Route::get('Monitoreos', [HomeController::class, 'monitoreos']);
Route::get('ListaMonitoreos', [HomeController::class, 'lista_monitoreos']);
Route::post('monitoreos_store', [MonitoreoController::class, 'store'])->name('monitoreos.store');
Route::get('monitoreos_edit/{monitoreo}', [MonitoreoController::class, 'edit'])->name('monitoreos.edit');
Route::put('monitoreos_update/{monitoreo}', [MonitoreoController::class, 'update'])->name('monitoreos.update');


Route::get('Proveedores', [HomeController::class, 'proveedores']);
Route::get('ListaProveedores', [HomeController::class, 'lista_proveedores']);
Route::post('proveedores_store', [ProveedorController::class, 'store'])->name('proveedores.store');
Route::get('proveedores_edit/{proveedor}', [ProveedorController::class, 'edit'])->name('proveedores.edit');
Route::put('proveedores_update/{proveedor}', [ProveedorController::class, 'update'])->name('proveedores.update');

Route::get('Regiones', [HomeController::class, 'regiones']);
Route::get('ListaRegiones', [HomeController::class, 'lista_regiones']);
Route::post('regiones_store', [RegionController::class, 'store'])->name('regiones.store');
Route::get('regiones_edit/{region}', [RegionController::class, 'edit'])->name('regiones.edit');
Route::put('regiones_update/{region}', [RegionController::class, 'update'])->name('regiones.update');

Route::get('Tecnicos', [HomeController::class, 'tecnicos']);
Route::get('ListaTecnicos', [HomeController::class, 'lista_tecnicos']);
Route::post('tecnicos_store', [TecnicoController::class, 'store'])->name('tecnicos.store');
Route::get('tecnicos_edit/{tecnico}', [TecnicoController::class, 'edit'])->name('tecnicos.edit');
Route::put('tecnicos_update/{tecnico}', [TecnicoController::class, 'update'])->name('tecnicos.update');

Route::get('TiposCentros', [HomeController::class, 'tiposCentros']);
Route::get('ListaTiposCentros', [HomeController::class, 'lista_tiposCentros']);
Route::post('tiposCentros_store', [TipoCentroController::class, 'store'])->name('tiposCentros.store');
Route::get('tiposCentros_edit/{tipoCentro}', [TipoCentroController::class, 'edit'])->name('tiposCentros.edit');
Route::put('tiposCentros_update/{tipoCentro}', [TipoCentroController::class, 'update'])->name('tiposCentros.update');

Route::get('TipoLamparas', [HomeController::class, 'tipoLamparas']);
Route::get('ListatipoLamparas', [HomeController::class, 'lista_tipoLamparas']);
Route::post('tipoLamparas_store', [tipoLamparaController::class, 'store'])->name('tipoLamparas.store');
Route::get('tipoLamparas_edit/{tipoLampara}', [tipoLamparaController::class, 'edit'])->name('tipoLamparas.edit');
Route::put('tipoLamparas_update/{tipoLampara}', [tipoLamparaController::class, 'update'])->name('tipoLamparas.update');

Route::get('TipoLamparasPiscicultura', [HomeController::class, 'tipoLamparas']);
Route::get('ListaTipoLamparasPiscicultura', [HomeController::class, 'lista_tipoLamparas']);
Route::post('tipoLamparasPiscicultura_store', [TipoLamparaPisciculturaController::class, 'store'])->name('tipoLamparasPiscicultura.store');
Route::get('tipoLamparasPiscicultura_edit/{tipoLampara}', [TipoLamparaPisciculturaController::class, 'edit'])->name('tipoLamparasPiscicultura.edit');
Route::put('tipoLamparasPiscicultura_update/{tipoLampara}', [TipoLamparaPisciculturaController::class, 'update'])->name('tipoLamparasPiscicultura.update');

Route::get('Trabajos', [HomeController::class, 'trabajos']);
Route::get('ListaTrabajos', [HomeController::class, 'lista_trabajos']);
Route::post('trabajos_store', [TrabajoController::class, 'store'])->name('trabajos.store');
Route::get('trabajos_edit/{trabajo}', [TrabajoController::class, 'edit'])->name('trabajos.edit');
Route::put('trabajos_update/{trabajo}', [TrabajoController::class, 'update'])->name('trabajos.update');

Route::get('UbicacionesLamparas', [HomeController::class, 'ubicacionLamparas']);
Route::get('ListaUbicacionesLamparas', [HomeController::class, 'lista_ubicacionLamparas']);
Route::post('ubicacionesLamparas_store', [UbicacionLamparaController::class, 'store'])->name('ubicacionesLamparas.store');
Route::get('ubicacionesLamparas_edit/{ubicacionLampara}', [UbicacionLamparaController::class, 'edit'])->name('ubicacionesLamparas.edit');
Route::put('ubicacionesLamparas_update/{ubicacionLampara}', [UbicacionLamparaController::class, 'update'])->name('ubicacionesLamparas.update');

Route::get('UnidadesCultivos', [HomeController::class, 'unidadesCultivos']);
Route::get('ListaUnidadesCultivos', [HomeController::class, 'lista_unidadesCultivos']);
Route::post('unidadesCultivos_store', [UnidadCultivoController::class, 'store'])->name('unidadesCultivos.store');
Route::get('unidadesCultivos_edit/{unidadCultivo}', [UnidadCultivoController::class, 'edit'])->name('unidadesCultivos.edit');
Route::put('unidadesCultivos_update/{unidadCultivo}', [UnidadCultivoController::class, 'update'])->name('unidadesCultivos.update');

Route::get('Activos', [HomeController::class, 'activos']);
Route::get('ListaActivos', [HomeController::class, 'lista_activos']);
Route::post('activos_store', [ActivoController::class, 'store'])->name('activos.store');
Route::get('activos_edit/{activo}', [ActivoController::class, 'edit'])->name('activos.edit');
Route::put('activos_update/{activo}', [ActivoController::class, 'update'])->name('activos.update');

Route::get('Movimientos', [HomeController::class, 'movimientos']);
Route::get('ListaMovimientos', [HomeController::class, 'lista_movimientos']);
Route::post('movimientos_store', [MovimientoController::class, 'store'])->name('movimientos.store');
Route::get('movimientos_edit/{movimiento}', [MovimientoController::class, 'edit'])->name('movimientos.edit');
Route::put('movimientos_update/{movimiento}', [MovimientoController::class, 'update'])->name('movimientos.update');
Route::post('movimiento/getFilteredData', [MovimientoController::class, 'getFilteredData'])->name('movimiento.getFilteredData');

Route::post('centro/getFilteredData', [CentroController::class, 'getFilteredData'])->name('centro.getFilteredData');


Route::get('detalle_movimiento/{movimientoId}', [MovimientoDetController::class, 'detalle']);
