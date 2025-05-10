const editarReservaModal = document.querySelector("#editarReservaModal");
const frmEditarReserva = document.querySelector("#frmEditarReserva");
const btnCrearReserva = document.querySelector("#btnCrearReserva");
let container2 = document.querySelector("#container2");
let container1 = document.querySelector("#container1");
let foother = document.querySelector("#footer");
let btnFormularioProducto = document.querySelector("#btnFormularioProducto");
let formularioProducto = document.querySelector("#formularioProducto");

//====
let idReservaInput = document.querySelector("#idReserva");
let idReservaPivote = document.querySelector("#idReservaPivote");
let nombreReserva = document.querySelector("#nombreReserva");
let idConvenio = document.querySelector("#idConvenio");
let idUsuario = document.querySelector("#idUsuario");
let diaReserva = document.querySelector("#diaReserva");
let idCancha1 = document.querySelector("#idCancha1");
let idCancha = document.querySelector("#idCancha");
let horaReserva = document.querySelector("#horaReserva");
let horasReservas = document.querySelector("#horasReservas");
//===

let select = "";
let contadorClicks2 = 0;

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
      console.log(data);
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

function listCanchasSelect() {
  fetch(base_url + "/reservas/getCanchas")
    .then((res) => res.json())
    .then((data) => {
      data.data.forEach((cancha) => {
        let selectElem = document.getElementById("idCancha1");
        selectElem.innerHTML += `<option value="${cancha.idcanchas}">${cancha.nombre}</option>`;
      });
    })
    .catch((error) => console.error("Error al listar canchas:", error));
}
listCanchasSelect();

//=========================================================================================
const elements = {
  modal: document.querySelector("#detalles"),
  modal: document.querySelector("#editarReservaModal"),
  modalBody: document.querySelector("#modal-body"),
  btnClose: document.querySelector("#btn-close")[0],
};

document.addEventListener("DOMContentLoaded", function () {
  var calendarEl = document.getElementById("calendar");
  var calendar = new FullCalendar.Calendar(calendarEl, {
    locale: "es",
    lang: "es",
    timeZone: "UTC",
    eventColor: "#378006",
    eventTimeFormat: {
      hour: "numeric",
      minute: "2-digit",
      meridiem: "short",
    },
    headerToolbar: {
      left: "prev,next today",
      center: "title",
      right: "dayGridMonth,timeGridWeek,timeGridDay",
    },
    initialView: "dayGridMonth",
    editable: true, // Permite arrastrar y soltar Reservas
    ventOverlap: false, // No permite superposición de Reservas
    eventDrop: async (info) => {
      const fecha = info.event.start.toISOString().split("T")[0];
      const hora =
        info.event.start.getHours() + ":" + info.event.start.getMinutes();
      const id = info.event.extendedProps.idPivot;
      const result = await Swal.fire({
        title: "Actualizar Reserva",
        text: "¿Está seguro de actualizar la reserva?",
        icon: "warning",
        showDenyButton: true,
        confirmButtonText: "Sí",
        denyButtonText: "Cancelar",
      });

      if (result.isConfirmed) {
        let frmData = new FormData();
        frmData.append("idPivot", id);
        frmData.append("nuevaFecha", fecha);
        frmData.append("nuevaHora", hora);

        const data = await fetchData(
          `${base_url}/reservas/updateHorario`,
          "POST",
          frmData
        );

        Swal.fire({
          title: data.status ? "Correcto" : "Error",
          text: data.msg,
          icon: data.status ? "success" : "error",
          showConfirmButton: false,
          timer: 1700,
        });

        if (!data.status) {
          info.revert();
        }
      } else {
        // Si el usuario cancela, revertir el cambio
        info.revert();
      }
    },
    eventClick: (info) => {
      elements.modalBody.innerHTML = ` <p><strong> Ubicacion : </strong> ${info.event.title}</p>`;
      elements.modalBody.innerHTML += `<p><strong> Fecha de Reserva : </strong> ${
        info.event.start.toISOString().split("T")[0]
      }</p>`;
      elements.modalBody.innerHTML += `<p><strong> Hora de Inicio : </strong> ${info.event.extendedProps.hora}</p>`;
      elements.modalBody.innerHTML += `<p></i><strong> Reservada por : </strong> ${info.event.extendedProps.individuo}</p>`;
      elements.modalBody.innerHTML += `<p><strong>Tipo de cancha : </strong> ${info.event.extendedProps.tipo}</p>`;
      elements.modalBody.innerHTML += `<p><strong>Capacidad : ${info.event.extendedProps.capacidad} Jugadores</p>`;
      elements.modalBody.innerHTML += `<p><strong>Valor :</strong> $${info.event.extendedProps.valor} </p>`;
      elements.modalBody.innerHTML += `<button type="button" style="margin-right: 10px; margin-top: 15px;" class="btn btn-outline-primary" onclick="editar(${info.event.extendedProps.idPivot})">Editar</button>`;
      elements.modalBody.innerHTML += `<button type="button" style="margin-top: 15px;" class="btn btn-outline-danger" onclick="cancelar(${info.event.extendedProps.idPivot})">Cancelar reserva</button>`;
      console.log(info.event.extendedProps.idPivot);
      $("#detalles").modal("show");
    },

    events: (info, successCallback) => {
      const url = `${base_url}/reservas/showTabla`;
      fetchData(url, "GET", null)
        .then((response) => {
          if (Array.isArray(response)) {
            const reservas = response.map((reserva) => {
              // Convertir la fecha a un formato ISO 8601
              const fecha = new Date(reserva.fechaReserva);
              const fechaISO = fecha.toISOString().split("T")[0]; // Obtener solo la parte de la fecha
              return {
                id: reserva.idreservas,
                idPivot: reserva.idPivot,
                title: reserva.nombreCancha,
                individuo: reserva.nombreReserva,
                capacidad: reserva.capacidadCancha,
                tipo: reserva.tipoCancha,
                hora: reserva.horaReserva,
                valor: reserva.valorCancha,
                start: `${fechaISO}T${reserva.horaReserva}`,
              };
            });
            successCallback(reservas);
          } else {
            console.log("error", response.msg);
          }
        })
        .catch((error) => {
          console.error("Error al cargar las reservas:", error);
        });
    },
  });
  calendar.render();
});
//==========================================================EDITAR==================================================

