<div class="modal fade" id="userModalEdit" tabindex="-1" role="dialog" aria-labelledby="userModalLabelEdit" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabelEdit">Editar Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="userModalEditForm" action="/user" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-row">
                        <div class="form-group col-6">
                            <label for="">Nombre(s)</label>
                            <input type="text" class="form-control" name="name" id="nameEdit" required>
                        </div>
                        <div class="form-group col-6">
                            <label for="">Apellidos</label>
                            <input type="text" class="form-control" name="last_name" id="last_nameEdit" required>
                        </div>
                        <div class="form-group col-12">
                            <label for="">Correo</label>
                            <input type="email" class="form-control" name="email" id="emailEdit" required>
                        </div>
                    </div>
                    <div class="form-group col-12">
                        <label for="">Sucursal</label>
                        <select name="branch_id" id="branch_idEdit" class="form-control">
                            <option value="null">Seleccione una sucursal</option>
                            @foreach($branches as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-12">
                        <label for="">Rol</label>
                        <select name="rol" id="rolEdit" class="form-control">
                            <option value="null">Seleccione un rol</option>
                            <option value="manager">gerente</option>
                            <option value="admin">administrador</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button onclick="limpiar()" type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>