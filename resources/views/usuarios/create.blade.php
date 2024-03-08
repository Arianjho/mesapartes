<div class="modal fade" id="create" tabindex="-1" aria-labelledby="importarDoc" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tituloModal">Agregar Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-usuarios" method="post">
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="id" value="">
                        <div class="form-group col-md-6">
                            <label for="">DNI (*)</label>
                            <input class="form-control" name="dni" type="text" value="" required>
                        </div>
                        <div id="password" class="form-group col-md-6">
                            <label for="">Contraseña (*)</label>
                            <div class="input-group">
                                <input class="form-control" name="password" type="password" value="">
                                <div class="input-group-append">
                                    <button id="btn-password" onClick="verPassword()" class="btn btn-outline-secondary" type="button">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Nombres (*)</label>
                            <input class="form-control" name="nombres" type="test" value="" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Apellidos (*)</label>
                            <input class="form-control" name="apellidos" type="text" value="" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Correo</label>
                            <input class="form-control" name="correo" type="email" value="" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Celular</label>
                            <input class="form-control" name="celular" type="tel" value="" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Perfil</label>
                            <select class="form-control" name="perfil" id="">
                                <option value="" hidden selected>Asigne un perfil:</option>
                                @foreach ($perfiles as $perfil)
                                    <option value="{{ $perfil->id }}">{{ $perfil->perfil }}</option>
                                @endforeach
                            </select>
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
