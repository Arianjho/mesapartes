<div class="modal fade" id="verincidencia" tabindex="-1" aria-labelledby="importarDoc" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importarDoc">Incidencia</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-verincidencia" method="post">
                <div class="modal-body">
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
                        <div class="form-group col-md-8">
                            <label for="">Razon Social</label>
                            <input class="form-control" name="razonsocial" type="text" value="" disabled>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Documento</label>
                            <input class="form-control" name="documento" type="text" value="" disabled>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="">Tipo</label>
                            <input class="form-control" name="tipodocumento" type="text" value="" disabled>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="">Serie</label>
                            <input class="form-control" name="serie" type="text" value="" disabled>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="">Correlativo</label>
                            <input class="form-control" name="correlativo" type="text" value="" disabled>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="">Error</label>
                            <input class="form-control" name="coderror" type="text" value="" disabled>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="">Descripcion Error</label>
                            <textarea class="form-control" name="descripcion" rows="5" disabled></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="">Descripcion Solución</label>
                            <textarea class="form-control" name="detalle" rows="2" disabled></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="cerrar" type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .checkbox-container {
        column-count: 12;
        column-gap: 20px;
    }
</style>

<div class="modal fade" id="filtros" tabindex="-1" aria-labelledby="importarDoc" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importarDoc">Aplicar Filtros</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formFiltros" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="">Errores:</label>
                            <div class="checkbox-container">
                                <div class="form-check">
                                    <input class="form-check-input" name="limpiarErrores" type="checkbox"
                                        id="limpiarError" checked>
                                    <label for="limpiarError" class="form-check-label">
                                        Todos
                                    </label>
                                </div>
                                @foreach ($errores as $error)
                                    <div class="form-check">
                                        <input class="form-check-input" name="errores[]" type="checkbox"
                                            value="{{ $error->coderror }}" id="codError{{ $error->coderror }}"
                                            checked>
                                        <label class="form-check-label" for="codError{{ $error->coderror }}">
                                            {{ $error->coderror }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="">Estado:</label>
                            <div class="form-check">
                                <input class="form-check-input" name="estados[]" type="checkbox" value="0"
                                    id="estadoRevisar" checked>
                                <label class="form-check-label" for="estadoRevisar">
                                    Por revisar
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" name="estados[]" type="checkbox" value="2"
                                    id="estadoPendiente" checked>
                                <label class="form-check-label" for="estadoPendiente">
                                    Pendiente
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" name="estados[]" type="checkbox" value="1"
                                    id="estadoSolucionado">
                                <label class="form-check-label" for="estadoSolucionado">
                                    Solucionados
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="cerrar" type="button" class="btn btn-secondary"
                        data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-secondary">Filtrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
