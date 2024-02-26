<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Incidencias</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.bootstrap5.min.css">
</head>

<body class="bg-light">
    <div class="container">
        <div class="row">
            <div class="text-center my-5">
                <h1>Incidencias</h1>
                <div>
                    <a href="{{ route('incidenciasosi') }}" class="btn btn-primary">Ir a Incidencias OSI</a>
                </div>
            </div>
            <div class="">
                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                    data-bs-target="#importar">Importar</button>

                <div class="modal fade" id="importar" tabindex="-1" aria-labelledby="importarDoc" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="importarDoc">Importar Excel</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form id="form-import" action="{{ route('importar') }}" method="post"
                                enctype="multipart/form-data">
                                <div class="modal-body">
                                    @csrf
                                    <input type="file" name="archivo" class="form-control" required>
                                </div>
                                <div class="modal-footer">
                                    <button id="cerrar" type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cerrar</button>
                                    <button id="cargar" type="submit" class="btn btn-success">Cargar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-5 w-100">
                <table id="table-incidencias" style="width: 100%"
                    class="display table table-bordered table-hover table-active">
                    <thead>
                        <tr>
                            <th style="width: 5%">Revisado</th>
                            <th style="width: 10%">Fecha R.</th>
                            <th style="width: 10%">RUC</th>
                            <th style="width: 10%">Fecha</th>
                            <th style="width: 40%">Razón Social</th>
                            <th style="width: 10%">Documento</th>
                            <th style="width: 5%">Cod. Error</th>
                            <th style="width: 10%">Ope.</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($incidencias as $incidencia)
                            <tr
                                @if ($incidencia->revisado == 0) style="background-color: #f8d7da"
                                @elseif ($incidencia->revisado == 2) 
                                style="background-color: #FFE48A"
                                @else 
                                style="background-color: #d4edda" @endif>
                                <td>{{ $incidencia->revisado == 0 || $incidencia->revisado == 2 ? 'No' : 'Si' }}</td>
                                <td>{{ $incidencia->fecharevisado ? $incidencia->fecharevisado : 'Por revisar' }}</td>
                                <td>{{ $incidencia->ruc }}</td>
                                <td>{{ $incidencia->fecha }}</td>
                                <td>{{ $incidencia->razonsocial }}</td>
                                <td>{{ $incidencia->documento }}</td>
                                <td>{{ $incidencia->coderror }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-xs btn-ver btn-primary"
                                            data-id="{{ $incidencia->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                                                <path
                                                    d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                                            </svg>
                                        </button>

                                        <button type="button" class="btn btn-xs btn-editar btn-warning"
                                            data-id="{{ $incidencia->id }}"
                                            @if ($incidencia->revisado == 2 || $incidencia->revisado == 1) disabled @endif>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path
                                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                <path fill-rule="evenodd"
                                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                            </svg>
                                        </button>

                                        <button type="button" class="btn btn-xs btn-revisar btn-secondary"
                                            data-id="{{ $incidencia->id }}"
                                            @if ($incidencia->revisado == 1) disabled @endif>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-bookmark-check-fill"
                                                viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                    d="M2 15.5V2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.74.439L8 13.069l-5.26 2.87A.5.5 0 0 1 2 15.5m8.854-9.646a.5.5 0 0 0-.708-.708L7.5 7.793 6.354 6.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0z" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style="width: 3%">Revisado</th>
                            <th style="width: 10%">Fecha R.</th>
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

    <div class="modal fade" id="verincidencia" tabindex="-1" aria-labelledby="importarDoc" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importarDoc">Incidencia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form-verincidencia" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="">ID</label>
                                <input class="form-control" name="id" type="text" value="" disabled>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">Revisado</label>
                                <input class="form-control" name="revisado" type="text" value="" disabled>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">RUC</label>
                                <input class="form-control" name="ruc" type="text" value="" disabled>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">Fecha</label>
                                <input class="form-control" name="fecha" type="date" value="" disabled>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Razon Social</label>
                                <input class="form-control" name="razonsocial" type="text" value=""
                                    disabled>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">Documento</label>
                                <input class="form-control" name="documento" type="text" value="" disabled>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">Tipo</label>
                                <input class="form-control" name="tipodocumento" type="text" value=""
                                    disabled>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="">Serie</label>
                                <input class="form-control" name="serie" type="text" value="" disabled>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="">Correlativo</label>
                                <input class="form-control" name="correlativo" type="text" value=""
                                    disabled>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="">Cod. Error</label>
                                <input class="form-control" name="coderror" type="text" value="" disabled>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="">Descripcion</label>
                                <textarea class="form-control" name="descripcion" rows="5" disabled></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="cerrar" type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
</body>

</html>
