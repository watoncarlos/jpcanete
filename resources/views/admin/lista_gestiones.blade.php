@extends('adminlte::page')

@section('title', 'Dashboard Principal')

@section('content_header')
    <h1>Listado de Gestiones</h1>
@stop

@section('content')
    <div class="container-fluid"> <!-- Utiliza container-fluid para ocupar el ancho completo -->
        <div class="row mt-6">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title"><b>Filtros de Búsqueda</b></h5>
              </div>
              <div class="card-body">
                <form class="form-inline">
                  <div class="form-group ml-2"> <!-- Agrega un espacio entre los campos usando ml-2 -->
                    <label for="centroId" class="mr-2">ID</label> <!-- Agrega la clase mr-2 para espacio a la derecha -->
                    <input class="form-control custom-input" type="number" name="idGestion" id="idGestion"/>
                  </div>
                  <div class="form-group ml-2"> <!-- Agrega un espacio entre los campos usando ml-2 -->
                    <label for="centroId" class="mr-2">Folio</label> <!-- Agrega la clase mr-2 para espacio a la derecha -->
                    <input class="form-control custom-input" type="text" name="folioGestion" id="folioGestion"/>
                  </div> <!-- Utiliza form-inline para que los campos estén en línea -->
                  <div class="form-group ml-2"> <!-- Agrega un espacio entre los campos usando ml-2 -->
                    <label for="centroId" class="mr-2">Cliente</label> <!-- Agrega la clase mr-2 para espacio a la derecha -->
                    <input class="form-control custom-input" type="text" name="nombreCliente" id="nombreCliente"/>
                  </div>
                  <div class="form-group ml-2"> <!-- Agrega un espacio entre los campos usando ml-2 -->
                    <label for="centroId" class="mr-2">Entidad Comercial</label> <!-- Agrega la clase mr-2 para espacio a la derecha -->
                    <input class="form-control custom-input" type="text" name="entidadComercial" id="entidadComercial"/>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title"><b>Listado General de gestiones</b></h5>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>

              </button>
              <div class="btn-group">
                <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                  <i class="fas fa-wrench"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right" role="menu">
                  <a href="#" class="dropdown-item">Acción</a>
                  <a class="dropdown-divider"></a>
                  <a href="#" class="dropdown-item">Separated link</a>
                </div>
              </div>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body" style="overflow: auto;">
            <table id="tabla6" style="width: 100%;">
              <!-- Contenido de la tabla 1 -->
            </table>
          </div>
        </div>
      </div>
       <!-- Modal para mostrar detalles -->
    <div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailsModalLabel">Detalles de la gestión</h5>
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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script>
        $(document).ready(function () {

            var tabla = $('#tabla6').DataTable({
                      "processing": true,
                      "serverSide": true,
                      "ajax": {
                          type: 'POST',
                          headers: {
                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                          },
                          url: "{{ route('gestion.getAll') }}",
                          data: function(d) {
                              d.idGestion = $('#idGestion').val();
                              d.folioGestion = $('#folioGestion').val();
                              d.nombreCliente = $('#nombreCliente').val();
                              d.entidadComercial = $('#entidadComercial').val();
                          }
                      },
                      "columns": [
                        { data: '0', title: 'ID' },
                        {data: '1', title: 'monto venta'},
                        {data: '2', title: 'estado pago'},
                        {data: '3', title: 'fecha solicitud'},
                        {data: '4', title: 'email cliente'},
                        {data: '5', title: 'email id. comercial'},
                        {data: '6', title: 'fecha inicio'},
                        {data: '7', title: 'fecha termino'},
                        {data: '8', title: 'hora inicio'},
                        {data: '9', title: 'hora termino'},
                        {data: '10', title: 'comentario reserva'},
                        {data: '11', title: 'fecha pago'},
                        {data: '12', title: 'servicio actividad'},
                        {data: '13', title: 'cantidad clientes'},
                        {data: '14', title: 'nombre cliente'},
                        {data: '15', title: 'idioma cliente'},
                        {data: '16', title: 'transporte relacionado'},
                        {data: '16', title: 'tipo vehiculo'},
                        {data: '17', title: 'item relacionado'},
                        {data: '18', title: 'res. cliente directo'},
                        {data: '19', title: 'res. 1er prov.'},
                        {data: '20', title: 'res. 2do prov.'},
                        {data: '21', title: 'locacion1'},
                        {data: '21', title: 'locacion2'},
                        {data: '22', title: 'notas'},
                        {data: '23', title: 'cliente emisivo'},
                        {data: '24', title: 'folio cliente'},
                        {data: '25', title: 'tarifa primer prov.'},
                        {data: '26', title: 'tarifa segundo prov.'},
                        {data: '27', title: 'rol primer prov.'},
                        {data: '28', title: 'rol segundo prov.'},
                        {data: '29', title: 'nombre primer prov.'},
                        {data: '30', title: 'nombre segundo prov.'},
                        {data: '31', title: 'telefono primer prov.'},
                        {data: '32', title: 'telefono segundo pro.r'},
                        {data: '33', title: 'estado pago 1er prov.'},
                        {data: '34', title: 'estado pago 2do prov.'},
                        {data: '35', title: 'fecha pago 1er prov'},
                        {data: '36', title: 'fecha pago 2do prov'},
                        {data: '37', title: 'Ref. Cliente Directo'},
                        {data: '38', title: 'Ref. 1er Proveedor'},
                        {data: '39', title: 'Ref. 2do Proveedor'},
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
                      "bInfo": false,
                      "dom": 'Bfrtip',
                      "buttons": [
                          'excelHtml5'
                      ]
                     
            });
            
            $('#empresaFilter, #centroId').on('change', function() {
                tabla.ajax.reload();
             });
    });

    </script>
@stop