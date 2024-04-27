@php
    
@endphp

<!DOCTYPE html>
<html>
    <head></head>
    <body>
        <h1>Usuario Creado</h1>
        <p>Se ha creado un nuevo usuario para la empresa {{$empresa->nombre}}, centro {{ $centro->nombre}} con la siguiente información:</p>
        <ul>
            <li>ID del usuario: {{ $user->id }}</li>
            <li>Nombre del Usuario: {{ $user->name }}</li>
            <li>Email: {{ $user->email }}</li>
            <li>Contraseña: {{ $user->password }}</li>
            <!-- Agrega más detalles del movimiento aquí -->
        </ul>
    </body>
</html>