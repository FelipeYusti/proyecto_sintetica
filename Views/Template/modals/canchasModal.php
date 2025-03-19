<!-- Modal -->
<div class="modal fade" id="crearCanchasModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Escenario Deportivo</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="frmCrearCancha" method="POST">
                   
                    <div class="row">
                        <div class="mb-3 col-6">
                            <label for="txtName" class="form-label"><b>Nombre(s)</b> </label>
                            <input type="text" class="form-control" id="txtName" name="txtName" required>
                        </div>
                        <div class="mb-3 col-6">
                            <label for="txtType" class="form-label"><b>Tipo de cancha</b> </label>
                            <select class="form-control" name="txtType" id="txtType" required>
                                <option selected="" disabled>Seleccione el tipo</option>
                                <option value="Futbol">Futbol</option>
                                <option value="Volley">Volley</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-6">
                            <label for="txtDocumento" class="form-label"><b>Capacidad</b></label>
                            <select class="form-control" name="txtCapacitance" id="txtCapacitance" aria-label=".form-select-lg example" required>
                                <option selected="" disabled>Seleccione capacidad</option>
                                <option value="5">5 jugadores</option>
                                <option value="6">6 jugadores</option>
                                <option value="8">8 jugadores</option>
                                <option value="10">10 jugadores</option>
                            </select>
                        </div>

                        <div class="mb-3 col-6">
                            <label for="txtTelefono" class="form-label"><b>Coste $</b></label>
                            <input type="number" class="form-control" min="1" id="txtPrice" name="txtPrice" required>
                        </div>
                    </div>
                    <div class="row">
                        <div id="userStatusZone" class="mb-3">
                            <label for="genero" class="form-label">Estado</label>
                            <select class="form-control" name="txtStatus" id="txtStatus">
                                <option value="0">Inactivo</option>
                                <option value="1">Activo</option>
                            </select>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success" id="btnEnviar">Regsitrar </button>
                </form>
            </div>
        </div>
    </div>
</div>