const fetchData = async (url, method = "GET", body = null) => {
  // definimos los paremetros que necesitamos.
  try {
    // Configuramos nuestra peticion
    const options = {
      method: method,
      body: body ? body : null
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
      text: error.message
    });
    return null;
  }
};

const elements = {
  cardReservas: document.getElementById("reservasAno"),
  cardReservaHoy: document.getElementById("reservasHoy"),
  cardTotalAno: document.getElementById("totalMes"),
  cardTotalMes: document.getElementById("totalAno"),
  cardConvenios: document.getElementById("convenios")
};

const renderCard = async () => {
  const request = {
    ResevasAno: await fetchData(base_url + "/home/getReservasMes"),
    ReservasHoy: await fetchData(base_url + "/home/getReservasHoy"),
    TotalAno: await fetchData(base_url + "/home/getGananciaTotal"),
    TotalMes: await fetchData(base_url + "/home/getGananciaMensual"),
    Convenios: await fetchData(base_url + "/home/getCantidaConvenios")
  };

  console.log(request.ReservasHoy.cantidadHoy)
  elements.cardReservas.innerHTML = request.ResevasAno.cantidad;
  elements.cardReservaHoy.innerHTML = request.ReservasHoy.cantidadHoy;
  elements.cardTotalAno.innerHTML = "$" + request.TotalAno.totalAno;
  elements.cardTotalMes.innerHTML = "$" + request.TotalMes.totalMes;
  elements.cardConvenios.innerHTML = request.Convenios.cantidad;
};

// ganancias anuales.
const chartLine = async () => {
  const ctxLine = document.getElementById("line");
  const dataGancias = await fetchData(base_url + "/home/getGananciaAnual");
  new Chart(ctxLine, {
    type: "line",
    data: {
      labels: dataGancias.fecha,
      datasets: [
        {
          label: "Ganancias",
          data: dataGancias.monto,
          fill: false,
          borderColor: "rgb(75, 192, 192)",
          tension: 0.1
        }
      ]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
};

// reservas del año.
const chartBar = async () => {
  const ctx = document.getElementById("myChart");
  const dataReservas = await fetchData(base_url + "/home/getReservasAnual");
  new Chart(ctx, {
    type: "bar",
    data: {
      labels: dataReservas.fecha,
      datasets: [
        {
          label: "Reservas",
          data: dataReservas.cantidad,
          borderWidth: 1
        }
      ]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
};

chartBar();
chartLine();
renderCard();
