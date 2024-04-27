<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Activo;
use App\Models\Gestion;
use App\Models\Centro;
use App\Models\Movimiento;
use App\Models\MovimientoDet;
use App\Models\Solicitud;
use App\Models\SolicitudDet;
use App\Models\Area;
use App\Models\Estado;
use App\Models\User;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{
    public function index(){
        $gestiones = Gestion::all();   
        
        return view('admin.index', compact('gestiones'));
    }

    public function gestiones(){
        return view('admin.gestiones');
    }

    public function movimientos(){

        $activos  = Activo::all();
        $centros  = Centro::all();
        $empresas = Empresa::all();
       
        return view('admin.movimientos', compact('activos','centros','empresas'));
    }


    public function lista_gestiones(){

        return view('admin.lista_gestiones');
    }


    public function reportes(){

    
       /* $activosActuales = Centro::select('centros.id as centroId', 'centros.nombre as nombre_centro')
        ->join('movimientos', 'centros.id', '=', 'movimientos.centroId')
        ->leftJoin('movimientos_det', 'movimientos.id', '=', 'movimientos_det.id_movimiento')
        ->join('activos', 'movimientos_det.id_activo', '=', 'activos.id')
        ->selectRaw('SUM(COALESCE(CASE WHEN movimientos.tipo_guia = "entrada" THEN movimientos_det.cantidad ELSE 0 END, 0) - 
                    COALESCE(CASE WHEN movimientos.tipo_guia = "salida" THEN movimientos_det.cantidad ELSE 0 END, 0)) AS total_activos')
        ->groupBy('centros.id')
        ->orderBy('centros.id', 'asc')
        ->get();*/

        return view('admin.reportes', compact('activos','centros','empresas','movimientos','movimientos_det','activosActuales'));
    }

}
