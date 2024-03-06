@extends('layout.app')

@section('titulo', 'Consulta API')

@section('template')
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">
                        CONSULTA A LA API
                    </h6>
                </div>
                <div class="card-body">
                    <form id="form-api">
                        <div class="form-group row">
                            <div class="mb-3 col-md-6">
                                <label for="url">RUC</label>
                                <input class="form-control" name="ruc" type="text" value="" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="url">Tipo Comprobante</label>
                                <select name="tipo" id="" class="form-control" required>
                                    <option hidden selected value="">Seleccione el tipo:</option>
                                    <option value="01">Factura</option>
                                    <option value="03">Boleta</option>
                                    <option value="07">Nota de Credito</option>
                                    <option value="08">Nota de Debito</option>
                                </select>
                            </div>
                            <div class="mb-3 col-md-3">
                                <label for="url">Serie</label>
                                <input class="form-control" name="serie" type="text" value="" required>
                            </div>
                            <div class="mb-3 col-md-3">
                                <label for="url">Correlativo</label>
                                <input class="form-control" name="correlativo" type="text" value="" required>
                            </div>
                            <div class="mb-3 col-md-3">
                                <label for="url">Fecha Emisión</label>
                                <input class="form-control" name="fecha" type="date" value="" required>
                            </div>
                            <div class="mb-3 col-md-3">
                                <label for="url">Monto</label>
                                <input class="form-control" name="monto" step="0.01" type="number" value=""
                                    required>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary">Borrar</button>
                            <button type="submit" class="btn btn-primary">Consultar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">
                        RESULTADO
                    </h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <textarea name="response" class="form-control" rows="8">

                        </textarea>
                    </div>
                </div>
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
        $('#form-api').submit(function(e) {
            e.preventDefault();

            let form = $('#form-api');
            let ruc = form.find('input[name=ruc]').val();
            let tipo = form.find('select[name=tipo]').val();
            let serie = form.find('input[name=serie]').val();
            let correlativo = form.find('input[name=correlativo]').val();
            let fecha = form.find('input[name=fecha]').val();
            let monto = form.find('input[name=monto]').val();

            $.ajax({
                type: "GET",
                url: `https://emite.tuscomprobantes.pe/wsconsulta/cpes/20531588119/03/B009/32659/2024-02-22/2006.42`,
                dataType: 'json',
                success: function(response) {
                    console.log(response)
                }
            });
        })
    </script>
@endsection
