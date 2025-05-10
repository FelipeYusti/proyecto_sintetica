const frmCrearConvenio = document.querySelector("#frmCrearConvenio");
let idConvenioInput = document.querySelector("#idConvenio");
let txtNombre = document.querySelector("#txtNombre");
let txtDescripcion = document.querySelector("#txtDescripcion");
let txtFechaInicio = document.querySelector("#txtFechaInicio");
let txtFechaFin = document.querySelector("#txtFechaFin");
let Descuento = document.querySelector("#Descuento");
const btnCrearConvenio = document.querySelector("#btnCrearConvenio");

let select = "";

window.addEventListener("DOMContentLoaded", () => {
  listConvenios();
  listCanchasSelect();
});

function listConvenios() {
  fetch(base_url + "/convenios/showTabla")
    .then((res) => res.json())
    .then((data) => {
      let tabla = document.getElementById("tablaConvenios");
      tabla.innerHTML = "";
      data.forEach((convenio) => {
        tabla.innerHTML += `
                  <tr>
                      <td>${convenio.idconvenios}</td>
                      <td>${convenio.nombre}</td>
                      <td>${convenio.descripcion}</td>
                      <td>${convenio.fechaInicio}</td>
                      <td>${convenio.fechaFin}</td>
                      <td>${convenio.descuento}</td>
                      <td>${convenio.cancha_nombre}</td>
                      <td>
                          <button data-action-type="update" rel="${convenio.idconvenios}" class="btn btn-outline-success"><i class="bi bi-pencil-square"></i></button>
                          <button data-action-type="delete" rel="${convenio.idconvenios}" class="btn btn-outline-danger"><i class="bi bi-trash3"></i></button>
                      </td>
                  </tr>`;
      });
    })
    .catch((error) => console.error("Error al listar convenios:", error));
}

function listCanchasSelect() {
  fetch(base_url + "/convenios/getCanchas")
    .then((res) => res.json())
    .then((data) => {
      let selectElem = document.getElementById("idCanchasDisponibles");
      selectElem.innerHTML = "";
      data.data.forEach((cancha) => {
        selectElem.innerHTML += `<option value="${cancha.idcanchas}">${cancha.nombre}</option>`;
      });
    })
    .catch((error) => console.error("Error al listar canchas:", error));
}

btnCrearConvenio.addEventListener("click", () => {
  frmCrearConvenio.reset();
  idConvenioInput.value = "";
  select = "";
  document.getElementById("exampleModalLabel").innerHTML = "Crear Convenio";
  $("#crearConvenioModal").modal("show");
});

document.addEventListener("click", (e) => {
  try {
    let button = e.target.closest("button");
    if (!button) return;

    let selected = button.getAttribute("data-action-type");
    let idConvenio = button.getAttribute("rel");
    if (selected === "delete") {
      console.log("ID que se envía:", idConvenio); // Verifica si el ID se obtiene bien

      Swal.fire({
        title: "Eliminar el convenio",
        text: "¿Está seguro de eliminar el convenio?",
        icon: "warning",
        showDenyButton: true,
        confirmButtonText: "Sí",
        denyButtonText: `Cancelar`,
      }).then((result) => {
        if (result.isConfirmed) {
          fetch(base_url + "/convenios/deleteConvenio", {
            method: "POST", // Enviar como POST
            body: JSON.stringify({ idConvenio }), // Enviar el ID como JSON
            headers: { "Content-Type": "application/json" },
          })
            .then((res) => res.json())
            .then((data) => {
              Swal.fire({
                title: data.status ? "Correcto" : "Error",
                text: data.msg,
                icon: data.status ? "success" : "error",
              }).then(() => {
                if (data.status) {
                  listConvenios();
                }
              });
            })
            .catch((error) => console.error("Error en la eliminación:", error));
        }
      });
    }

    if (selected === "update") {
      select = "update";
      idConvenioInput.value = idConvenio; // Guardar el ID en el input hidden
      $("#crearConvenioModal").modal("show");
      document.getElementById("exampleModalLabel").innerHTML =
        "Actualizar Convenio";

      fetch(base_url + `/convenios/getConvenio/` + idConvenio, {
        method: "GET",
      })
        .then((res) => res.json())
        .then((data) => {
          if (data.data.length > 0) {
            const convenio = data.data[0];
            txtNombre.value = convenio.nombre;
            txtDescripcion.value = convenio.descripcion;
            txtFechaInicio.value = convenio.fechaInicio;
            txtFechaFin.value = convenio.fechaFin;
            Descuento.value = convenio.descuento;
          }
        })
        .catch((error) =>
          console.error("Error al obtener datos del convenio:", error)
        );
    }
  } catch (error) {
    console.error("Error al manejar el clic:", error);
  }
});

frmCrearConvenio.addEventListener("submit", (e) => {
  e.preventDefault();

  let frmData = new FormData(frmCrearConvenio);
  if (select === "update") {
    frmData.append("idConvenio", idConvenioInput.value); // Usar el input hidden con el ID

    fetch(base_url + "/convenios/updateConvenio", {
      method: "POST",
      body: frmData,
    })
      .then((res) => res.json())
      .then((data) => {
        Swal.fire({
          title: data.status ? "Correcto" : "Error",
          text: data.msg,
          icon: data.status ? "success" : "error",
        }).then(() => {
          if (data.status) {
            frmCrearConvenio.reset();
            $("#crearConvenioModal").modal("hide");
            listConvenios();
          }
        });
      });
  } else {
    fetch(base_url + "/convenios/createConvenio", {
      method: "POST",
      body: frmData,
    })
      .then((res) => res.json())
      .then((data) => {
        Swal.fire({
          title: data.status ? "Correcto" : "Error",
          text: data.msg,
          icon: data.status ? "success" : "error",
        }).then(() => {
          if (data.status) {
            frmCrearConvenio.reset();
            $("#crearConvenioModal").modal("hide");
            listConvenios();
          }
        });
      });
  }
});
