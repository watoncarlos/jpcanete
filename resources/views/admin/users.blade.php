@extends('adminlte::page')

@section('title', 'Dashboard Principal')

@section('content_header')
    <h1>Usuarios</h1>
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card tabla-card" style="padding: 10px;">
            <div class="card-header border-0">
                <h3 class="card-title">Listado de Usuarios</h3>
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
                <button class="btn btn-primary" id="abrirModalBtn" style="float: right;">Guardar Nuevo Usuario</button>
                <br>
                <br>
                <div class="modal fade" id="nuevoUsuarioModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Nuevo Usuario</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Formulario para ingresar los datos del nuevo usuario -->
                                <form id="nuevoUsuarioForm">
                                    @csrf
                                    <div class="form-group">
                                        <label for="nombre">Nombre:</label>
                                        <input type="text" class="form-control" id="name" name="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre">Email:</label>
                                        <input type="text" class="form-control" id="email" name="email">
                                    </div>
                                    <label>Cliente</label>
                                    <select class="form-control select2" name="empresaId[]" id="empresaId" style="display: inline-block" multiple>
                                        <option value="">Seleccione</option>
                                        <option value="100">Todas</option>
                                        @foreach ($empresas as $empresa)
                                            <option value="{{ $empresa['id'] }}">{{ $empresa['nombre'] }}</option>
                                        @endforeach
                                    </select>                                    
                                    <label style="margin-top: 2%;">Centro</label>
                                    <select class="form-control select2" name="centroId" id="centroId" style="display: inline-block">
                                        <option value="0">Todos</option>
                                        <!-- Los centros se cargarán dinámicamente mediante JavaScript -->
                                    </select>
                                    <br>
                                    <label style="margin-top: 2%;">Rol</label>
                                    <select id="roleId" name="roleId" label="Rol" class="form-control select2">
                                        <option value="">Seleccione</option>
                                        @foreach ($roles as $rol)
                                            <option value="{{ $rol['id'] }}">{{ $rol['name'] }}</option>
                                        @endforeach
                                    </select>
                                    <div class="form-group"  style="margin-top: 2%;">
                                        <label for="password">Contraseña:</label>
                                        <input type="password" class="form-control" id="password" name="password">
                                    </div>
                                    <div class="form-group">
                                        <label for="password_confirmation">Confirmar Contraseña:</label>
                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                                        <div id="password-error" style="color: red;"></div> <!-- Aquí se mostrará el mensaje de error -->
                                    </div> 
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-primary" id="guardarNuevoUsuarioBtn">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <table id="tabla5" class="table table-striped table-valign-middle">
                   
                </table>
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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>

    var tipoUser =  '{{ auth()->user()->getRoleNames()->first(); }}';      
    var empresaUser = 0;

    function limpiarFormulario() {
        $('#name').val('');
        $('#email').val('');
        $('#empresaId').val('').trigger('change'); // Restablece el select de empresas
        $('#centroId').empty().append('<option value="">Seleccione</option>'); // Limpia el select de centros
        $('#roleId').val('').trigger('change'); // Restablece el select de roles
        $('#password').val('');
        $('#password_confirmation').val('');
        $('#password-error').text('');
    }

    var empresas = @json($empresas);
    var centros = @json($centros);
    var roles = @json($roles);

    console.log(roles);

    function cargarOpcionesSelectRoles(selectId, opciones, valorSeleccionado) {
        // Llena el select con las opciones disponibles
        var select = $(selectId);
        select.empty();

        // Agrega una opción por defecto
        select.append($('<option>', {
            value: '',
            text: 'Seleccione'
        }));

        // Llena el select con las opciones disponibles
        opciones.forEach(function (item) {
            select.append($('<option>', {
                value: item.id,
                text: item.name
            }));
        });

        // Establece el valor seleccionado (si está definido)
        if (valorSeleccionado) {
            select.val(valorSeleccionado);
        }

        // Activa el evento de cambio del select (si es necesario)
        select.trigger('change');
    }

    function cargarOpcionesSelect(selectId, opciones, valorSeleccionado) {
        // Llena el select con las opciones disponibles
        var select = $(selectId);
        select.empty();

        // Agrega una opción por defecto
        select.append($('<option>', {
            value: '',
            text: 'Seleccione'
        }));

        // Llena el select con las opciones disponibles
        opciones.forEach(function (item) {
            select.append($('<option>', {
                value: item.id,
                text: item.nombre  // Asegúrate de usar la propiedad correcta para el nombre
            }));
        });

        // Establece el valor seleccionado (si está definido)
        if (valorSeleccionado) {
            select.val(valorSeleccionado);
        }

        // Activa el evento de cambio del select (si es necesario)
        select.trigger('change');
    }

    function editarUsuario(usuarioId) {
                    // Realiza una solicitud AJAX para obtener la información del usuario por su ID
            $.ajax({
                type: 'GET',
                url: 'user/detalle/' + usuarioId,
                success: function(response) {
                    // Llena los campos del formulario con la información del usuario obtenida
                    
                    var usuario = response.usuario;
                    $('#name').val(usuario.name);
                    $('#email').val(usuario.email);

                    // Crea un input hidden con el ID del usuario y asigna el valor
                    var inputUserId = $('<input>')
                        .attr('type', 'hidden')
                        .attr('id', 'userId')
                        .attr('name', 'userId')
                        .val(usuario.id);

                    console.log(usuario.roleId);

                    cargarOpcionesSelect('#empresaId', empresas, usuario.empresaId);
                    cargarOpcionesSelect('#centroId', centros, usuario.centroId);
                    cargarOpcionesSelectRoles('#roleId', roles, usuario.roleId);

                    // Agrega el input hidden al formulario si no existe
                    if ($('#userId').length === 0) {
                        $('#nuevoUsuarioForm').append(inputUserId);
                    } else {
                        // Si ya existe, actualiza su valor
                        $('#userId').val(usuario.id);
                    }
                    // No llenes el campo de contraseña para editar; puedes dejarlo vacío o manejarlo de otra manera

                    // Muestra la modal
                    $('#nuevoUsuarioModal').modal('show');
                },
                error: function(error) {
                    // Maneja el error según tus necesidades
                    console.error(error);
                }
            });
    }

    $(document).ready(function () {
        
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

        var tabla5 = $('#tabla5').DataTable({
                      "processing": true,
                      "serverSide": true,
                      "searching": false,
                      "lengthChange": false,
                      "ajax": {
                          type: 'POST',
                          headers: {
                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                          },
                          url: "{{ route('user.listar') }}",
                          data: function(d) {
                              d.fecha = $('#fecha').val();
                              d.centroId = $('#centroId').val();
                              d.tipoTabla = 1;
                              d.empresaId = empresaUser;
                          }
                      },
                      "columns": [
                        { data: '0', title: 'Id' },
                        { data: '1', title: 'Name' },
                        { data: '2', title: 'Empresa' },
                        { data: '3', title: 'Roles' },
                        {
                            // Columna de acciones (botones)
                            data: null,
                            render: function(data, type, full, meta) {
                                return `
                                    <button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit" onclick="editarUsuario(${data[0]})">
                                        <i class="fa fa-lg fa-fw fa-pen"></i>
                                    </button>
                                `;
                            }
                        }
                      ],
                      "responsive": true,
                      "bInfo": false 
        });

        $('#password, #password_confirmation').on('input', function() {
            var password = $('#password').val();
            var passwordConfirmation = $('#password_confirmation').val();
            var errorElement = $('#password-error'); // Elemento para mostrar el mensaje de error

            if (password === passwordConfirmation) {
                errorElement.text(''); // Borra cualquier mensaje de error
            } else {
                errorElement.text('Las contraseñas no coinciden');
            }
        });
    });

    $('#abrirModalBtn').click(function () {
        $('#nuevoUsuarioModal').modal('show');
    });

    // Agregar evento para guardar el nuevo usuario
    $('#guardarNuevoUsuarioBtn').click(function () {
    // Recopila los datos del nuevo usuario del formulario
        var nuevoUsuario = {
            name: $('#name').val(),
            email: $('#email').val(),
            empresaId: $('#empresaId').val(),
            centroId: $('#centroId').val(),
            roleId: $('#roleId').val(),
            password: $('#password').val(),
            userId: $('#userId').val() // Agrega el ID del usuario si existe
        };
        // Envía una solicitud AJAX para guardar el nuevo usuario
        $.ajax({
            type: 'POST',
            url: "{{ route('user.store') }}", // Ruta definida en Laravel
            data: nuevoUsuario, // Datos del nuevo usuario
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                // La solicitud fue exitosa, puedes manejar la respuesta aquí
                console.log(response);
                // Puedes cerrar la ventana modal
                $('#nuevoUsuarioModal').modal('hide');

                Swal.fire({
                    title: 'Éxito',
                    text: 'El usuario se ha guardado exitosamente',
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Puedes redirigir a otra página o realizar otras acciones
                    }
                });
                // Puedes recargar la tabla de usuarios o realizar otras acciones
            },
            error: function (error) {
                // Ocurrió un error en la solicitud, maneja el error aquí
                console.error(error);
                // Puedes mostrar un mensaje de error al usuario
            }
        });

        console.log(nuevoUsuario);

        limpiarFormulario();
    });


    var empresaSelect = $('#empresaId');
    var centroSelect = $('#centroId');

    // Asocia la función de actualización al evento de cambio en el select de empresas
    empresaSelect.on('change', function() {
    // Obtiene los valores seleccionados en el select de empresas
        var empresasSeleccionadas = empresaSelect.val();

        // Limpia el select de centros
        centroSelect.empty().append('<option value="0">Todos</option>');

        // Si se seleccionaron empresas, realiza una llamada AJAX para obtener los centros correspondientes
        if (empresasSeleccionadas && empresasSeleccionadas.length > 0) {
            // Concatena las empresas seleccionadas como una cadena separada por comas
            var empresasConcatenadas = empresasSeleccionadas.join(',');

            $.get('centro/' + empresasConcatenadas, function(data) {
                $.each(data, function(index, centro) {
                    centroSelect.append('<option value="' + centro.id + '">' + centro.nombre + '</option>');
                });
            });
        }

       
    });

    
  </script>

@stop