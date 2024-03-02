@extends('layout.app')

@section('titulo', 'Incidencias')

@section('template')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">
                INCIDENCIAS OSE
            </h6>
            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#importar">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-file-earmark-diff-fill" viewBox="0 0 16 16">
                    <path
                        d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1M8 6a.5.5 0 0 1 .5.5V8H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V9H6a.5.5 0 0 1 0-1h1.5V6.5A.5.5 0 0 1 8 6m-2.5 6.5A.5.5 0 0 1 6 12h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5" />
                </svg>
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="table-incidencias" style="width: 100%" class="display table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th style="width: 5%">Revisado</th>
                            <th style="width: 10%">Fecha Rev.</th>
                            <th style="width: 10%">RUC</th>
                            <th style="width: 10%">Fecha</th>
                            <th style="width: 40%">Razón Social</th>
                            <th style="width: 10%">Documento</th>
                            <th style="width: 5%">Error</th>
                            <th style="width: 10%">Ope.</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th style="width: 3%">Revisado</th>
                            <th style="width: 10%">Fecha Rev.</th>
                            <th style="width: 10%">RUC</th>
                            <th style="width: 10%">Fecha</th>
                            <th style="width: 40%">Razón Social</th>
                            <th style="width: 12%">Documento</th>
                            <th style="width: 5%">Cod. Error</th>
                            <th style="width: 10%">Ope.</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="importar" tabindex="-1" aria-labelledby="importarDoc" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importarDoc">Importar Excel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-import" action="{{ route('incidenciasose.import') }}" method="post"
                    enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <label for="">Subir Archivo</label>
                        <input type="file" name="archivo" class="form-control-file" accept=".xls,.xlsx" required>
                    </div>
                    <div class="modal-footer">
                        <button id="cerrar" type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button id="cargar" type="submit" class="btn btn-danger">Cargar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('incidenciasose.modal')
@endsection

@section('js')
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <script>
        var formIncidencia = $('#form-verincidencia');

        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#table-incidencias').DataTable({
                processing: true,
                serverSide: true,
                language: {
                    url: "{{ asset('language/datatables/es.json') }}",
                },
                ajax: "{{ route('incidenciasose.list') }}",
                columns: [{
                        data: 'revisado',
                        name: 'Revisado',
                        searchable: false,
                        render: function(data, type, row) {
                            if (data == 1) {
                                return 'Si';
                            } else if (data == 0 || data == 2) {
                                return 'No';
                            }
                        }
                    },
                    {
                        data: 'fecharevisado',
                        name: 'fecharevisado',
                        searchable: false,
                        render: function(data, type, row) {
                            if (data === null) {
                                return 'Por revisar';
                            } else {
                                return data;
                            }
                        }
                    },
                    {
                        data: 'ruc',
                        name: 'ruc'
                    },
                    {
                        data: 'fecha',
                        name: 'fecha'
                    },
                    {
                        data: 'razonsocial',
                        name: 'razonsocial'
                    },
                    {
                        data: 'documento',
                        name: 'documento'
                    },
                    {
                        data: 'coderror',
                        name: 'coderror'
                    },
                    {
                        data: 'option',
                        name: 'Ope.',
                        searchable: false,
                        orderable: false
                    },
                ],
                createdRow: function(row, data, dataIndex) {
                    if (data.revisado == 1) {
                        $(row).css('background-color', '#d4edda');
                    } else if (data.revisado == 0) {
                        $(row).css('background-color', '#f8d7da');
                    } else if (data.revisado == 2) {
                        $(row).css('background-color', '#FFE48A');
                    }

                    if (data.fecharevisado === null) {
                        $('td:eq(1)', row).text('Por revisar');
                    }
                },
                initComplete: function(settings, json) {
                    let api = this.api();

                    api.columns().every(function() {
                        let column = this;
                        let footer = $(column.footer());

                        if (footer !== null) {
                            let title = footer.text();

                            // Verificar si la columna es 'revisado', 'fecharevisado' o 'Ope.'
                            if (column.index() !== 0 && column.index() !== 1 && column
                            .index() !== 7) {
                                let input = $('<input>').css('width', '100%').attr(
                                    'placeholder', title).addClass('form-control');
                                footer.empty().append(input);

                                input.on('input', function() {
                                    if (column.search() !== this.value) {
                                        column.search(this.value).draw();
                                    }
                                });
                            }
                        }
                    });
                }
            });
        });

        function view(id) {
            $.ajax({
                type: 'POST',
                url: "{{ route('incidenciasose.show') }}",
                data: {
                    id: id
                },
                cache: false,
                success: (incidencia) => {
                    $("#verincidencia").modal('show');
                    formIncidencia.find('input[name="id"]').val(incidencia.id);
                    formIncidencia.find('input[name="revisado"]').val(incidencia.revisado);
                    formIncidencia.find('input[name="ruc"]').val(incidencia.ruc);
                    formIncidencia.find('input[name="fecha"]').val(incidencia.fecha);
                    formIncidencia.find('input[name="razonsocial"]').val(incidencia.razonsocial);
                    formIncidencia.find('input[name="documento"]').val(incidencia.documento);
                    formIncidencia.find('input[name="tipodocumento"]').val(incidencia.tipodocumento);
                    formIncidencia.find('input[name="serie"]').val(incidencia.serie);
                    formIncidencia.find('input[name="correlativo"]').val(incidencia.correlativo);
                    formIncidencia.find('input[name="coderror"]').val(incidencia.coderror);
                    formIncidencia.find('textarea[name="descripcion"]').val(incidencia.descripcion);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        function edit(id) {
            if (confirm("¿Cambiar a caso pendiente?") == true) {
                $.ajax({
                    type: 'POST',
                    url: "{{ route('incidenciasose.edit') }}",
                    data: {
                        id: id
                    },
                    cache: false,
                    success: (incidencia) => {
                        var oTable = $('#table-incidencias').dataTable();
                        oTable.fnDraw(false);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }
        }

        function review(id) {
            if (confirm("¿Cambiar a caso revisado?") == true) {
                $.ajax({
                    type: 'POST',
                    url: "{{ route('incidenciasose.review') }}",
                    data: {
                        id: id
                    },
                    cache: false,
                    success: (incidencia) => {
                        var oTable = $('#table-incidencias').dataTable();
                        oTable.fnDraw(false);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }
        }
    </script>
@endsection