function editar(idPivote) {
  $("#detalles").modal("hide");
  $("#editarReservaModal").modal("show");
  listCanchasSelectEditar();
  listConveniosSelectEditar();
  listUsuariosSelectEditar();
  select = "update";
  const idReservaInput = document.getElementById("idReserva");
  idReservaInput.value = idPivote;

  fetch(`${base_url}/reservas/getReserva/${idPivote}`, {
    method: "GET",
  })
    .then((res) => res.json())
    .then((data) => {
      console.log(data.data);

      if (data.data.length > 0) {
        const reserva = data.data[0];
        idReservaInput.value = reserva.idreservas;
        idReservaPivote.value = reserva.idPivote;
        nombreReserva.value = reserva.nombre;
        idConvenio.value = reserva.convenios_idconvenios;
        idUsuario.value = reserva.users_idusers;
        diaReserva.value = reserva.fecha;
        idCancha.value = reserva.canchas_idcanchas;
        horaReserva.value = reserva.horaReserva;
        horasReservas.value = reserva.horasReservadas;
      }
    });
}

//--------------------------------------------------Cancelar cita ---------------------------------------------------------
function cancelar(idPivote) {
  Swal.fire({
    title: "Estas seguro que deseas cancelar la reserva?",
    text: `Esto no se puede revertir! ${idPivote}`,
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!",
  }).then((result) => {
    if (result.isConfirmed) {
      fetch(`${base_url}/reservas/cancelarReserva`, {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: `idReserva=${idPivote}`,
      })
        .then((response) => response.json())
        .then((data) => {
          Swal.fire({
            title: "Cancelada!",
            text: "Se a cancelado la reserva correctamente",
            icon: "success",
          }).then(() => {
            window.location.reload();
          });
        })
        .catch((error) => {
          Swal.fire({
            title: "Error!",
            text: "No se a podido eliminar la reserva",
            icon: "error",
          });
          console.error(error);
        });
    }
  });
}

//------------------------------------

const fetchData = async (url, method = "GET", body = null) => {
  try {
    const options = {
      method: method,
      body: body ? body : null,
    };

    const response = await fetch(url, options);

    if (!response.ok) {
      throw new Error(`Error ${response.status}: ${response.statusText}`);
    }

    return await response.json();
  } catch (error) {
    console.error("Error en fetchData:", error);
    Swal.fire({
      icon: "error",
      title: "Error",
      text: error.message,
    });
    return null;
  }
};

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

const frmCrearReserva = document.querySelector("#frmCrearReserva");

frmCrearReserva.addEventListener("submit", (e) => {
  e.preventDefault();

  let frmData = new FormData(frmCrearReserva);

  if (select === "update") {
    // lógica para update
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
            location.reload();
          }
        });
      });
  }
});

