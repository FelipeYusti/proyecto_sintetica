<!-- Modal -->
<div class="modal fade" id="crearConvenioModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Escenario Deportivo</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="frmCrearConvenio" method="POST">
                    <input type="hidden" name="idConvenio" id="idConvenio" value="0">
                    <div class="row">
                        <div class="mb-3 col-6">
                            <label for="txtName" class="form-label"><b>Nombre del convenio</b> </label>
                            <input type="text" class="form-control" id="txtNombre" name="txtNombre" required>
                        </div>
                        <div class="mb-3 col-6">
                            <label for="txtType" class="form-label"><b>Descripcion del convenio</b> </label>
                            <input type="text" class="form-control" id="txtDescripcion" name="txtDescripcion" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-6">
                            <label for="txtDocumento" class="form-label"><b>Fecha de inicio </b></label>
                            <input type="date" class="form-control" id="txtFechaInicio" name="txtFechaInicio" required>
                        </div>

                        <div class="mb-3 col-6">
                            <label for="txtTelefono" class="form-label"><b>Fecha final</b></label>
                            <input type="date" class="form-control" id="txtFechaFin" name="txtFechaFin" required>
                        </div>
                    </div>
                    <div class="row">
                        <div id="userStatusZone" class="mb-3">
                            <label for="genero" class="form-label">Descuento</label>
                            <select class="form-control" name="txtDescuento" id="txtDescuento">
                                <option value=10>10%</option>
                                <option value=20>20%</option>
                                <option value=30>30%</option>
                                <option value=40>40%</option>
                            </select>
                        </div>
                        <div id="userStatusZone" class="mb-3">
                            <label for="genero" class="form-label">Cancha elejida</label>
                            <select class="form-control" name="txtCancha" id="txtCancha">
                                <div class="canchas" id="idCanchasDisponibles" name="idCanchasDisponibles"></div>
                            </select>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success">Registrar </button>
                </form>
            </div>
        </div>
    </div>
</div>