<div class="modal fade" id="create" tabindex="-1" aria-labelledby="importarDoc" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tituloModal">Agregar Detalle</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formDetalle" method="post">
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="id" value="">
                        <div class="form-group col-md-12">
                            <label for="">Cod. Error (*)</label>
                            <input class="form-control" name="coderror" type="text" placeholder="Ingrese el Cod Error" value="" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="">Descripcion del Error (*)</label>
                            <textarea class="form-control" name="descripcion" placeholder="Ingrese la descripción del error" rows="4" required></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="">Detalle (*)</label>
                            <textarea id="summernote" name="detalle"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="cerrar" type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button id="btn-create" type="submit" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
