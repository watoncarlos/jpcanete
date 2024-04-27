<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gestion;
use Illuminate\Http\Request;

class GestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $gestion = new Gestion();

        $gestion->monto_venta = $request->monto_venta;
        $gestion->estado_pago = $request->estado_pago;
        $gestion->fecha_solicitud = $request->fecha_solicitud;
        $gestion->email_cliente_directo = $request->email_cliente_directo;
        $gestion->email_identidad_comercial = $request->email_identidad_comercial;
        $gestion->fecha_inicio = $request->fecha_inicio;
        $gestion->fecha_termino = $request->fecha_termino;
        $gestion->hora_inicio = $request->hora_inicio;
        $gestion->hora_termino = $request->hora_termino;
        $gestion->comentario_reserva = $request->comentario_reserva;
        $gestion->fecha_pago = $request->fecha_pago;
        $gestion->servicio_actividad = $request->servicio_actividad;
        $gestion->cantidad_clientes = $request->cantidad_clientes;
        $gestion->nombre_cliente = $request->nombre_cliente;
        $gestion->idioma_cliente = $request->indioma_cliente;
        $gestion->transporte_relacionado = $request->transporte_relacionado;
        $gestion->tipo_vehiculo = $request->tipo_vehiculo;
        $gestion->item_relacionado = $request->item_relacionado;
        $gestion->respaldo_cliente_directo = $request->respaldo_cliente_directo;
        $gestion->respaldo_primer_proveedor = $request->respaldo_primer_proveedor;
        $gestion->respaldo_segundo_proveedor = $request->respaldo_segundo_proveedor;
        $gestion->locacion1 = $request->locacion1;
        $gestion->locacion2 = $request->locacion2;
        $gestion->notas = $request->notas;
        $gestion->cliente_emisivo = $request->cliente_emisivo;
        $gestion->folio_cliente = $request->folio_cliente;
        $gestion->tarifa_primer_proveedor = $request->tarifa_primer_proveedor;
        $gestion->tarifa_segundo_proveedor = $request->tarifa_segundo_proveedor;
        $gestion->rol_primer_proveedor = $request->rol_primer_proveedor;
        $gestion->rol_segundo_proveedor = $request->rol_segundo_proveedor;
        $gestion->nombre_primer_proveedor = $request->nombre_primer_proveedor;
        $gestion->nombre_segundo_proveedor = $request->nombre_segundo_proveedor;
        $gestion->telefono_primer_proveedor = $request->telefono_primer_proveedor;
        $gestion->telefono_segundo_proveedor = $request->telefono_segundo_proveedor;
        $gestion->estado_pago_primer_proveedor = $request->estado_pago_primer_proveedor;
        $gestion->estado_pago_segundo_proveedor = $request->estado_pago_segundo_proveedor;
        $gestion->fecha_pago_primer_proveedor = $request->fecha_pago_primer_proveedor;
        $gestion->fecha_pago_segundo_proveedor = $request->fecha_pago_segundo_proveedor;
        $gestion->ref_cliente_directo = $request->ref_cliente_directo;
        $gestion->ref_primer_proveedor = $request->ref_primer_proveedor;
        $gestion->ref_segundo_proveedor = $request->ref_segundo_proveedor;

        $gestion->save();

        return redirect('Gestiones')->with('success', 'Gestion creada correctamente!');
    }

    /**
     * Display the specified resource.
     */
    public function getAll(Request $request)
    {
        $idGestion = $request->input('idGestion');
        $folioGestion = $request->input('folioGestion');
        $nombreCliente = $request->input('nombreCliente');
        $entidadComercial = $request->input('entidadComercial');

      

        $query = Gestion::query();
        
        if($idGestion){
            $query->where('id', '=', $idGestion);
        }
        if($folioGestion){  
            $query->where('folio_cliente', '=', $folioGestion);
        }
        if($nombreCliente){
            $query->where('nombre_cliente', '=', $nombreCliente);
        }
        if($entidadComercial){
            $query->where('email_identidad_comercial', '=', $entidadComercial);
        }


        // Obtén los datos filtrados
        $data = $query->get();

        // Formatea los datos según tus necesidades
        $formattedData = [];

        foreach ($data as $gestion) {
    
            $formattedData[] = [
                $gestion->id,
                $gestion->monto_venta,
                $gestion->estado_pago,
                $gestion->fecha_solicitud,
                $gestion->email_cliente_directo,
                $gestion->email_identidad_comercial,
                $gestion->fecha_inicio,
                $gestion->fecha_termino,
                $gestion->hora_inicio,
                $gestion->hora_termino,
                $gestion->comentario_reserva,
                $gestion->fecha_pago,
                $gestion->servicio_actividad,
                $gestion->cantidad_clientes,
                $gestion->nombre_cliente,
                $gestion->idioma_cliente,
                $gestion->transporte_relacionado,
                $gestion->tipo_vehiculo,
                $gestion->item_relacionado,
                $gestion->respaldo_cliente_directo,
                $gestion->respaldo_primer_proveedor,
                $gestion->respaldo_segundo_proveedor,
                $gestion->locacion1,
                $gestion->locacion2,
                $gestion->notas,
                $gestion->cliente_emisivo,
                $gestion->folio_cliente,
                $gestion->tarifa_primer_proveedor,
                $gestion->tarifa_segundo_proveedor,
                $gestion->rol_primer_proveedor,
                $gestion->rol_segundo_proveedor,
                $gestion->nombre_primer_proveedor,
                $gestion->nombre_segundo_proveedor,
                $gestion->telefono_primer_proveedor,
                $gestion->telefono_segundo_proveedor,
                $gestion->estado_pago_primer_proveedor,
                $gestion->estado_pago_segundo_proveedor,
                $gestion->fecha_pago_primer_proveedor,
                $gestion->fecha_pago_segundo_proveedor,
                $gestion->ref_cliente_directo,
                $gestion->ref_primer_proveedor,
                $gestion->ref_segundo_proveedor,
            ];
        }

        return response()->json(['data' => $formattedData]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gestion $Gestion){

        return view('Gestiones_edit', compact('Gestion'));

    }

    /**
     * Up the specified resource in storage.
     */
    public function up(Request $request, Gestion $Gestion){

        $gestion->nombre  = $request->nombre; 
        $gestion->luxmeterId = $request->luxmeterId;

        $gestion->save();

        return redirect('ListaGestiones')->with('success', 'Gestion Editada Correctamente!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
