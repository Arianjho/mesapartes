<div class="modal fade" id="agregar" tabindex="-1" aria-labelledby="importarDoc" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importarDoc">Agregar Cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formAgregar" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="">RUC</label>
                            <input class="form-control" name="ruc" type="text" value="" required>
                        </div>
                        <div class="form-group col-md-8">
                            <label for="">Razon Social</label>
                            <input class="form-control" name="razonsocial" type="text" value="" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Partner</label>
                            <select class="form-control" name="partner" id="" required>
                                <option value="" hidden selected>Seleccione el partner</option>
                                @foreach ($partners as $partner)
                                    <option value="{{ $partner->partner }}">{{ $partner->partner }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Estado</label>
                            <input class="form-control" name="estado" type="text" value="HABILITADO" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Modalidad</label>
                            <select class="form-control" name="modalidad" id="" required>
                                <option value="SUNAT" selected>SUNAT</option>
                                <option value="CDT">CDT</option>
                                <option value="OSE">OSE</option>
                                <option value="LLAMA.PE">LLAMA.PE</option>
                                <option value="BIZLINKS">BIZLINKS</option>
                                <option value="PSE">PSE</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Mod. Local</label>
                            <select class="form-control" name="modlocal" id="" required>
                                <option value="No" selected>No</option>
                                <option value="Si">Si</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="cerrar" type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success">Agregar</button>
                </div>
            </form>
        </div>
    </div>
</div>
