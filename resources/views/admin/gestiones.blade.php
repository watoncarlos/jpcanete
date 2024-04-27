@extends('adminlte::page')

@section('title', 'Dashboard Principal')

@section('styles')
    <style>
        .custom-width-select2 {
            width: 45%;
            display: inline-block; 
        }
        @media (min-width: 768px) {
            /* Dispositivos de escritorio */
            .custom-input {
                width: 50% !important;
                display: inline-block !important;
                margin-right: 10px !important; /* Ajusta este valor según sea necesario */
            }
        }
        @media (max-width: 767px) {
            /* Dispositivos móviles */
            .custom-input {
                width: 100% !important;
                display: inline-block !important;
                margin-bottom: 10px !important; /* Ajusta este valor según sea necesario */
            }
        }
        .fixed-card {
            position: sticky;
            top: 0;
            z-index: 1000;
        }
    </style>
@endsection

@section('content_header')
    <h1>Ingreso gestión diaria</h1>
@stop

@section('content')
    <form action="{{route('gestiones.store')}}" method="post">
        @csrf

        <div class="card card-info" style="position: sticky; top:0; z-index: 1000;">
            <div class="card-header">
                <h3 class="card-title">Campos Fijos</h3>
                <x-adminlte-button class="btn-flat" type="button" label="Concatenar" theme="success" style="float: right;" id="concatenarBtn"/>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <button id="btnCopiar1" type="button"><i class="far fa-copy"></i></button>
                    <label for="respaldo_cliente_directo">Ref. Cliente Directo</label>
                    <input class="form-control custom-input" type="text" name="ref_cliente_directo" id="ref_cliente_directo"/>
                </div>
                <div class="form-group">
                    <button id="btnCopiar2" type="button"><i class="far fa-copy"></i></button>
                    <label for="respaldo_cliente_directo">Ref. 1er Proveedor</label>
                    <input class="form-control custom-input" type="text" name="ref_primer_proveedor" id="ref_primer_proveedor"/>
                </div>
                <div class="form-group">
                    <button id="btnCopiar3" type="button"><i class="far fa-copy"></i></button>
                    <label for="respaldo_cliente_directo">Ref. 2do Proveedor</label>
                    <input class="form-control custom-input" type="text" name="ref_segundo_proveedor" id="ref_segundo_proveedor"/>
                </div>
                <div class="form-group">
                    <label for="respaldo_cliente_directo">Texto Libre</label>
                    <textarea class="form-control custom-input" name="texto_libre" id="texto_libre" rows="1"></textarea class="form-control custom-input">
                </div>
            </div>
        </div>
        <div class="card card-info" >
            <div class="card-header">
                <h3 class="card-title">Datos Principales</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="">Monto Venta</label>
                    <input class="form-control custom-input" type="number" name="monto_venta" id="monto_venta"/>
                </div>
                <div class="form-group">
                    <label for="">Estado Pago</label>
                    <select name="estado_pago" id="estado_pago" class="form-control custom-input">
                        <option value="">Seleccione</option>
                        <option value="No Facturado">No Facturado</option>
                        <option value="Facturado">Facturado</option>
                        <option value="Pagado">Pagado</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Fecha Solicitud</label>
                    <input class="form-control custom-input" type="date" name="fecha_solicitud" id="fecha_solicitud"/>
                </div>
                <div class="form-group">
                    <label for="">Día de la semana</label>
                    <input class="form-control custom-input" type="text" name="dia_semana_solicitud" id="dia_semana_solicitud"/>
                </div>
                <div class="form-group">
                    <label for="email_cliente_directo">Email Cliente Directo</label>
                    <input class="form-control custom-input" type="text" name="email_cliente_directo" id="email_cliente_directo"/>
                </div>
                <div class="form-group">
                    <label for="email_identidad_comercial">Email Identidad Comercial</label>
                    <input class="form-control custom-input" type="text" name="email_identidad_comercial" id="email_identidad_comercial"/>
                </div>
                <div class="form-group">
                    <label for="fecha_inicio">Fecha Inicio</label>
                    <input class="form-control custom-input" type="date" name="fecha_inicio" id="fecha_inicio"/>
                </div>
                <div class="form-group">
                    <label for="">Día de la semana</label>
                    <input class="form-control custom-input" type="text" name="dia_semana_inicio" id="dia_semana_inicio"/>
                </div>
                <div class="form-group">
                    <label for="">Días para inicio</label>
                    <input class="form-control custom-input" type="text" name="dias_faltantes_inicio" id="dias_faltantes_inicio"/>
                </div>
                <div class="form-group">
                    <label for="">Semana del Año</label>
                    <input class="form-control custom-input" type="number" name="semana_anio" id="semana_anio" readonly/>
                </div>
                <div class="form-group">
                    <label for="fecha_termino">Fecha Termino</label>
                    <input class="form-control custom-input" type="date" name="fecha_termino" id="fecha_termino"/>
                </div>
                <div class="form-group">
                    <label for="">Día de la semana</label>
                    <input class="form-control custom-input" type="text" name="dia_semana_termino" id="dia_semana_termino"/>
                </div>
                <div class="form-group">
                    <label for="">Días para termino</label>
                    <input class="form-control custom-input" type="text" name="dias_faltantes_termino" id="dias_faltantes_termino"/>
                </div>
                <div class="form-group">
                    <label for="hora_inicio">Hora Inicio</label>
                    <input class="form-control custom-input" type="time" name="hora_inicio" id="hora_inicio"/>
                </div>
                <div class="form-group">
                    <label for="hora_termino">Hora Termino</label>
                    <input class="form-control custom-input" type="time" name="hora_termino" id="hora_termino"/>
                </div>
                <div class="form-group">
                    <label for="hora_termino">Duración</label>
                    <input class="form-control custom-input" type="time" name="duracion" id="duracion"/>
                </div>
                <div class="form-group">
                    <label for="comentario_reserva">Comentario Reserva</label>
                    <textarea class="form-control custom-input" name="comentario_reserva" id="comentario_reserva" rows="4"></textarea class="form-control custom-input">
                </div>
                <div class="form-group">
                    <label for="fecha_pago">Fecha Pago</label>
                    <input class="form-control custom-input" type="date" name="fecha_pago" id="fecha_pago"/>
                </div>
                <div class="form-group">
                    <label for="servicio_actividad">Servicio Actividad</label>
                    <input class="form-control custom-input" type="text" name="servicio_actividad" id="servicio_actividad"/>
                </div>
                <div class="form-group">
                    <label for="cantidad_clientes">Cantidad Clientes Insitu</label>
                    <input class="form-control custom-input" type="number" name="cantidad_clientes" id="cantidad_clientes"/>
                </div>
                <div class="form-group">
                    <label for="nombre_cliente">Nombre Cliente Insitu</label>
                    <input class="form-control custom-input" type="text" name="nombre_cliente" id="nombre_cliente"/>
                </div>
                <div class="form-group">
                    <label for="">Idioma Cliente</label>
                    <select name="idioma_cliente" id="idioma_cliente" class="form-control custom-input">
                        <option value="">Seleccione</option>
                        <option value="Español">Español</option>
                        <option value="Inglés">Inglés</option>
                        <option value="Portugués">Portugués</option>
                        <option value="Alemán">Alemán</option>
                        <option value="Frances">Frances</option>
                        <option value="Italiano">Italiano</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="transporte_relacionado">Transporte Relacionado</label>
                    <input class="form-control custom-input" type="text" name="transporte_relacionado" id="transporte_relacionado"/>
                </div>
                <div class="form-group">
                    <label for="transporte_relacionado">Tipo Vehículo</label>
                    <input class="form-control custom-input" type="text" name="tipo_vehiculo" id="tipo_vehiculo"/>
                </div>
                <div class="form-group">
                    <label for="item_relacionado">Item Relacionado</label>
                    <input class="form-control custom-input" type="text" name="item_relacionado" id="item_relacionado"/>
                </div>
                <div class="form-group">
                    <label for="respaldo_cliente_directo">Respaldo Cliente Directo</label>
                    <textarea class="form-control custom-input" name="respaldo_cliente_directo" id="respaldo_cliente_directo" rows="4"></textarea class="form-control custom-input">
                </div>
                <div class="form-group">
                    <label for="respaldo_primer_proveedor">Respaldo Primer Proveedor</label>
                    <textarea class="form-control custom-input" name="respaldo_primer_proveedor" id="respaldo_primer_proveedor" rows="4"></textarea class="form-control custom-input">
                </div>
                <div class="form-group">
                    <label for="respaldo_segundo_proveedor">Respaldo Segundo Proveedor</label>
                    <textarea class="form-control custom-input" name="respaldo_segundo_proveedor" id="respaldo_segundo_proveedor" rows="4"></textarea class="form-control custom-input">
                </div>
                <div class="form-group">
                    <label for="locacion">Locacion 1</label>
                    <input class="form-control custom-input" type="text" name="locacion1" id="locacion1"/>
                </div>
                <div class="form-group">
                    <label for="locacion">Locacion 2</label>
                    <input class="form-control custom-input" type="text" name="locacion2" id="locacion2"/>
                </div>
                <div class="form-group">
                    <label for="notas">Notas</label>
                    <textarea class="form-control custom-input" name="notas" id="notas" rows="4"></textarea class="form-control custom-input">
                </div>
                <div class="form-group">
                    <label for="cliente_emisivo">Cliente Emisivo</label>
                    <input class="form-control custom-input" type="text" name="cliente_emisivo" id="cliente_emisivo"/>
                </div>
                <div class="form-group">
                    <label for="folio_cliente">Folio Cliente</label>
                    <input class="form-control custom-input" type="text" name="folio_cliente" id="folio_cliente"/>
                </div>
            </div> 
        </div> 
        <div class="card card-info" >
            <div class="card-header">
                <h3 class="card-title">Datos Proveedores</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="tarifa_primer_proveedor">Tarifa Primer Proveedor</label>
                    <input class="form-control custom-input" type="number" name="tarifa_primer_proveedor" id="tarifa_primer_proveedor"/>
                </div>
                <div class="form-group">
                    <label for="tarifa_segundo_proveedor">Tarifa Segundo Proveedor</label>
                    <input class="form-control custom-input" type="number" name="tarifa_segundo_proveedor" id="tarifa_segundo_proveedor"/>
                </div>
                <div class="form-group">
                    <label for="rol_primer_proveedor">Rol Primer Proveedor</label>
                    <input class="form-control custom-input" type="text" name="rol_primer_proveedor" id="rol_primer_proveedor"/>
                </div>
                <div class="form-group">
                    <label for="rol_segundo_proveedor">Rol Segundo Proveedor</label>
                    <input class="form-control custom-input" type="text" name="rol_segundo_proveedor" id="rol_segundo_proveedor"/>
                </div>
                <div class="form-group">
                    <label for="nombre_primer_proveedor">Nombre Primer Proveedor</label>
                    <input class="form-control custom-input" type="text" name="nombre_primer_proveedor" id="nombre_primer_proveedor"/>
                </div>
                <div class="form-group">
                    <label for="nombre_segundo_proveedor">Nombre Segundo Proveedor</label>
                    <input class="form-control custom-input" type="text" name="nombre_segundo_proveedor" id="nombre_segundo_proveedor"/>
                </div>
                <div class="form-group">
                    <label for="telefono_primer_proveedor">Telefono Primer Proveedor</label>
                    <input class="form-control custom-input" type="text" name="telefono_primer_proveedor" id="telefono_primer_proveedor"/>
                </div>
                <div class="form-group">
                    <label for="telefono_segundo_proveedor">Telefono Segundo Proveedor</label>
                    <input class="form-control custom-input" type="text" name="telefono_segundo_proveedor" id="telefono_segundo_proveedor"/>
                </div>
                <div class="form-group">
                    <label for="">Estado Pago Primer Proveedor</label>
                    <select name="estado_pago_primer_proveedor" id="estado_pago_primer_proveedor" class="form-control custom-input">
                        <option value="">Seleccione</option>
                        <option value="No Facturado">No Facturado</option>
                        <option value="Facturado">Facturado</option>
                        <option value="Pagado">Pagado</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Estado Pago Segundo Proveedor</label>
                    <select name="estado_pago_segundo_proveedor" id="estado_pago_segundo_proveedor" class="form-control custom-input">
                        <option value="">Seleccione</option>
                        <option value="No Facturado">No Facturado</option>
                        <option value="Facturado">Facturado</option>
                        <option value="Pagado">Pagado</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="fecha_pago_primer_proveedor">Fecha Pago Primer Proveedor</label>
                    <input class="form-control custom-input" type="date" name="fecha_pago_primer_proveedor" id="fecha_pago_primer_proveedor"/>
                </div>
                <div class="form-group">
                    <label for="fecha_pago_segundo_proveedor">Fecha Pago Segundo Proveedor</label>
                    <input class="form-control custom-input" type="date" name="fecha_pago_segundo_proveedor" id="fecha_pago_segundo_proveedor"/>
                </div>
            </div>
        </div>  

        <x-adminlte-button class="btn-flat" type="submit" label="Guardar" theme="success" icon="fas fa-lg fa-save"/>
    </form>
    @include('sweetalert::alert')
