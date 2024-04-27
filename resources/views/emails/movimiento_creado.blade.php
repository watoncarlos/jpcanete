@php
    
@endphp

<!DOCTYPE html>
<html>
    <head></head>
    <body>
        <h1>Movimiento Creado</h1>
        <p>Se ha creado un nuevo movimiento para la empresa {{$empresa->nombre}}, centro {{ $centro->nombre}} con la siguiente información:</p>
        <ul>
            <li>ID del movimiento: {{ $movimiento->id }}</li>
            <li>Gúia de despacho: {{ $movimiento->guia_despacho }}</li>
            <li>Fecha: {{ $movimiento->fecha }}</li>
            <li>Tipo Movimiento: {{ $movimiento->tipo_movimiento }}</li>
            <!-- Agrega más detalles del movimiento aquí -->
        </ul>
    </body>
</html>