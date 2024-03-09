@extends('layout.app')

@section('titulo', 'Incidencias')

@section('template')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">
                INCIDENCIAS
            </h6>
            <div>
                <button type="button" class="btn btn-sm btn-secondary" onClick="actualizar()">
                    Actualizar
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2z" />
                        <path
                            d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466" />
                    </svg>
                </button>
                <a href="https://colab.research.google.com/drive/1GqXy24GKAMl0k1X_DFI7VNCn0AwXOqJB?usp=sharing"
                    target="_blank" type="button" class="btn btn-sm btn-info">
                    CSV to Excel
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-link-45deg" viewBox="0 0 16 16">
                        <path
                            d="M4.715 6.542 3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1 1 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4 4 0 0 1-.128-1.287z" />
                        <path
                            d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 1 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 1 0-4.243-4.243z" />
                    </svg>
                </a>
                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#importar">
                    Importar
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-file-earmark-diff-fill" viewBox="0 0 16 16">
                        <path
                            d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1M8 6a.5.5 0 0 1 .5.5V8H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V9H6a.5.5 0 0 1 0-1h1.5V6.5A.5.5 0 0 1 8 6m-2.5 6.5A.5.5 0 0 1 6 12h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5" />
                    </svg>
                </button>
            </div>
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
                            <th style="width: 32%">Razón Social</th>
                            <th style="width: 8%">Partner</th>
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
                            <th style="width: 32%">Razón Social</th>
                            <th style="width: 8%">Partner</th>
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
                <form id="form-import" action="{{ route('incidencias.import') }}" method="post"
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
    @include('incidencias.modal')
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
                ajax: "{{ route('incidencias.list') }}",
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
                        data: 'partner',
                        name: 'partner'
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
                                .index() !== 8) {
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
                url: "{{ route('incidencias.show') }}",
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
                    formIncidencia.find('textarea[name="detalle"]').val(incidencia.detalle);
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
                    url: "{{ route('incidencias.edit') }}",
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
            let detalle = prompt("Ingrese el detalle de la revisión", "Documento emitido");
            if (detalle != null) {
                $.ajax({
                    type: 'POST',
                    url: "{{ route('incidencias.review') }}",
                    data: {
                        id: id,
                        detalle: detalle
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
            } else {
                alert("Debe ingresar el detalle de la revisión");
            }
        }

        function actualizar() {
            var oTable = $('#table-incidencias').dataTable();
            oTable.fnDraw(false);
        }
    </script>
@endsection
