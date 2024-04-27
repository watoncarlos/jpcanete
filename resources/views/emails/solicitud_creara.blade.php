@php
    
@endphp

<!DOCTYPE html>
<html>
    <head></head>
    <body>
        <h1>Movimiento Creado</h1>
        <p>Se ha creado una nueva solicitud para la empresa {{$empresa->nombre}}, centro {{ $centro->nombre}} con la siguiente información:</p>
        <ul>
            <li>ID de la Solicitud: {{ $solicitud->id }}</li>
            <li>Fecha: {{ $solicitud->fecha }}</li>
            <!-- Agrega más detalles del movimiento aquí -->
        </ul>
    </body>
</html>