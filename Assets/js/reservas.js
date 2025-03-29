const frmCrearReserva = document.querySelector('#frmCrearReserva');
const btnCrearReserva = document.querySelector('#btnCrearReserva');
let idReservaInput = document.querySelector('#idReserva')

let select = '';


btnCrearReserva.addEventListener("click", () => {
  frmCrearReserva.reset();
  idReservaInput.value = '';
  select = '';
  document.getElementById("exampleModalLabel").innerHTML = "Crear Reserva";
  $("#crearReservaModal").modal("show");
});




window.addEventListener("DOMContentLoaded", () => {
  listUsuariosSelect();
  listConveniosSelect();
});

//===========================Listar los select de convenios y usuarios =================================

function listConveniosSelect() {
  fetch(base_url + "/reservas/getConvenios")
    .then((res) => res.json())
    .then((data) => {
      let selectElem = document.getElementById("selectConvenio");
      selectElem.innerHTML = "";
      data.data.forEach((convenio) => {
        selectElem.innerHTML += `<option value="${convenio.idconvenios}">${convenio.nombre}</option>`;
      });
    })
    .catch((error) => console.error("Error al listar convenios:", error));
}

function listUsuariosSelect() {
  fetch(base_url + "/reservas/getUsuarios")
    .then((res) => res.json())
    .then((data) => {
      let selectElem = document.getElementById("selectUsuario");
      selectElem.innerHTML = "";
      data.data.forEach((user) => {
        selectElem.innerHTML += `<option value="${user.idusers}">${user.username}</option>`;
      });
    })
    .catch((error) => console.error("Error al listar convenios:", error));
}
//====================================Listar las reservas en la tabla=============================================

function listReserva() {
  fetch(base_url + "/reservas/showTabla")
    .then((res) => res.json())
    .then((data) => {
      let tabla = document.getElementById("tablaReserva");
      tabla.innerHTML = '';
      data.forEach((reserva) => {
        tabla.innerHTML += `
                <tr>
                    <td>${reserva.idreservas}</td>
                    <td>${reserva.nombre}</td>
                    <td>${reserva.descripcion}</td>
                    <td>${reserva.fechaInicio}</td>
                    <td>${reserva.fechaFin}</td>
                    <td>${reserva.descuento}</td>
                    <td>${reserva.cancha_nombre}</td>
                    <td>
                        <button data-action-type="update" rel="${reserva.idreservas}" class="btn btn-success">Editar</button>
                        <button data-action-type="delete" rel="${reserva.idreservas}" class="btn btn-danger">Eliminar</button>
                    </td>
                </tr>`;
      });
    })
    .catch(error => console.error("Error al listar reservas:", error));
}

listReserva();
//=======================================Evento submit para definir la accion (Insert, delete, update)===========================================================================

document.addEventListener("click", (e) => {
  try {
    let button = e.target.closest("button");
    if (!button) return;

    let selected = button.getAttribute("data-action-type");
    let idReserva = button.getAttribute("rel");

    if (selected === "delete") {
      Swal.fire({
        title: "Eliminar la reserva",
        text: "¿Está seguro de eliminar la reserva?",
        icon: "warning",
        showDenyButton: true,
        confirmButtonText: "Sí",
        denyButtonText: `Cancelar`,
      }).then((result) => {
        if (result.isConfirmed) {
          fetch(base_url + "/reservas/deleteReserva/", {
            method: "DELETE",
            body: JSON.stringify({ idReserva }),
            headers: {
              "Content-Type": "application/json"
            }
          })
            .then((res) => res.json())
            .then((data) => {
              Swal.fire({
                title: data.status ? "Correcto" : "Error",
                text: data.msg,
                icon: data.status ? "success" : "error",
              }).then(() => {
                if (data.status) {
                  listReserva();
                }
              });
            });
        }
      });
    }

    if (selected === "update") {
      select = 'update';
      idReservaInput.value = idConvenio; // Guardar el ID en el input hidden
      $("#crearConvenioModal").modal("show");
      document.getElementById("exampleModalLabel").innerHTML = "Actualizar Convenio";

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
        .catch((error) => console.error("Error al obtener datos del convenio:", error));
    }

  } catch (error) {
    console.error("Error al manejar el clic:", error);
  }
});