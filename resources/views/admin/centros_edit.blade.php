@extends('adminlte::page')

@section('title', 'Dashboard Principal')

@section('content_header')
    <h1>Edición de Centros</h1>
@stop

@section('content')
    <p>Editar Centro</p>

    <form action="{{route('centros.update', $centro)}}" method="post">
        
        @csrf
        @method('put')

        <x-adminlte-select2 name="empresaId" label="Cliente" class=".custom-width-select2">
            <option value="{{ $centro->empresaId }}">{{ $centro->empresaId }}</option>
            @foreach ($empresas as $empresa)
                <option value="{{ $empresa['id'] }}">{{ $empresa['nombre'] }}</option>
            @endforeach
        </x-adminlte-select2>
        <div class="row">
            <x-adminlte-input name="nombre_centro" label="Nombre Centro" value="{{ $centro->nombre_centro }}" placeholder="Escribe aquí el nombre del Centro"
                fgroup-class="col-md-6" disable-feedback/>
        </div>
        <x-adminlte-select2 name="areaId" label="Area" class=".custom-width-select2">
            <option value="{{ $centro->areaId }}">{{ $centro->areaId }}</option>
            @foreach ($areas as $area)
                <option value="{{ $area['id'] }}">{{ $area['nombre'] }}</option>
            @endforeach
        </x-adminlte-select2>
        <div class="row">
            <x-adminlte-input name="codigo_bodega" label="Codigo Bodega" value="{{ $centro->codigo_bodega }}" placeholder="Escribe aquí el codigo de bodega"
                fgroup-class="col-md-6" disable-feedback/>
        </div>
        <div class="row">
            <x-adminlte-input name="ceco" label="Centro de Costo" value="{{ $centro->ceco }}" placeholder="Escribe aquí el centro de costo"
                fgroup-class="col-md-6" disable-feedback/>
        </div>
        <label>Fecha Inicio</label>
        <br>
        <input type="date" name="inicio" label="Fecha Inicio" placeholder="Escoge una fecha..." value="{{ $centro->inicio }}">
        <br>
        <div class="row">
            <x-adminlte-input type="number" name="latitud" label="Latitud" placeholder="Escribe aquí la latitud" value="{{ $centro->latitud }}"
                fgroup-class="col-md-6" disable-feedback/>
        </div>
        <div class="row">
            <x-adminlte-input type="number" name="longitud" label="Longitud" placeholder="Escribe aquí la longitud" value="{{ $centro->longitud }}"
                fgroup-class="col-md-6" disable-feedback/>
        </div>
        <x-adminlte-select2 name="estadoId" label="Estado" class=".custom-width-select2">
            <option value="{{ $centro->estado }}">{{ $centro->estado }}</option>
            @foreach ($estados as $estado)
                <option value="{{ $estado['id'] }}">{{ $estado['nombre'] }}</option>
            @endforeach
        </x-adminlte-select2>
        <x-adminlte-button class="btn-flat" type="submit" label="Actualizar" theme="success" icon="fas fa-lg fa-save"/>
    </form>
    @include('sweetalert::alert')
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> 
        //sección de código para controlar accesos de usuarios
        var tipoUser = '{{ auth()->user()->getRoleNames()->first(); }}';

        // Objeto que mapea roles con los elementos que deben ocultarse
        var elementosPorRol = {
            'cliente': ['Gestion de Usuarios', 'Mantenedores', 'Change Password', 'Reportes'],
            'cliente-admin': ['Gestion de Usuarios', 'Mantenedores', 'Change Password', 'Ingresar Movimiento']
        };

        // Verifica si el usuario tiene un rol conocido
        if (tipoUser && elementosPorRol[tipoUser]) {
            // Itera sobre los elementos asociados al rol y oculta las etiquetas <a> correspondientes
            elementosPorRol[tipoUser].forEach(function(elemento) {
                $("p:contains('" + elemento + "')").each(function() {
                    $(this).closest('a').hide();
                });
            });
        }
    </script>
@stop