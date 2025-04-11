const elements = {
  modal: document.querySelector("#detalles"),
  modalBody: document.querySelector("#modal-body"),
  btnClose: document.querySelector("#btn-close")[0]
};

document.addEventListener("DOMContentLoaded", function () {
  var calendarEl = document.getElementById("calendar");
  var calendar = new FullCalendar.Calendar(calendarEl, {
    locale: "es",
    headerToolbar: {
      left: "prev,next today",
      center: "title",
      right: "dayGridMonth,timeGridWeek,timeGridDay"
    },
    initialView: "dayGridMonth",
    editable: true, // Permite arrastrar y soltar Reservas
    ventOverlap: false, // No permite superposición de Reservas
    eventDrop: async (info) => {
      const fecha = info.event.start.toISOString().split("T")[0];
      const hora = info.event.start.getHours() + ":" + info.event.start.getMinutes();
      const id = info.event.extendedProps.idPivot;
      const result = await Swal.fire({
        title: "Actualizar Reserva",
        text: "¿Está seguro de actualizar la reserva?",
        icon: "warning",
        showDenyButton: true,
        confirmButtonText: "Sí",
        denyButtonText: "Cancelar"
      });

      if (result.isConfirmed) {
        let frmData = new FormData();
        frmData.append("idPivot", id);
        frmData.append("nuevaFecha", fecha);
        frmData.append("nuevaHora", hora);

        const data = await fetchData(`${base_url}/reservas/updateHorario`, "POST", frmData);

        Swal.fire({
          title: data.status ? "Correcto" : "Error",
          text: data.msg,
          icon: data.status ? "success" : "error",
          showConfirmButton: false,
          timer: 1700
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
      elements.modalBody.innerHTML = `<p><strong>Ubicacion : </strong> ${info.event.title}</p>`;
      elements.modalBody.innerHTML += `<p><strong> Fecha de Reserva : </strong> ${info.event.start.toISOString()}</p>`;
      elements.modalBody.innerHTML += `<p><strong> Hora de Inicio : </strong> ${info.event.extendedProps.hora}</p>`;
      elements.modalBody.innerHTML += `<p><strong>Reservada por : </strong> ${info.event.extendedProps.individuo}</p>`;
      elements.modalBody.innerHTML += `<p><strong>Tipo de cancha : </strong> ${info.event.extendedProps.tipo}</p>`;
      elements.modalBody.innerHTML += `<p><strong>Capacidad : ${info.event.extendedProps.capacidad} Jugadores</p>`;
      elements.modalBody.innerHTML += `<p><strong>Valor :</strong> $${info.event.extendedProps.valor} </p>`;

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
                start: `${fechaISO}T${reserva.horaReserva}`
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
    }
  });
  calendar.render();
});

const fetchData = async (url, method = "GET", body = null) => {
  try {
    const options = {
      method: method,
      body: body ? body : null
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
      text: error.message
    });
    return null;
  }
};
