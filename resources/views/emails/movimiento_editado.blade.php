@php

@endphp
<!DOCTYPE html>
<html>
    <head></head>
    <body>
        <h1>Movimiento Creado</h1>
        <p>Se ha editado el movimiento nº {{ $movimiento->id }}, correspondiente a la guia de despacho {{ $movimiento->guia_despacho }}:</p>
        <ul>
            <li>Fecha: {{ $movimiento->fecha }}</li>
            <li>Empresa: {{ $empresa->nombre }}</li>
            <li>Centro: {{ $centro->nombre }}</li>
            <li>Tipo de movimiento: {{ $movimiento->tipo_movimiento }}</li>
            <!-- Agrega más detalles del movimiento aquí -->
        </ul>
        @if($movimiento->confirmacion_cliente == 1)
            <p>El cliente ha confirmado el movimiento</p>
        @endif
        @if($movimiento->imputacion_cliente == 1)
            <p>El cliente ha imputado el movimiento, para mas detalles visite la plataforma</p>
        @endif
        @if($movimiento->confirmacion_luxmeter == 1)
            <p>Luxmeter ha confirmado el movimiento</p>
        @endif
        @if($movimiento->imputacion_luxmeter == 1)
            <p>Luxmeter ha imputado el movimiento, para mas detalles visite la plataforma</p>
        @endif

    </body>
</html>