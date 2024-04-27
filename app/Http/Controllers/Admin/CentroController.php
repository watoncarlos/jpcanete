<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Centro;
use App\Models\Empresa;
use App\Models\Estado;
use App\Models\Movimiento;
use App\Models\MovimientoDet;
use Illuminate\Support\Facades\DB;

class CentroController extends Controller
{
    public function store(Request $request){
        $centro = new Centro();
        
        $centro->areaId = $request->areaId;
        $centro->empresaId = $request->empresaId;
        $centro->nombre = $request->nombre;
        $centro->codigo_bodega = $request->codigo_bodega;
        $centro->ceco = $request->ceco;
        $centro->inicio = $request->inicio;
        $centro->latitud = $request->latitud;
        $centro->longitud = $request->longitud;
        $centro->estadoId = $request->estadoId;
        
        $activosSeleccionados = implode(',', $request->input('activos', []));
        $centro->activos = $activosSeleccionados;

        $centro->save();

        return redirect('Centros')->with('success', 'Centro creado correctamente!');
    }

    public function edit(Centro $centro){

        return view('centros_edit', compact('centro'));

    }

    public function update(Request $request, Centro $centro){

        $centro->areaId = $request->areaId;
        $centro->empresaId = $request->empresaId;
        $centro->nombre = $request->nombre;
        $centro->codigo_bodega = $request->codigo_bodega;
        $centro->ceco = $request->ceco;
        $centro->inicio = $request->inicio;
        $centro->latitud = $request->latitud;
        $centro->longitud = $request->longitud;
        $centro->estadoId = $request->estadoId;

        $centro->save();

        return redirect('ListaCentros')->with('success', 'Centro Editado Correctamente!');

    }

    public function getFilteredData(Request $request){
        $fecha = $request->input('fecha');
        $centroId = $request->input('centroId');
        $tipoTabla = $request->input('tipoTabla');
        $empresaId = $request->input('empresaId');

        $query = Centro::query();
        
        // Aplica los filtros según los valores proporcionados
        if ($fecha) {
            $query->where('inicio', '=', $fecha);
        }

        if ($centroId) {
            $query->where('id', '=', $centroId);
        }

        if($empresaId != 0){
            $query->where('empresaId', '=', $empresaId);
        }

        // Obtén los datos filtrados
        $data = $query->get();

        // Formatea los datos según tus necesidades
        $formattedData = [];

        foreach ($data as $centro) {
            $empresa = Empresa::where('id', $centro->empresaId)
                ->first();

            $estado = Estado::where('id', $centro->estadoId)
                ->first();

            $formattedData[] = [
                $centro->id,
                $centro->nombre,
                $centro->codigo_bodega,
                $centro->inicio,
                $estado->nombre,
                $empresa->nombre
            ];
        }

        return response()->json(['data' => $formattedData]);
    }

    public function reporte(Request $request){

        $empresaFilter = $request->input('empresaFilter');
        $centroId = $request->input('centroId');
        $tipoTabla = $request->input('tipoTabla');
        $empresaId = $request->input('empresaId');

        // Formatea los datos según tus necesidades
        $formattedData = [];

        $resultado = Centro::select('centros.id as centroId', 'centros.nombre as nombre_centro')
            ->join('movimientos', 'centros.id', '=', 'movimientos.centroId')
            ->leftJoin('movimientos_det', 'movimientos.id', '=', 'movimientos_det.id_movimiento')
            ->join('activos', 'movimientos_det.id_activo', '=', 'activos.id')
            ->selectRaw('SUM(COALESCE(CASE WHEN movimientos.tipo_guia = "entrada" THEN movimientos_det.cantidad ELSE 0 END, 0) - 
                  COALESCE(CASE WHEN movimientos.tipo_guia = "salida" THEN movimientos_det.cantidad ELSE 0 END, 0)) AS total_activos')
            ->selectRaw('SUM(COALESCE(CASE WHEN movimientos.tipo_guia = "entrada" THEN movimientos_det.cantidad * activos.valor ELSE 0 END, 0) - 
                        COALESCE(CASE WHEN movimientos.tipo_guia = "salida" THEN movimientos_det.cantidad * activos.valor ELSE 0 END, 0)) AS total_valores')
            ->groupBy('centros.id')
            ->orderBy('centros.id', 'asc')
            ->get();

        foreach ($resultado as $data) {
                
            $formattedData[] = [
                $data->centroId,
                $data->nombre_centro,
                $data->total_activos,
                $data->total_valores
            ];

        }

        return response()->json(['data' => $formattedData]);
    }

    public function grafico_centro_x_activo(Request $request){
        $activosActuales = Centro::select('centros.id as centroId', 'centros.nombre as nombre_centro')
            ->join('movimientos', 'centros.id', '=', 'movimientos.centroId')
            ->leftJoin('movimientos_det', 'movimientos.id', '=', 'movimientos_det.id_movimiento')
            ->join('activos', 'movimientos_det.id_activo', '=', 'activos.id')
            ->selectRaw('SUM(COALESCE(CASE WHEN movimientos.tipo_guia = "entrada" THEN movimientos_det.cantidad ELSE 0 END, 0) - 
                  COALESCE(CASE WHEN movimientos.tipo_guia = "salida" THEN movimientos_det.cantidad ELSE 0 END, 0)) AS total_activos')
            ->selectRaw('SUM(COALESCE(CASE WHEN movimientos.tipo_guia = "entrada" THEN movimientos_det.cantidad * activos.valor ELSE 0 END, 0) - 
                        COALESCE(CASE WHEN movimientos.tipo_guia = "salida" THEN movimientos_det.cantidad * activos.valor ELSE 0 END, 0)) AS total_valores')
            ->groupBy('centros.id')
            ->orderBy('centros.id', 'asc')
            ->get();

        //dd($activosActuales);

        return response()->json(['activosActuales' => $activosActuales]);
    }

    public function getCentrosByEmpresa($empresaIds){

        // Obtiene los IDs de empresas desde la solicitud
        $empresaBuscar = explode(',', $empresaIds);
        // Realiza la lógica para obtener los centros correspondientes a las empresas seleccionadas
        $centros = Centro::whereIn('empresaId', $empresaBuscar)->get();

        return response()->json($centros);
    }

    public function detalles_activos($centroId){
        $resultados = DB::table('movimientos')
            ->join('movimientos_det', 'movimientos.id', '=', 'movimientos_det.id_movimiento')
            ->join('activos', 'movimientos_det.id_activo', '=', 'activos.id') // Agregar un JOIN con la tabla 'activos'
            ->select(
                'movimientos.centroId',
                'movimientos_det.id_activo',
                'activos.nombre as nombre_activo', // Seleccionar el nombre del activo
                DB::raw('SUM(CASE WHEN movimientos.tipo_guia = "entrada" THEN movimientos_det.cantidad ELSE 0 END) as entradas'),
                DB::raw('SUM(CASE WHEN movimientos.tipo_guia = "salida" THEN movimientos_det.cantidad ELSE 0 END) as salidas'),
                DB::raw('SUM(CASE WHEN movimientos.tipo_guia = "entrada" THEN movimientos_det.cantidad ELSE 0 END) - SUM(CASE WHEN movimientos.tipo_guia = "salida" THEN movimientos_det.cantidad ELSE 0 END) as stock_actual')
            )
            ->where('movimientos.centroId', $centroId)
            ->groupBy('movimientos.centroId', 'movimientos_det.id_activo', 'activos.nombre') // Agregar el nombre del activo al GROUP BY
            ->get();

            return response()->json($resultados);
    }

    public function destroy($id){

    }
}