editarReservaModal.addEventListener("submit", (e) => {
  e.preventDefault();

  let frmData = new FormData(frmEditarReserva);

  frmData.forEach((value, key) => {
    console.log(key, value);
  });

  // ========================================================================COMENTAREADO POR PRUEBAAAAAA========================
  if (select === "update") {
    frmData.append("idReserva", idReservaInput.value); // Usar el input hidden con el ID
    frmData.append("idReservaPivote", idReservaPivote.value);

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
            frmEditarReserva.reset();
            $("#editarReservaModal").modal("hide");
            location.reload();
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
  let contadorClicks = 1;

  const btnFormularioProducto = document.querySelector(
    "#btnFormularioProducto"
  );

  btnFormularioProducto.addEventListener("click", () => {
    const formularioProducto = document.querySelector("#formularioProducto");
    contadorClicks++;
    contadorClicks2++;

    if (contadorClicks > 5) {
      Swal.fire({
        icon: "error",
        title: "Llegaste al limite",
        text: "No se pueden hacer más de 5 reservas",
      });
    } else {
      if (formularioProducto) {
        switch (contadorClicks) {
          case 2:
            console.log("2");
            document.getElementById("idRow2").style.display = "block";
            // Con esto especifica que tipo de entrada de datos acepta
            const campos = document.querySelectorAll(
              "#idRow2 input, #idRow2 select, #idRow2 textarea"
            );
            campos.forEach((el) => (el.disabled = false));

            break;
          case 3:
            console.log("3");
            document.getElementById("idRow3").style.display = "block";
            const campos3 = document.querySelectorAll(
              "#idRow3 input, #idRow3 select, #idRow3 textarea"
            );
            campos3.forEach((el) => (el.disabled = false));
            break;
          case 4:
            console.log("4");
            document.getElementById("idRow4").style.display = "block";
            const campos4 = document.querySelectorAll(
              "#idRow4 input, #idRow4 select, #idRow4 textarea"
            );
            campos4.forEach((el) => (el.disabled = false));
            break;
          case 5:
            console.log("5");
            document.getElementById("idRow5").style.display = "block";
            const campos5 = document.querySelectorAll(
              "#idRow5 input, #idRow5 select, #idRow5 textarea"
            );
            campos5.forEach((el) => (el.disabled = false));
            break;
          default:
        }

        let selectElem = document.getElementById(`idCancha${contadorClicks}`);

        // Validación para que el dia de la reserva, no se puede hacer un dia pasado

        fetch(base_url + "/reservas/getCanchas")
          .then((res) => res.json())
          .then((data) => {
            console.log(data);
            data.data.forEach((cancha) => {
              selectElem.innerHTML += `<option value="${cancha.idcanchas}">${cancha.nombre}</option>`;
            });
          })
          .catch((error) => console.error("Error al listar canchas:", error));
      } else {
        console.error("El elemento con id 'formularioProducto' no existe.");
      }
    }
  });
});

// ----------------------------------------------------------------------Select de modal de editar-----------------------------------------------------------------------

function listConveniosSelectEditar() {
  fetch(base_url + "/reservas/getConvenios")
    .then((res) => res.json())
    .then((data) => {
      console.log(data);
      let selectElem = document.getElementById("selectConvenioEditar");
      selectElem.innerHTML = "";
      data.data.forEach((convenio) => {
        selectElem.innerHTML += `<option value="${convenio.idconvenios}">${convenio.nombre}</option>`;
      });
    })
    .catch((error) => console.error("Error al listar convenios:", error));
}

function listUsuariosSelectEditar() {
  fetch(base_url + "/reservas/getUsuarios")
    .then((res) => res.json())
    .then((data) => {
      let selectElem = document.getElementById("selectUsuarioEditar");
      selectElem.innerHTML = "";
      data.data.forEach((user) => {
        selectElem.innerHTML += `<option value="${user.idusers}">${user.username}</option>`;
      });
    })
    .catch((error) => console.error("Error al listar usuarios:", error));
}

function listCanchasSelectEditar() {
  fetch(base_url + "/reservas/getCanchas")
    .then((res) => res.json())
    .then((data) => {
      data.data.forEach((cancha) => {
        let selectElem = document.getElementById("idCanchaEditar");
        selectElem.innerHTML += `<option value="${cancha.idcanchas}">${cancha.nombre}</option>`;
      });
    })
    .catch((error) => console.error("Error al listar canchas:", error));
}

//====================================================================== Validacion de la cancha dsiponible =============================================================

let diaReserva1 = document.querySelector("#diaReserva1");
let horaReserva1 = document.querySelector("#horaReserva1");

horaReserva1.style.display = "none";

diaReserva1.addEventListener("input", (e) => {
  console.log("1");
  horaReserva1.style.display = "block";
  horaReserva1.focus();
});

horaReserva1.addEventListener("input", () => {
  console.log("2");
  const fecha = diaReserva1.value;
  const hora = horaReserva1.value;

  let frmData = new FormData();

  let idCancha1 = document.getElementById(`idCancha${contadorClicks2}`);
  let inputDiaReserva1 = document.querySelector(
    `#diaReserva${contadorClicks2}`
  );
  let inputHoraReserva1 = document.querySelector(
    `#horaReserva${contadorClicks2}`
  );
  let horasReservadas1 = document.querySelector(
    `horasReservadas${contadorClicks2}`
  );
  let url = base_url + `/reservas/getCanchaValidacion`;

  frmData.append("hora", hora);
  frmData.append("fecha", fecha);

  fetch(url, {
    method: "POST",
    body: frmData,
  })
    .then((res) => res.json())
    .then((data) => {
      console.log(data);
      data.data.forEach((cancha) => {
        selectElem.innerHTML += `<option value="${cancha.idcanchas}">${cancha.nombre}</option>`;
      });
    })
    .catch((error) => console.error("Error al listar canchas:", error));
});
