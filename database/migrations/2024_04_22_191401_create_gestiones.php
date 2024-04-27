<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('gestiones', function (Blueprint $table) {
            $table->id();
            $table->integer('monto_venta');
            $table->string('estado_pago');
            $table->date('fecha_solicitud');
            $table->string('email_cliente_directo');
            $table->string('email_identidad_comercial');
            $table->date('fecha_inicio');
            $table->date('fecha_termino');
            $table->time('hora_inicio');
            $table->time('hora_termino');
            $table->text('comentario_reserva');
            $table->date('fecha_pago');
            $table->string('servicio_actividad');
            $table->integer('cantidad_clientes');
            $table->string('nombre_cliente');
            $table->string('idioma_cliente');
            $table->string('transporte_relacionado');
            $table->string('item_relacionado');
            $table->text('respaldo_cliente_directo');
            $table->text('respaldo_primer_proveedor');
            $table->text('respaldo_segundo_proveedor');
            $table->string('locacion');
            $table->text('notas');
            $table->string('cliente_emisivo');
            $table->string('folio_cliente');
            $table->integer('tarifa_primer_proveedor');
            $table->integer('tarifa_segundo_proveedor');
            $table->string('rol_primer_proveedor');
            $table->string('rol_segundo_proveedor');
            $table->string('nombre_primer_proveedor');
            $table->string('nombre_segundo_proveedor');
            $table->string('telefono_primer_proveedor');
            $table->string('telefono_segundo_proveedor');
            $table->string('estado_pago_primer_proveedor');
            $table->string('estado_pago_segundo_proveedor');
            $table->string('fecha_pago_primer_proveedor');
            $table->string('fecha_pago_segundo_proveedor');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gestiones');
    }
};
