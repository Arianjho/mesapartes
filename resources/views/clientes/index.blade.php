@extends('layout.app')

@section('titulo', 'Clientes')

@section('template')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">
                CLIENTES
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
                <table id="table-clientes" style="width: 100%" class="display table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th style="width: 10%">RUC</th>
                            <th style="width: 37%">Razón Social</th>
                            <th style="width: 6%">Partner</th>
                            <th style="width: 10%">Estado</th>
                            <th style="width: 10%">Modalidad</th>
                            <th style="width: 9%">Mod. Local</th>
                            <th style="width: 13%">Ult. Mod.</th>
                            <th style="width: 5%">Ope.</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th style="width: 10%">RUC</th>
                            <th style="width: 37%">Razón Social</th>
                            <th style="width: 6%">Partner</th>
                            <th style="width: 10%">Estado</th>
                            <th style="width: 10%">Modalidad</th>
                            <th style="width: 9%">Mod. Local</th>
                            <th style="width: 13%">Ult. Mod.</th>
                            <th style="width: 5%">Ope.</th>
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
                <form id="form-import" action="{{ route('clientes.import') }}" method="post" enctype="multipart/form-data">
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
    @include('clientes.modal')
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

            $('#table-clientes').DataTable({
                processing: true,
                serverSide: true,
                language: {
                    url: "{{ asset('language/datatables/es.json') }}",
                },
                ajax: {
                    url: "{{ route('clientes.list') }}",
                    error: function(xhr, textStatus, errorThrown) {
                        if (xhr.status == 401) {
                            window.location.href = "{{ url('/iniciar-sesion') }}";
                        }
                    }
                },
                columns: [{
                        data: 'ruc',
                        name: 'ruc'
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
                        data: 'estado',
                        name: 'estado'
                    },
                    {
                        data: 'modalidad',
                        name: 'modalidad'
                    },
                    {
                        data: 'modlocal',
                        name: 'modlocal'
                    },
                    {
                        data: 'ultmodificacion',
                        name: 'ultmodificacion'
                    },
                    {
                        data: 'option',
                        name: 'Ope.',
                        searchable: false,
                        orderable: false
                    },
                ],
                initComplete: function(settings, json) {
                    let api = this.api();

                    api.columns().every(function() {
                        let column = this;
                        let footer = $(column.footer());

                        if (footer !== null) {
                            let title = footer.text();

                            if (column.index() !== 7 && column.index() !== 6) {
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

        function actualizar() {
            var oTable = $('#table-clientes').dataTable();
            oTable.fnDraw(false);
        }

        function cambiar(id, razonsocial) {
            if (confirm(`¿${razonsocial} tendrá que modificarse el local?`) == true) {
                $.ajax({
                    type: 'POST',
                    url: "{{ route('clientes.change') }}",
                    data: {
                        id: id
                    },
                    cache: false,
                    success: (incidencia) => {
                        var oTable = $('#table-clientes').dataTable();
                        oTable.fnDraw(false);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }
        }

        function revisar(id, razonsocial) {
            if (confirm(`¿Ya fue modificado el local de ${razonsocial}?`) == true) {
                $.ajax({
                    type: 'POST',
                    url: "{{ route('clientes.review') }}",
                    data: {
                        id: id
                    },
                    cache: false,
                    success: (incidencia) => {
                        var oTable = $('#table-clientes').dataTable();
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