@stop

@section('css')
@stop

@section('js')
    <script> 
        // Función para obtener el día de la semana
        function obtenerDiaSemana(fecha) {
            const diasSemana = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
            const fechaSeleccionada = new Date(fecha);
            const dia = fechaSeleccionada.getUTCDay();
            return diasSemana[dia];
        }

        function calcularDiferenciaDias(fecha1, fecha2) {
            const unDia = 1000 * 60 * 60 * 24;
            const fechaInicio = new Date(fecha1);
            const fechaActual = new Date(fecha2);
            const diferencia = Math.round((fechaInicio - fechaActual) / unDia);
            return diferencia;
        }

        // Listener para el cambio de fecha en el input de Fecha Solicitud
        document.getElementById('fecha_solicitud').addEventListener('change', function() {
            const fechaSolicitud = this.value;
            const diaSemana = obtenerDiaSemana(fechaSolicitud);
            document.getElementById('dia_semana_solicitud').value = diaSemana;
        });

        
        function calcularSemanaAnio() {
            var hoy = new Date();
            var primerDia = new Date(hoy.getFullYear(), 0, 1);
            var diferencia = Math.ceil((hoy - primerDia + 1) / 86400000);
            var semana = Math.ceil(diferencia / 7);
            
            document.getElementById('semana_anio').value = semana;
        }

        function calcularFechaPago(fechaInicio, idInput) {
            var fechaInicioValue = document.getElementById(fechaInicio).value;
            if (fechaInicioValue) {
                var fechaInicioObj = new Date(fechaInicioValue);
                fechaInicioObj.setDate(fechaInicioObj.getDate() + 15);
                var fechaPago = fechaInicioObj.toISOString().split('T')[0]; // Formato YYYY-MM-DD
                document.getElementById(idInput).value = fechaPago;
           
            } else {
                document.getElementById(idInput).value = '';
        
            }
        }

        document.getElementById('fecha_inicio').addEventListener('change', function() {
            const fechaInicio = this.value;
            const diaSemana = obtenerDiaSemana(fechaInicio);
            const fechaActual = new Date().toISOString().split('T')[0];
            const diasFaltantes = calcularDiferenciaDias(fechaInicio, fechaActual);
            document.getElementById('dia_semana_inicio').value = diaSemana;
            document.getElementById('dias_faltantes_inicio').value = diasFaltantes;
            calcularFechaPago('fecha_inicio', 'fecha_pago_primer_proveedor');
            calcularFechaPago('fecha_inicio', 'fecha_pago_segundo_proveedor');
        });

        document.getElementById('fecha_termino').addEventListener('change', function() {
            const fechaTermino = this.value;
            const diaSemana = obtenerDiaSemana(fechaTermino);
            const fechaActual = new Date().toISOString().split('T')[0];
            const diasFaltantes = calcularDiferenciaDias(fechaTermino, fechaActual);
            document.getElementById('dia_semana_termino').value = diaSemana;
            document.getElementById('dias_faltantes_termino').value = diasFaltantes;

            var horaInicioInput = document.getElementById('hora_inicio');
            var horaTerminoInput = document.getElementById('hora_termino');
            var duracionInput = document.getElementById('duracion');
            
            // Si la fecha de término cambia, establece los campos como solo lectura
            horaInicioInput.readOnly = true;
            horaTerminoInput.readOnly = true;
            duracionInput.readOnly = true;
        });

        document.getElementById('hora_termino').addEventListener('change', function() {
            const horaTerminoInput = new Date('2000-01-01T' + this.value);
            const horaInicioInput = new Date('2000-01-01T' + document.getElementById('hora_inicio').value);
            
            // Calcula la diferencia en milisegundos
            const diferenciaEnMilisegundos = horaTerminoInput - horaInicioInput;
            
            // Convierte la diferencia en milisegundos a horas y minutos
            const diferenciaEnHoras = Math.floor(diferenciaEnMilisegundos / (1000 * 60 * 60));
            const diferenciaEnMinutos = Math.floor((diferenciaEnMilisegundos % (1000 * 60 * 60)) / (1000 * 60));
            
            // Formatea la diferencia en horas y minutos como HH:mm
            const duracion = pad(diferenciaEnHoras, 2) + ':' + pad(diferenciaEnMinutos, 2);
            
            document.getElementById('duracion').value = duracion;
        });  

        // Función auxiliar para agregar ceros a la izquierda si es necesario
        function pad(num, size) {
            let s = num + "";
            while (s.length < size) s = "0" + s;
            return s;
        }

        document.getElementById('btnCopiar1').addEventListener('click', function() {
            // Seleccionar el contenido del input
            var input = document.getElementById('ref_cliente_directo');
            input.select();
            input.setSelectionRange(0, 99999); // Para dispositivos móviles

            // Copiar el contenido seleccionado al portapapeles
            document.execCommand('copy');

            // Alerta al usuario de que el contenido se ha copiado
            alert('¡Contenido copiado al portapapeles!');
        });

        document.getElementById('btnCopiar3').addEventListener('click', function() {
            // Seleccionar el contenido del input
            var input = document.getElementById('ref_primer_proveedor');
            input.select();
            input.setSelectionRange(0, 99999); // Para dispositivos móviles

            // Copiar el contenido seleccionado al portapapeles
            document.execCommand('copy');

            // Alerta al usuario de que el contenido se ha copiado
            alert('¡Contenido copiado al portapapeles!');
        });

        document.getElementById('btnCopiar3').addEventListener('click', function() {
            // Seleccionar el contenido del input
            var input = document.getElementById('ref_segundo_proveedor');
            input.select();
            input.setSelectionRange(0, 99999); // Para dispositivos móviles

            // Copiar el contenido seleccionado al portapapeles
            document.execCommand('copy');

            // Alerta al usuario de que el contenido se ha copiado
            alert('¡Contenido copiado al portapapeles!');
        });

        window.onload = function() {
            calcularSemanaAnio();

            
        };
    </script>
    <script>
                document.getElementById('concatenarBtn').addEventListener('click', function() {     
                    // Obtener los valores de los inputs
                    var montoVenta = document.getElementById('monto_venta').value;
                    var diaSemanaInicio = document.getElementById('dia_semana_inicio').value;
                    var fechaInicio = document.getElementById('fecha_inicio').value;
                    var nombreInsitu = document.getElementById('nombre_cliente').value;
                    var idiomaInsitu = document.getElementById('idioma_cliente').value;
                    var locacion1 = document.getElementById('locacion1').value;
                    var locacion2 = document.getElementById('locacion2').value;
                    var servicioProducto = document.getElementById('servicio_actividad').value;
                    var transporteRelacionado = document.getElementById('transporte_relacionado').value;
                    var tipoVehiculo = document.getElementById('tipo_vehiculo').value;
                    var tarifaPrimer = document.getElementById('tarifa_primer_proveedor').value;
                    var tarifaSegundo = document.getElementById('tarifa_segundo_proveedor').value; 
                    var rolPrimer = document.getElementById('rol_primer_proveedor').value;
                    var rolSegundo = document.getElementById('rol_segundo_proveedor').value;
                    var fechaPagoPrimer = document.getElementById('fecha_pago_primer_proveedor').value;
                    var fechaPagoSegundo = document.getElementById('fecha_pago_segundo_proveedor').value;

                    
                  
                    // Concatenar los valores
                    var concatenatedValue1 = "Monto: "+ montoVenta +", "+ diaSemanaInicio +", "+ fechaInicio+", "+ nombreInsitu +", Idioma: "+ idiomaInsitu +", Oringen: "+ locacion1 +", Destino: "+ locacion2 +", "+ servicioProducto +", "+ transporteRelacionado +", Vehiculo: "+ tipoVehiculo;
                    
                    var concatenatedValue2 = "Tarifa 1er Proveedor: "+ tarifaPrimer +", "+ diaSemanaInicio +", "+ fechaInicio+", "+ nombreInsitu +", Idioma: "+ idiomaInsitu +", Origen: "+ locacion1 +", Destino: "+ locacion2 +", "+ servicioProducto +", "+ transporteRelacionado +", Vehiculo: "+ tipoVehiculo+", Rol: "+ rolPrimer+", Pago: "+fechaPagoPrimer;
                    
                    var concatenatedValue3 = "Tarifa 2do Proveedor: "+ tarifaSegundo +", "+ diaSemanaInicio +", "+ fechaInicio+", "+ nombreInsitu +", Idioma: "+ idiomaInsitu +", Origen: "+ locacion1 +", Destino: "+ locacion2 +", "+ servicioProducto +", "+ transporteRelacionado +", Vehiculo: "+ tipoVehiculo+", Rol: "+ rolSegundo+", Pago: "+fechaPagoSegundo;
                    
                    document.getElementById('ref_cliente_directo').value = concatenatedValue1;
                    document.getElementById('ref_primer_proveedor').value = concatenatedValue2;
                    document.getElementById('ref_segundo_proveedor').value = concatenatedValue3;
                    
                });
            </script>
@stop