@extends('layout.app')

@section('titulo', 'Usuarios')

@section('template')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">
                USUARIOS
            </h6>
            <a href="javascript:void(0)" onClick="add()" class="btn btn-sm btn-success">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                    <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                    <path fill-rule="evenodd"
                        d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5" />
                </svg>
            </a>
        </div>
        @include('usuarios.create')
        <div class="card-body">
            <div class="table-responsive">
                <table id="table-usuarios" style="width: 100%" class="display table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th style="width: 15%">DNI</th>
                            <th style="width: 20%">Nombres</th>
                            <th style="width: 20%">Apellidos</th>
                            <th style="width: 20%">Correo</th>
                            <th style="width: 15%">Celular</th>
                            <th style="width: 10%">Ope.</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th style="width: 15%">DNI</th>
                            <th style="width: 20%">Nombres</th>
                            <th style="width: 20%">Apellidos</th>
                            <th style="width: 20%">Correo</th>
                            <th style="width: 15%">Celular</th>
                            <th style="width: 10%">Ope.</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        var formUsuario = $('#form-usuarios');

        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#table-usuarios').DataTable({
                processing: true,
                serverSide: true,
                language: {
                    url: "{{ asset('language/datatables/es.json') }}",
                },
                ajax: "{{ url('usuarios') }}",
                columns: [{
                        data: 'dni',
                        name: 'DNI'
                    },
                    {
                        data: 'nombres',
                        name: 'Nombres'
                    },
                    {
                        data: 'apellidos',
                        name: 'Apellidos'
                    },
                    {
                        data: 'correo',
                        name: 'Correo'
                    },
                    {
                        data: 'celular',
                        name: 'Celular'
                    },
                    {
                        data: 'option',
                        name: 'Ope.',
                        orderable: false
                    },
                ],
                order: [
                    [0, 'desc']
                ]
            });

            formUsuario.on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(formUsuario[0]);

                $.ajax({
                    type: 'POST',
                    url: "{{ route('usuarios.store') }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        $("#create").modal('hide');

                        var oTable = $('#table-usuarios').dataTable();
                        oTable.fnDraw(false);
                    },
                    error: function(data) {
                        console.log(data);
                    }
                })
            });
        });

        function add() {
            formUsuario[0].reset();
            formUsuario.find('input[name="id"]').val("");
            $('#tituloModal').html("Agregar Usuario");
            $("#create").modal('show');

            $('#create #password').show();
            $('#password input').prop('required', true);

            $("#btn-create").html('Guardar');
            $("#btn-create").removeClass('btn-warning');
            $("#btn-create").addClass('btn-success');
        }

        function editFunc(id) {
            $('#btn-create').prop('disabled', true);

            $.ajax({
                type: "POST",
                url: "{{ route('usuarios.edit') }}",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(res) {
                    $('#tituloModal').html("Editar Usuario");
                    $('#create').modal('show');

                    $('#create #password').hide();
                    $('#password input').prop('required', false);

                    $('#btn-create').prop('disabled', false);
                    $("#btn-create").html('Editar');
                    $("#btn-create").removeClass('btn-success');
                    $("#btn-create").addClass('btn-warning');

                    formUsuario.find('input[name="id"]').val(res.id);
                    formUsuario.find('input[name="dni"]').val(res.dni);
                    formUsuario.find('input[name="nombres"]').val(res.nombres);
                    formUsuario.find('input[name="apellidos"]').val(res.apellidos);
                    formUsuario.find('input[name="correo"]').val(res.correo);
                    formUsuario.find('input[name="celular"]').val(res.celular);
                    formUsuario.find('select[name="perfil"]').val(res.perfil_id);
                }
            });
        }

        function deleteFunc(id) {
            if (confirm("¿En serio quiere eliminar este usuario?") == true) {
                var id = id;
                // ajax
                $.ajax({
                    type: "POST",
                    url: "{{ route('usuarios.delete') }}",
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(res) {
                        var oTable = $('#table-usuario').dataTable();
                        oTable.fnDraw(false);
                    }
                });
            }
        }
    </script>
@endsection
