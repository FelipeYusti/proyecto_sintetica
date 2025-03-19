const frmCrearConvenio = document.querySelector('#frmCrearConvenio');
let idConvenio = document.querySelectorAll('#idConvenio');
let txtNombre = document.querySelectorAll('#txtNombre');
let txtDescripcion = document.querySelectorAll('#txtDescripcion');
let txtFechaInicio = document.querySelectorAll('#txtFechaInicio');
let txtFechaFin = document.querySelectorAll('#txtFechaFin');
let Descuento = document.querySelectorAll('#Descuento');
let idCanchasDisponibles = document.querySelectorAll('#idCanchasDisponibles');


function listConvenios() {

    fetch(base_url + "/convenios/showTabla")
        .then((data) => data.json())
        .then((data) => {
            console.log(data);
            data.forEach((convenio) => {
                document.getElementById("tablaConvenios").innerHTML += `
              <tr>
              <td>${convenio.idconvenios}</td>
              <td>${convenio.nombre}</td>
              <td>${convenio.descripcion}</td>
              <td>${convenio.fechaInicio}</td>
              <td>${convenio.txtFechaFin}</td>
              <td>${convenio.descuento}</td>
              <td>${convenio.canchas_idcanchas}</td>
              <td>${convenio.actions}</td>
              <tr/>`;
            });
        });
}

window.addEventListener("DOMContentLoaded", (e) => {
    listConvenios();
});