@extends('adminlte::page')

@section('title', 'Dashboard Principal')

@section('content_header')
    <h1>Página Principal</h1>
    <div class="notification-icon" style="margin-left: 85%;">
      <i class="fas fa-message">Guías Pendientes</i>
      <span id="contador-guias" class="badge badge-danger" style="font-size: 1.3em;">0</span>
  </div>
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
            <form class="form-inline"> <!-- Utiliza form-inline para que los campos estén en línea -->
              <div class="form-group">
                <label for="fecha" class="mr-2">Fecha</label> <!-- Agrega la clase mr-2 para espacio a la derecha -->
                <input type="text" id="fecha" name="fecha" class="form-control" placeholder="Fecha">
              </div>
              <div class="form-group ml-2"> <!-- Agrega un espacio entre los campos usando ml-2 -->
                
              </div>
              <div class="form-group ml-2">
                <label for="numeroGuia" class="mr-2">Número de Guía</label>
                <input type="text" id="guia_despacho" name="guia_despacho" class="form-control" placeholder="Número de Guía">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid"> <!-- Utiliza container-fluid para ocupar el ancho completo -->
    <div class="row mt-6">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title"><b>Informe de Centros</b></h5>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <div class="btn-group">
                <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                  <i class="fas fa-wrench"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right" role="menu">
                  <a href="#" class="dropdown-item">Action</a>
                  <a href="#" class="dropdown-item">Another action</a>
                  <a href="#" class="dropdown-item">Something else here</a>
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
            <table id="tabla5" style="width: 100%;">
              <!-- Contenido de la tabla 1 -->
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title"><b>Guías Pendientes enviadas a clientes</b></h5>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <div class="btn-group">
                <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                  <i class="fas fa-wrench"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right" role="menu">
                  <a href="#" class="dropdown-item">Action</a>
                  <a href="#" class="dropdown-item">Another action</a>
                  <a href="#" class="dropdown-item">Something else here</a>
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
            <table id="tabla1" style="width: 100%;">
              <!-- Contenido de la tabla 1 -->
            </table>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title"><b>Guías pendientes enviadas a Luxmeter</b></h5>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <div class="btn-group">
                <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                  <i class="fas fa-wrench"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right" role="menu">
                  <a href="#" class="dropdown-item">Action</a>
                  <a href="#" class="dropdown-item">Another action</a>
                  <a href="#" class="dropdown-item">Something else here</a>
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
            <table id="tabla2" style="width: 100%;">
              <!-- Contenido de la tabla 2 -->
            </table>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title"><b>Guías confirmadas Clientes</b></h5>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <div class="btn-group">
                <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                  <i class="fas fa-wrench"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right" role="menu">
                  <a href="#" class="dropdown-item">Action</a>
                  <a href="#" class="dropdown-item">Another action</a>
                  <a href="#" class="dropdown-item">Something else here</a>
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
            <table id="tabla3" style="width: 100%;">
              <!-- Contenido de la tabla 2 -->
            </table>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title"><b>Guías confirmadas Luxmeter</b></h5>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <div class="btn-group">
                <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                  <i class="fas fa-wrench"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right" role="menu">
                  <a href="#" class="dropdown-item">Action</a>
                  <a href="#" class="dropdown-item">Another action</a>
                  <a href="#" class="dropdown-item">Something else here</a>
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
            <table id="tabla4" style="width: 100%;">
              <!-- Contenido de la tabla 2 -->
            </table>
          </div>
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

  <style>
    .azul-claro {
        background: #cfe2f3;
        color: blue;
 /* Puedes ajustar el color según tus preferencias */
    }
    .azul-claro td{
      background: #cfe2f3;
    }
  </style>

@stop

@section('js')
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
  <script>
  
  </script>
@stop