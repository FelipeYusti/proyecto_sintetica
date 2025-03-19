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
              <td>${convenio.fechaFin}</td>
              <td>${convenio.descuento}</td>
              <td>${convenio.cancha_nombre}</td>
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
    frmData = new FormData(frmCrearConvenio);
    console.log(frmData);

    fetch(base_url + "/convenios/createConvenio", {
        method: "POST",
        body: frmData,
    })
        .then((res) => res.json())
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
        });
});



document.addEventListener("click", (e) => {
    try {
        let selected = e.target.closest("button").getAttribute("data-action-type");
        let idConvenio = e.target.closest("button").getAttribute("rel");

        if (selected == "delete") {
            Swal.fire({
                title: "Eliminar el convenio",
                text: "¿Está seguro de eliminar el convenio?",
                icon: "warning",
                showDenyButton: true,
                confirmButtonText: "Sí",
                denyButtonText: `Cancelar`,

            }).then((result) => {
                if (result.isConfirmed) {
                    let formData = new FormData();
                    formData.append("idConvenio", idConvenio);
                    console.log(idConvenio);
                    fetch(base_url + "/convenios/deleteConvenio/", {
                        method: "POST",
                        body: formData,
                    })
                        .then((res) => res.json())
                        .then((data) => {
                            Swal.fire({
                                title: data.status ? "Correcto" : "Error",
                                text: data.msg,
                                icon: data.status ? "success" : "error",
                            }).then(() => {
                                if (data.status) {
                                    window.location.reload();  // Recargar la página
                                }
                            })
                        });
                }
            });

        }

        if (selected == "update") {
            accion = "update";
            $("#crearAprendizModal").modal("show");
            document.getElementById("crearAprendizModalLabel").innerHTML =
                "Actualizar Aprendiz";

            fetch(aprendicesUrl + `getAprendizByID/` + idAprendiz, {
                method: "GET",
            })
                .then((res) => res.json())
                .then((res) => {
                    aprendiz = res.data[0];
                    console.log(aprendiz);

                    document.querySelector("#numeroDocumentoAprendiz").value =
                        aprendiz.numdoc;
                    document.querySelector("#nombreAprendiz").value =
                        aprendiz.nombre_aprendiz;
                    document.querySelector("#apellidoAprendiz").value =
                        aprendiz.apellido_aprendiz;
                    document.querySelector("#generoAprendiz").value =
                        aprendiz.generos_idgenero;
                    document.querySelector("#codigoAprendiz").value =
                        aprendiz.codigo_aprendiz;
                    container2.style.display = "none";
                    /*  document.querySelector(
                      "#generoAprendiz"
                    ).innerHTML = `<option selected hidden value="${aprendiz.generos_idgenero}">${aprendiz.generos_idgenero}</option>
                    <option value="Masculino">Masculino</option>
                    <option value="Femenino">Femenino</option>
                    <option value="Otros">Otros..</option>`; */
                });
        }

    } catch { }
});

