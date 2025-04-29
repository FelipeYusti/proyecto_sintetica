const elements = {
  cardReservas: document.getElementById("reservasAno"),
  cardReservaHoy: document.getElementById("reservasHoy"),
  cardTotalAno: document.getElementById("totalMes"),
  cardTotalMes: document.getElementById("totalAno"),
  cardConvenios: document.getElementById("convenios"),
};

const renderCard = async () => {
  const request = {
    ResevasAno: document.getElementById("reservasAno"),
    ReservasHoy: await fetchData(base_url + "/home/getCantidaReservas"),
    TotalAno: await fetchData(base_url + "/home/getReservasAnual"),
    TotalMes: await fetchData(base_url + "/home/getReservasAnual"),
    Convenios: await fetchData(base_url + "/home/getCantidaConvenios"),
  };
  console.log(request.ReservasHoy.cantidad);
  elements.cardReservas.innerHTML = request.ReservasHoy.cantidad;
  elements.cardReservaHoy.innerHTML = "";
  elements.cardTotalAno.innerHTML = "";
  elements.cardTotalMes.innerHTML = "";
  elements.cardConvenios.innerHTML = request.Convenios.cantidad;
};

const fetchData = async (url, method = "GET", body = null) => {
  // definimos los paremetros que necesitamos.
  try {
    // Configuramos nuestra peticion
    const options = {
      method: method,
      body: body ? body : null,
    };
    // Ejecutamos la peticion enviando los parametros URL y Options.
    const response = await fetch(url, options); // Esperamos el response.

    if (!response.ok) {
      throw new Error(`Error ${response.status}: ${response.statusText}`);
    }

    return await response.json(); // retornamos la respuesta del fetch.
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

const chartLine = async () => {
  const ctxLine = document.getElementById("line");
  /*  const ganancias = await fetchData(base_url + "/home/getGananciaAnual") */ new Chart(
    ctxLine,
    {
      type: "line",
      data: {
        labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
        datasets: [
          {
            label: "My First Dataset",
            data: [65, 59, 80, 81, 56, 55, 40],
            fill: false,
            borderColor: "rgb(75, 192, 192)",
            tension: 0.1,
          },
        ],
      },
      options: {
        scales: {
          y: {
            beginAtZero: true,
          },
        },
      },
    }
  );
};
const chartBar = async () => {
  const ctx = document.getElementById("myChart");
  const dataReservas = await fetchData(base_url + "/home/getReservasAnual");
  console.log(dataReservas.fecha);
  new Chart(ctx, {
    type: "bar",
    data: {
      labels: dataReservas.fecha,
      datasets: [
        {
          label: "Reservas",
          data: dataReservas.cantidad,
          borderWidth: 1,
        },
      ],
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
        },
      },
    },
  });
};

chartBar();
chartLine();
renderCard();
