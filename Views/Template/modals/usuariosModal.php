<!-- Modal -->
<div class="modal fade" id="crearUsuarioModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Crear usuario</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="frmCrearUsuario" method="POST">
                    <input type="hidden" name="idUsuario" id="idUsuario" value="0">
                    <div class="row">
                        <div class="mb-3 col-6">
                            <label for="txtUsername" class="form-label">Username</label>
                            <input type="text" class="form-control" id="txtUsername" name="txtUsername">
                        </div>
                        <div class="mb-3 col-6">
                            <label for="txtPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="txtPassword" name="txtPassword">
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-6">
                            <label for="genero" class="form-label">Roles de usuario</label>
                            <select class="form-control" name="txtRol" id="txtRol">
                                <option disabled>Seleccione el Rol</option>
                                <option value="admin">Administrador</option>
                                <option value="empleado">Empleado</option>

                            </select>
                        </div>
                        <div class="mb-3 col-6 ">
                            <label for="txtEmail" class="form-label">Correo electronico</label>
                            <input type="email" class="form-control" id="txtCorreo" name="txtCorreo">
                        </div>
                    </div>
                    <div id="userStatusZone" class="mb-3">
                        <label for="genero" class="form-label">Estado</label>
                        <select class="form-control" name="txtStatus" id="txtStatus">
                            <option value="2">Inactivo</option>
                            <option value="1">Activo</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary" id="btnEnviar">Crear</button>
                </form>
            </div>
        </div>
    </div>
</div>