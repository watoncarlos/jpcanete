@extends('adminlte::page')

@section('title', 'Dashboard Principal')

@section('content_header')
    <h1>Reporte de guías Pendientes</h1>
@stop

@section('content')
<div class="row">
    <div class="container-fluid"> <!-- Utiliza container-fluid para ocupar el ancho completo -->
        <div class="row mt-6">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title"><b>Filtros de Búsqueda</b></h5>
              </div>
              <div class="card-body">
                <form class="form-inline"> <!-- Utiliza form-inline para que los campos estén en línea -->
                    <div class="form-group ml-2"> <!-- Agrega un espacio entre los campos usando ml-2 -->
                        <label for="empresaFilter" class="mr-2">Nº Guía: </label> <!-- Agrega la clase mr-2 para espacio a la derecha -->
                        <input class="form-control" id="guia_despacho" name="guia_despacho" />
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card tabla-card" style="padding: 10px;">
            <div class="card-header border-0">
                <h3 class="card-title">Guías Pendientes Clientes</h3>
                <div class="card-tools">
                    <a href="#" class="btn btn-tool btn-sm">
                    <i class="fas fa-download"></i>
                    </a>
                    <a href="#" class="btn btn-tool btn-sm">
                    <i class="fas fa-bars"></i>
                    </a>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table id="tabla1" style="width: 100%;">
                    <!-- Contenido de la tabla 1 -->
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card tabla-card" style="padding: 10px;">
            <div class="card-header border-0">
                <h3 class="card-title">Guías Pendientes Luxmeter</h3>
                <div class="card-tools">
                    <a href="#" class="btn btn-tool btn-sm">
                    <i class="fas fa-download"></i>
                    </a>
                    <a href="#" class="btn btn-tool btn-sm">
                    <i class="fas fa-bars"></i>
                    </a>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table id="tabla2" class="table table-striped table-valign-middle">
                   
                </table>
            </div>
        </div>
    </div>
</div>
 <!-- Modal para mostrar detalles -->
 <div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailsModalLabel">Detalles del Movimiento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

@stop

@section('css')
@stop

