const frmCrearReserva = document.querySelector("#frmCrearReserva");
const btnCrearReserva = document.querySelector("#btnCrearReserva");
let idReservaInput = document.querySelector("#idReserva");
let nombreReserva = document.querySelector("#nombreReserva");
let idConvenio = document.querySelector("#idConvenio");
let idUsuario = document.querySelector("#idUsuario");
let container2 = document.querySelector("#container2");
let container1 = document.querySelector("#container1");
let foother = document.querySelector("#footer");
let btnFormularioProducto = document.querySelector("#btnFormularioProducto");
let formularioProducto = document.querySelector("#formularioProducto");

let select = "";

btnCrearReserva.addEventListener("click", () => {
  frmCrearReserva.reset();
  document.getElementById("selectConvenio").selectedIndex = 0;
  document.getElementById("selectUsuario").selectedIndex = 0;
  container1.style.display = "none";
  foother.style.display = "none";
  container2.style.display = "block";
  idReservaInput.value = "";
  select = "";
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
    .catch((error) => console.error("Error al listar usuarios:", error));
}
//====================================Listar las reservas en la tabla=============================================

function listReserva() {
  fetch(base_url + "/reservas/showTabla")
    .then((res) => res.json())
    .then((data) => {
      let tabla = document.getElementById("tablaReservas");
      tabla.innerHTML = "";
      data.forEach((reserva) => {
        tabla.innerHTML += `
                <tr>
                    <td>${reserva.idreservas}</td>
                    <td>${reserva.nombreReserva}</td>
                    <td>${reserva.fechaReserva}</td>
                    <td>${reserva.nombreCancha}</td>
                    <td>${reserva.tipoCancha}</td>
                    <td>${reserva.capacidadCancha}</td>
                    <td>${reserva.valorCancha}</td>
                    <td>
                        <button data-action-type="update" rel="${reserva.idreservas}" class="btn btn-success">Editar</button>
                        <button data-action-type="delete" rel="${reserva.idreservas}" class="btn btn-danger">Eliminar</button>
                    </td>
                </tr>`;
      });
    })
    .catch((error) => console.error("Error al listar reservas:", error));
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
      console.log(idReserva);
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
            method: "POST",
            body: JSON.stringify({ idReserva }),
            headers: {
              "Content-Type": "application/json",
            },
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
      select = "update";
      idReservaInput.value = idReserva; // Guardar el ID en el input hidden
      $("#crearReservaModal").modal("show");
      document.getElementById("exampleModalLabel").innerHTML =
        "Actualizar reserva";

      fetch(base_url + `/reservas/getReserva/` + idReserva, {
        method: "GET",
      })
        .then((res) => res.json())
        .then((data) => {
          if (data.data.length > 0) {
            const reserva = data.data[0];
            idReservaInput.value = reserva.idreservas;
            nombreReserva.value = reserva.nombreReserva;
            idConvenio.value = reserva.nombreConvenios;
            idUsuario.value = reserva.username;
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

frmCrearReserva.addEventListener("submit", (e) => {
  e.preventDefault();

  let frmData = new FormData(frmCrearReserva);

  frmData.forEach((value, key) => {
    console.log(key, value);
  });

  if (select === "update") {
    frmData.append("idReserva", idReservaInput.value); // Usar el input hidden con el ID

    fetch(base_url + "/reservas/updateReserva", {
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
            $("#crearReservaModal").modal("hide");
            listReserva();
          }
        });
      });
  } else {
    fetch(base_url + "/reservas/createReserva", {
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
            frmCrearReserva.reset();
            $("#crearReservaModal").modal("hide");
            listReserva();
          }
        });
      });
  }
});

document.addEventListener("DOMContentLoaded", () => {
  const btnFormularioProducto = document.querySelector(
    "#btnFormularioProducto"
  );

  if (btnFormularioProducto) {
    btnFormularioProducto.addEventListener("click", () => {
      const formularioProducto = document.querySelector("#formularioProducto");

      if (formularioProducto) {
        formularioProducto.innerHTML += `
         <div class="row">
                                <div style="margin: 50px; border: 1px solid #ccc; padding: 50px; border-radius: 50px; box-shadow: 0 0 10px rgba(0,0,0,0.1); " class="mb-3">
                                    <input type="hidden" name="idReserva" id="idReserva" value="0">
                                    <div class="row">
                                        <label for="txtName" class="form-label"><b>Día de la reserva</b> </label>
                                        <input type="date" class="form-control" id="diaReserva" name="diaReserva" require>
                                    </div>
                                    <div class="row">
                                        <label for="txtName" class="form-label"><b>Hora de la reserva</b> </label>
                                        <input type="time" class="form-control" id="horaReserva" name="horaReserva" require>
                                    </div>
                                    <div class="row">
                                        <label for="txtName" class="form-label"><b>Horas reservadas</b> </label>
                                        <input type="number" class="form-control" id="horasReservadas" name="horasReservadas" require>
                                    </div>
                                </div>
                            </div>`;
      } else {
        console.error("El elemento con id 'formularioProducto' no existe.");
      }
    });
  } else {
    console.error("El botón 'btnFormularioProducto' no existe.");
  }
});
