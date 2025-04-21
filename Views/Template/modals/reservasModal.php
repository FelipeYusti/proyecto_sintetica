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
                    <input type="hidden" name="idReservaPivote" id="idReservaPivote" value="0">

                    <div class="mb-3">
                        <label for="nombreReserva" class="form-label"><b>Nombre del reservante</b></label>
                        <input type="text" class="form-control" id="nombreReserva" name="nombreReserva" required>
                    </div>

                    <div class="mb-3">
                        <label for="idConvenio" class="form-label"><b>Convenio (si aplica)</b></label>
                        <select class="form-control" name="idConvenio" id="idConvenio" required>
                            <option selected disabled>No aplica</option>
                            <div class="selectConvenio" name="selectConvenioEditar" id="selectConvenioEditar"></div>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="idUsuario" class="form-label"><b>Usuario</b></label>
                        <select class="form-control" name="idUsuario" id="idUsuario" required>
                            <option selected disabled>Seleccione el usuario</option>
                            <div class="selectUsuario" name="selectUsuarioEditar" id="selectUsuarioEditar"></div>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="diaReserva" class="form-label"><b>Día de la reserva</b></label>
                        <input type="text" class="form-control" id="diaReserva" name="diaReserva" required>
                    </div>

                    <div class="mb-3">
                        <label for="genero" class="form-label"><b>Cancha</b></label>
                        <select class="form-control" name="idCancha1" id="idCancha1" required>
                            <option selected="" value="" disabled>Seleccione la cancha</option>
                            <div class="selectUsuario" name="idCanchaEditar" id="idCanchaEditar"></div>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="horaReserva" class="form-label"><b>Hora de la reserva</b></label>
                        <input type="time" class="form-control" id="horaReserva" name="horaReserva" required>
                    </div>

                    <div class="mb-3">
                        <label for="horasReservas" class="form-label"><b>Horas reservadas</b></label>
                        <input type="number" class="form-control" id="horasReservas" name="horasReservas" required>
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