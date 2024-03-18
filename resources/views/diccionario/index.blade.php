@extends('layout.app')

@section('titulo', 'Diccionario')

@section('template')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">
                DICCIONARIO DE INCIDENCIAS
            </h6>
            <a href="javascript:void(0)" onClick="add()" class="btn btn-sm btn-success">
                Agregar
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                    <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                    <path fill-rule="evenodd"
                        d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5" />
                </svg>
            </a>
        </div>
        @include('diccionario.create')
        <div class="card-body">
            <div class="table-responsive">
                <table id="table-diccionario" style="width: 100%"
                    class="display table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th style="width: 5%">Error</th>
                            <th style="width: 35%">Descripcion</th>
                            <th style="width: 50%">Detalle</th>
                            <th style="width: 10%">Ope.</th>
                        </tr>
                    </thead>
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
    <script src="{{ asset('vendor/summernote/summernote-bs4.min.js') }}"></script>
    <script>
        var formDetalle = $('#formDetalle');

        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#table-diccionario').DataTable({
                processing: true,
                serverSide: true,
                language: {
                    url: "{{ asset('language/datatables/es.json') }}",
                },
                ajax: {
                    url: "{{ route('diccionario') }}",
                    error: function(xhr, textStatus, errorThrown) {
                        if (xhr.status == 401) {
                            window.location.href = "{{ url('/iniciar-sesion') }}";
                        }
                    }
                },
                columns: [{
                        data: 'coderror',
                        name: 'codderror'
                    },
                    {
                        data: 'descripcion',
                        name: 'descripcion'
                    },
                    {
                        data: 'detalle',
                        name: 'detalle',
                        render: function(data, type, row) {
                            return $('<div>').html(data).text();
                        }
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

            $('#summernote').summernote({
                height: 100,
                placeholder: 'Ingrese el detalle de la solución...',
                fontNames: ['Nunito'],
                fontNamesIgnoreCheck: ['Nunito'],
                defaultForeColor: '#6e707e',
                toolbar: [
                    ['style', ['bold', 'underline']],
                    ['insert', ['unorderedList', 'orderedList']]
                ],
                lang: 'es-ES'
            });

            formDetalle.on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(formDetalle[0]);

                $.ajax({
                    type: 'POST',
                    url: "{{ route('diccionario.store') }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        $("#create").modal('hide');

                        formDetalle.find('input[name="id"]').val("");
                        formDetalle.find('input[name="id"]').val("");
                        formDetalle.find('input[name="coderror"]').val("");
                        formDetalle.find('textarea[name="descripcion"]').val("");

                        var table = $('#table-diccionario').DataTable();
                        var currentPage = table.page();
                        table.draw();
                        table.page(currentPage).draw('page');
                    },
                    error: function(data) {
                        console.log(data);
                    }
                })
            });
        });

        function add() {
            formDetalle.find('input[name="id"]').val("");
            formDetalle.find('input[name="id"]').val("");
            formDetalle.find('input[name="coderror"]').val("");
            formDetalle.find('textarea[name="descripcion"]').val("");
            $('#summernote').summernote('code', "");

            $('#tituloModal').html("Agregar Detalle");
            $("#create").modal('show');

            $("#btn-create").html('Guardar');
            $("#btn-create").removeClass('btn-warning');
            $("#btn-create").addClass('btn-success');
        }

        function editFunc(id) {
            $('#btn-create').prop('disabled', true);

            $.ajax({
                type: "POST",
                url: "{{ route('diccionario.edit') }}",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(res) {
                    $('#tituloModal').html("Editar Detalle");
                    $('#create').modal('show');

                    $('#btn-create').prop('disabled', false);
                    $("#btn-create").html('Editar');
                    $("#btn-create").removeClass('btn-success');
                    $("#btn-create").addClass('btn-warning');

                    formDetalle.find('input[name="id"]').val(res.id);
                    formDetalle.find('input[name="coderror"]').val(res.coderror);
                    formDetalle.find('textarea[name="descripcion"]').val(res.descripcion);
                    $('#summernote').summernote('code', res.detalle);
                }
            });
        }

        function deleteFunc(id) {
            if (confirm("¿En serio quiere eliminar este usuario?") == true) {
                var id = id;
                $.ajax({
                    type: "POST",
                    url: "{{ route('diccionario.delete') }}",
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(res) {
                        var table = $('#table-diccionario').DataTable();
                        var currentPage = table.page();
                        table.draw();
                        table.page(currentPage).draw('page');
                    }
                });
            }
        }
    </script>
@endsection
