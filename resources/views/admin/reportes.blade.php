@extends('adminlte::page')

@section('title', 'Dashboard Principal')

@section('content_header')
    <h1>Reportes</h1>
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
                        <label for="empresaFilter" class="mr-2">Empresa</label> <!-- Agrega la clase mr-2 para espacio a la derecha -->
                        <select class="form-control select2" id="empresaFilter" name="empresaFilter">
                          <option value="">Seleccione</option>
                          @foreach ($empresas as $empresa)
                            <option value="{{ $empresa['id'] }}">{{ $empresa['nombre'] }}</option>
                          @endforeach
                        </select>
                      </div>
                    <div class="form-group ml-2"> <!-- Agrega un espacio entre los campos usando ml-2 -->
                        <label for="centroId" class="mr-2">Centro</label> <!-- Agrega la clase mr-2 para espacio a la derecha -->
                        <select class="form-control select2" id="centroId" name="centroId">
                        <option value="">Seleccione</option>
                        @foreach ($centros as $centro)
                            <option value="{{ $centro['id'] }}">{{ $centro['nombre'] }}</option>
                        @endforeach
                        </select>
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">Centros x Cliente</h3>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex">
                    <p class="d-flex flex-column">
                    <span class="text-bold text-lg">{{ count($empresas) }}</span>
                    <span>Total empresas</span>
                    </p>
                    <p class="ml-auto d-flex flex-column text-right">
                    <span class="text-success">
                        {{ count($centros) }}
                    </span>
                    <span class="text-muted">Total centros</span>
                    </p>
                </div>
            
                <div class="position-relative mb-4">
                    <canvas id="sales-chart" height="200"></canvas>
                </div>
                <div class="d-flex flex-row justify-content-end">
                    <span class="mr-2">
                    <i class="fas fa-square text-primary"></i> Cantidad de Centros
                    </span>
                </div>
            </div>
        </div>  
    </div> 
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">Activos x Centro</h3>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex">
                    <p class="d-flex flex-column">
                    <span class="text-bold text-lg">{{ count($empresas) }}</span>
                    <span>Total empresas</span>
                    </p>
                    <p class="ml-auto d-flex flex-column text-right">
                    <span class="text-success">
                        {{ count($centros) }}
                    </span>
                    <span class="text-muted">Total centros</span>
                    </p>
                </div>
            
                <div class="position-relative mb-4">
                    <canvas id="centros_chart" height="200"></canvas>
                </div>
                <div class="d-flex flex-row justify-content-end">
                    <span class="mr-2">
                    <i class="fas fa-square text-primary"></i> Cantidad de Centros
                    </span>
                </div>
            </div>
        </div>  
    </div>
    <div class="col-lg-12">
        <div class="card tabla-card" style="padding: 10px;">
            <div class="card-header border-0">
                <h3 class="card-title">Centros</h3>
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
                <table id="tabla5" class="table table-striped table-valign-middle">
                   
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="detalleActivoModal" tabindex="-1" role="dialog" aria-labelledby="detalleActivoModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="detalleActivoModalLabel">Detalles del Activo</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <!-- Aquí mostrarás la información detallada del activo -->
              <div id="detalleActivoContenido"></div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
      </div>
  </div>
</div>

@stop

@section('css')

  <style>
    .detalle-activo {
        background-color: #f9f9f9;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .detalle-activo p {
        margin: 5px 0;
    }
  </style>

@stop

@section('js')
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
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


    var empresas = {!! json_encode($empresas) !!};
    const centros = {!! json_encode($centros) !!};

    // Crear un objeto para mapear empresaId a la cantidad de centros
    const countCentrosPorEmpresa = {};
    centros.forEach(centro => {
      countCentrosPorEmpresa[centro.empresaId] = (countCentrosPorEmpresa[centro.empresaId] || 0) + 1;
    });

    // Crear el gráfico
    const ctx = document.getElementById('sales-chart');
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: empresas.map(empresa => empresa.nombre),
        datasets: [{
          label: 'Cantidad de Centros',
          data: empresas.map(empresa => countCentrosPorEmpresa[empresa.id] || 0),
          borderWidth: 1,
        }],
      },
      options: {
        scales: {
          y: {
            beginAtZero: true,
            stepSize: 1,
          },
        },
      },
    });

    //gráfico 2
   const centrosData = {!! json_encode($activosActuales) !!};

    // Crear el gráfico
    const ctx2 = document.getElementById('centros_chart');
    new Chart(ctx2, {
      type: 'bar',
      data: {
        labels: centrosData.map(centro => centro.nombre_centro),
        datasets: [{
          label: 'Total de Activos',
          data: centrosData.map(centro => centro.total_activos || 0),
          borderWidth: 1,
        }],
      },
      options: {
        scales: {
          y: {
            beginAtZero: true,
            stepSize: 1,
          },
        },
        plugins: {
          datalabels: {
            anchor: 'end',
            align: 'end',
            formatter: (value, context) => {
              // Mostrar el valor en la etiqueta de la barra
              return value;
            },
          },
        },
        tooltips: {
          callbacks: {
            label: (tooltipItem) => {
              const centroData = centrosData[tooltipItem.dataIndex];
              // Mostrar el total_valoress en el tooltip
              return 'Total de Valores: ' + centroData.total_valoress;
            },
          },
        },
      },
    });

    $(document).ready(function () {
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
                        { data: '3', title: 'Total $' },
                        {
                            data: null,
                            title: 'Detalles',
                            render: function (data, type, row) {
                                return '<button type="button" class="btn btn-info btn-detalle-activo">Ver Detalles</button>';
                            },
                            orderable: false,
                        },
                      ],
                      "responsive": true,
                      "bInfo": false,
                      "dom": 'Bfrtip',
                      "buttons": [
                          'excelHtml5'
                      ],
                      "language": {
                          "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json" // Ajusta según tu idioma
                      }
        });

        $('#empresaFilter, #centroId').on('change', function() {
            tabla5.ajax.reload();
        });

        $('#tabla5 tbody').on('click', '.btn-detalle-activo', function () {
          var data = tabla5.row($(this).parents('tr')).data();
          var centroId = data[0];

          // Realizar una llamada adicional para obtener los detalles del activo
          // Puedes ajustar la URL y los parámetros según la estructura de tu aplicación
          $.ajax({
              url: 'centro/detalles_activos/' + centroId,
              type: 'GET',
              success: function (response) {
                  // Limpiar el contenido anterior del modal
                  $('#detalleActivoContenido').empty();

                  // Agregar los detalles al modal
                  response.forEach(function (detalle) {
                      var html = '<div class="detalle-activo">';
                      html += '<p><strong>Nombre del Activo:</strong> ' + detalle.nombre_activo + '</p>';
                      html += '<p><strong>ID Activo:</strong> ' + detalle.id_activo + '</p>';
                      html += '<p><strong>Entradas:</strong> ' + detalle.entradas + '</p>';
                      html += '<p><strong>Salidas:</strong> ' + detalle.salidas + '</p>';
                      html += '<p><strong>Stock Actual:</strong> ' + detalle.stock_actual + '</p>';
                      html += '</div>';
                      html += '<hr>';
                      $('#detalleActivoContenido').append(html);
                  });

                  // Abrir el modal
                  $('#detalleActivoModal').modal('show');
              },
              error: function (error) {
                  console.error('Error al cargar detalles del activo', error);
              }
          });
        });

      });

     
  </script>

@stop