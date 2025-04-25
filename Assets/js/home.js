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
const ganancias = fetchData(base_url + "/home/getCantidaReservas");

const ctx = document.getElementById("myChart");
const dataReservas = fetchData(base_url + "/home/getCantidaReservas");
console.log(dataReservas);
new Chart(ctx, {
  type: "bar",
  data: {
    labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
    datasets: [
      {
        label: "# of Votes",
        data: [12, 19, 3, 5, 2, 3],
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

const ctxLine = document.getElementById("line");
/* const fecha = Utils.months({ count: 7 }); */
new Chart(ctxLine, {
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
});
const dona = document.getElementById("dona");
new Chart(dona, {
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
});
const ctxReservas = document.getElementById("reservas");
new Chart(ctxReservas, {
  type: "bar",
  data: {
    labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
    datasets: [
      {
        label: "# of Votes",
        data: [12, 19, 3, 5, 2, 3],
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