@section('js')
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
  <script>

    var tipoUser =  '{{ auth()->user()->getRoleNames()->first(); }}';      
    var empresaUser = 0;
    
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

    $(document).ready(function () {
        var tabla = $('#tabla1').DataTable({
                      "processing": true,
                      "serverSide": true,
                      "ajax": {
                          type: 'POST',
                          headers: {
                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                          },
                          url: "{{ route('movimiento.getFilteredData') }}",
                          data: function(d) {
                              d.fecha = $('#fecha').val();
                              d.centroId = $('#centroId').val();
                              d.guia_despacho = $('#guia_despacho').val();
                              d.tipoTabla = 1;
                              d.empresaId = empresaUser;
                          }
                      },
                      "columns": [
                        { data: '0', title: 'ID' },
                        { data: '1', title: 'Guia Despacho' },
                        { data: '2', title: 'Usuario' },
                        { data: '3', title: 'Cliente' },
                        { data: '4', title: 'Centro' },
                        { data: '5', title: 'Detalle' },
                        { data: '6', title: 'Fecha' },
                        { data: '7', title: 'Tipo Movimiento' },
                        {
                            // Columna de acciones (botones)
                            data: null,
                            render: function(data, type, full, meta) {
                                return `
                                    <button class="btn btn-xs btn-default text-teal mx-1 shadow details-button"
                                      onclick="mostrarDetalles(${data[0]})" title="Details">
                                        <i class="fa fa-lg fa-fw fa-eye"></i>
                                    </button>
                                    <a href="movimientos_edit/${data[0]}">
                                        <button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                                            <i class="fa fa-lg fa-fw fa-pen"></i>
                                        </button>
                                    </a>
                                `;
                            }
                        }
                      ],
                      "responsive": true,
                      "bInfo": false 
        });

        var tabla2 = $('#tabla2').DataTable({
                      "processing": true,
                      "serverSide": true,
                      "ajax": {
                          type: 'POST',
                          headers: {
                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                          },
                          url: "{{ route('movimiento.getFilteredData') }}",
                          data: function(d) {
                              d.fecha = $('#fecha').val();
                              d.centroId = $('#centroId').val();
                              d.guia_despacho = $('#guia_despacho').val();
                              d.tipoTabla = 2;
                              d.empresaId = empresaUser;
                          }
                      },
                      "columns": [
                        { data: '0', title: 'ID' },
                        { data: '1', title: 'Guia Despacho' },
                        { data: '2', title: 'Usuario' },
                        { data: '3', title: 'Cliente' },
                        { data: '4', title: 'Centro' },
                        { data: '5', title: 'Detalle' },
                        { data: '6', title: 'Fecha' },
                        { data: '7', title: 'Tipo Movimiento' },
                        {
                            // Columna de acciones (botones)
                            data: null,
                            render: function(data, type, full, meta) {
                                return `
                                    <button class="btn btn-xs btn-default text-teal mx-1 shadow details-button"
                                    onclick="mostrarDetalles(${data[0]})" title="Details">
                                        <i class="fa fa-lg fa-fw fa-eye"></i>
                                    </button>
                                    <a href="movimientos_edit/${data[0]}">
                                        <button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                                            <i class="fa fa-lg fa-fw fa-pen"></i>
                                        </button>
                                    </a>
                                `;
                            }
                        }
                      ],
                      "responsive": true,
                      "bInfo": false 
        });

        var tabla5 = $('#tabla5').DataTable({
                      "processing": true,
                      "serverSide": true,
                      "searching": false,
                      "ajax": {
                          type: 'POST',
                          headers: {
                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                          },
                          url: "{{ route('centro.reporte') }}",
                          data: function(d) {
                              d.empresaFilter = $('#empresaFilter').val();
                              d.centroId = $('#centroId').val();
                              d.tipoTabla = 1;
                              d.empresaId = empresaUser;
                          }
                      },
                      "columns": [
                        { data: '0', title: 'Centro ID' },
                        { data: '1', title: 'Nombre Centro' },
                        { data: '2', title: 'Activos' },
                        { data: '3', title: 'Total $' }
                      ],
                      "responsive": true,
                      "bInfo": false 
        });

        $('#guia_despacho').on('change', function() {
            tabla1.ajax.reload();
            tabl2.ajax.reload();
            tabla5.ajax.reload();
        });

        
    });

    function obtenerNombreActivo(idActivo) {

    var activos = @json($activos);

    for (var i = 0; i < activos.length; i++) {
    if (activos[i].id === idActivo) {
        return activos[i].nombre; 
    }
    }
    return 'Activo no encontrado'; 
    }

    function mostrarDetalles(movimientoId) {
    var movimientoId = movimientoId
    $.ajax({
        url: 'detalle_movimiento/' + movimientoId, 
        method: 'GET',
        success: function (response) {
        var datos_detalle = response.data_detalle;
        var datos_movimiento = response.data_movimiento;

        var modal = $('#detailsModal');
        var modalContent = modal.find('.modal-body');
        modalContent.empty();

        // Crea una tabla HTML y su encabezado
        var table = $('<table class="table table-striped"></table>');
        var thead = $('<thead><tr><th>ID</th><th>ID Movimiento</th><th>ID Activo</th><th>Cantidad</th><th>Valor</th><th>Total</th></tr></thead>');
        table.append(thead);

        // Llena la tabla con los datos obtenidos
        var tbody = $('<tbody></tbody>');
        $.each(datos_detalle, function (index, dato) {

            var nombreActivo = obtenerNombreActivo(dato.id_activo);

            var row = '<tr>' +
            '<td>' + dato.id + '</td>' +
            '<td>' + dato.id_movimiento + '</td>' +
            '<td>' + nombreActivo + '</td>' +
            '<td>' + dato.cantidad + '</td>' +
            '<td>' + dato.valor + '</td>' +
            '<td>' + dato.total + '</td>' +
            '</tr>';
            tbody.append(row);
        });

        table.append(tbody);
        
        modalContent.append('<div class="btn btn-primary mb-1"><p> Número de Guía: ' + datos_movimiento[0]['guia_despacho'] + ' </p></div><br>');
        
        modalContent.append('<div class="btn btn-primary mb-3"><p> Fecha emisión guía: ' + datos_movimiento[0]['fecha'] + ' </p></div>');
        
        modalContent.append(table);

        $('#detailsModal').modal('show');
        },
        error: function (error) {
        console.error(error);
        }
    });
    }
  </script>

@stop