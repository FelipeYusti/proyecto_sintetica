<!-- Modal Editar -->
<div class="modal fade" id="editarReservaModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="editarReservaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white" id="editarReservaLabel">
                    <b>Editar Reserva</b>
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form id="frmEditarReserva" method="POST">

                    <input type="hidden" name="idReserva" id="idReserva" value="0">

                    <div class="mb-3">
                        <label for="nombreReserva" class="form-label"><b>Nombre del reservante</b></label>
                        <input type="text" class="form-control" id="nombreReserva" name="nombreReserva">
                    </div>

                    <div class="mb-3">
                        <label for="idConvenio" class="form-label"><b>Convenio (si aplica)</b></label>
                        <select class="form-control" name="idConvenio" id="idConvenio">
                            <option selected disabled>No aplica</option>
                            <div class="selectConvenio" name="selectConvenio" id="selectConvenio"></div>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="idUsuario" class="form-label"><b>Usuario</b></label>
                        <select class="form-control" name="idUsuario" id="idUsuario">
                            <option selected disabled>Seleccione el usuario</option>
                            <div class="selectUsuario" name="selectUsuario" id="selectUsuario"></div>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="diaReserva" class="form-label"><b>Día de la reserva</b></label>
                        <input type="text" class="form-control" id="diaReserva" name="diaReserva">
                    </div>

                    <div class="mb-3">
                        <label for="horaReserva" class="form-label"><b>Hora de la reserva</b></label>
                        <input type="text" class="form-control" id="horaReserva" name="horaReserva">
                    </div>

                    <div class="mb-3">
                        <label for="horasReservas" class="form-label"><b>Horas reservadas</b></label>
                        <input type="text" class="form-control" id="horasReservas" name="horasReservas">
                    </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</div>