@extends('layout.app')

@section('titulo', 'Tickets')

@section('template')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">
                TICKETS DE SOPORTE
            </h6>
            <a href="javascript:void(0)" onClick="add()" class="btn btn-sm btn-success">
                Abrir Ticket
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                    <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                    <path fill-rule="evenodd"
                        d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5" />
                </svg>
            </a>
        </div>
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
@endsection
