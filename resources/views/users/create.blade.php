<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Registro De Usuario</h5>
                <button onclick="limpiar()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/user" method="post" oninput='confirm_password.setCustomValidity(confirm_password.value != password.value ? "Las Contraseñas NO Coinciden." : "")'>
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-6">
                            <label for="">Nombre(s)</label>
                            <input type="text" class="form-control" name="name" id="name" required>
                        </div>
                        <div class="form-group col-6">
                            <label for="">Apellidos</label>
                            <input type="text" class="form-control" name="last_name" id="last_name" required>
                        </div>
                        <div class="form-group col-12">
                            <label for="">Correo</label>
                            <input type="email" class="form-control" name="email" id="email" required>
                        </div>
                        <div class="form-group col-6">
                            <label for="">Contraseña</label>
                            <input type="password" class="form-control" name="password" id="password" required>
                        </div>
                        <div class="form-group col-6">
                            <label for="">Confirmar Contraseña</label>
                            <input type="password" class="form-control" name="confirm_password" id="confirm_password" required>
                        </div>
                    </div>
                    <div class="form-group col-12">
                        <label for="">Sucursal</label>
                        <select name="branch_id" id="branch_id" class="form-control">
                            <option value="null">Seleccione una sucursal</option>
                            @foreach($branches as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-12">
                        <label for="">Rol</label>
                        <select name="rol" id="rol" class="form-control">
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