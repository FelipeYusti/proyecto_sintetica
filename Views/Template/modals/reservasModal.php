<!-- Modal -->
<div class="modal fade" id="crearReservaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Escenario Deportivo</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="frmCrearCancha" method="POST">
                    <input type="hidden" name="idReserva" id="idReserva" value="0">
                    <div class="row">
                        <label for="txtName" class="form-label"><b>Nombre de el reservante</b> </label>
                        <input type="text" class="form-control" id="nombreReserva" name="nombreReserva" required>
                    </div>

                    <div class="row">
                        <label for="txtType" class="form-label"><b>Convenio(Si aplica)</b></label>
                        <select class="form-control" name="idConvenio" id="idConvenio" required>
                            <option selected="" value="" disabled>No aplica</option>
                            <div class="selectConvenio" name="nombreReserva" id="nombreReserva"></div>
                        </select>
                    </div>
                    <div class="row">
                        <div id="userStatusZone" class="mb-3">
                            <label for="genero" class="form-label">Usuario</label>
                            <select class="form-control" name="idUsuario" id="idUsuario">
                                <div class="selectUsuario" name="selectUsuario" id="selectUsuario"></div>
                            </select>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success">Reservar </button>
                </form>
            </div>
        </div>
    </div>
</div>