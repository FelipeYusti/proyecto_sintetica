const frmCrearConvenio = document.querySelector('#frmCrearConvenio');
let idConvenio = document.querySelector('#idConvenio');
let txtNombre = document.querySelector('#txtNombre');
let txtDescripcion = document.querySelector('#txtDescripcion');
let txtFechaInicio = document.querySelector('#txtFechaInicio');
let txtFechaFin = document.querySelector('#txtFechaFin');
let Descuento = document.querySelector('#Descuento');
const btnCrearConvenio = document.querySelector('#btnCrearConvenio');
//let idCanchasDisponibles = document.querySelectorAll('#idCanchasDisponibles');

window.addEventListener("DOMContentLoaded", (e) => {
    listConvenios();
    listCanchasSelect();
});


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

function listCanchasSelect() {

    fetch(base_url + "/convenios/getCanchas")
        .then((data) => data.json())
        .then((data) => {
            console.log(data);
            data.data.forEach((cancha) => {
                document.getElementById("idCanchasDisponibles").innerHTML +=
                    `<option value=${cancha.idcanchas}>${cancha.nombre}</option>`
            });
        });
}

btnCrearConvenio.addEventListener("click", () => {

    $("#crearConvenioModal").modal("show");
});
frmCrearConvenio.addEventListener("submit", (e) => {
    e.preventDefault();
    const frmData = new FormData(frmCrearConvenio);
    console.log(frmData);

    fetch(base_url + "/convenios/createConvenio", {
        method: "POST",
        body: frmData,
    })
        .then((res) => {
            // Verifica si la respuesta es de tipo JSON
            const contentType = res.headers.get("content-type");
            if (!contentType || !contentType.includes("application/json")) {
                return res.text().then((text) => {
                    throw new Error(`Esperaba JSON, pero recibí HTML: ${text}`);
                });
            }
            return res.json();  // Si es JSON, procesamos la respuesta
        })
        .then((data) => {
            console.log(data);
            Swal.fire({
                title: data.status ? "Correcto" : "Error",
                text: data.msg,
                icon: data.status ? "success" : "error",
            }).then(() => {
                // Solo después de que el usuario haya cerrado el SweetAlert
                if (data.status) {
                    frmCrearConvenio.reset();
                    $("#crearConvenioModal").modal("hide");
                }

                window.location.reload();
            });
        })
        .catch((error) => {
            // Muestra el error si algo sale mal
            console.error("Error en la solicitud:", error);
            Swal.fire({
                title: "Error",
                text: error.message,
                icon: "error",
            });
        });
});



