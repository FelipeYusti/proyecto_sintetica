window.addEventListener("DOMContentLoaded", () => {
  getCanchas();
});

// Cronómetros activos por cancha
const cronometros = {};

function getCanchas() {
  fetch(base_url + "/showCanchas/getCanchas")
    .then((res) => res.json())
    .then((data) => {
      let contenido = document.querySelector("#contenidoCanchas");
      contenido.innerHTML = "";

      data.forEach((cancha) => {
        let imagen = "";
        if (cancha.tipo == "Futbol") {
          imagen = "canchas/canchaFutbol.png";
        } else if (cancha.tipo == "Volley") {
          imagen = "volley/canchaVolley.png";
        } else if (cancha.tipo == "Tenis") {
          imagen = "tenis/canchaTenis.png";
        }

        contenido.innerHTML += `
          <div class="col-12 col-md-6 col-lg-4 col-xl-3">
            <div class="card shadow-lg border-0 p-3 mb-4 bg-light rounded-4 h-100">
              <img src="http://localhost/proyecto_sintetica/Assets/images/${imagen}"
                  alt="Cancha de ${cancha.tipo}"
                  class="img-fluid rounded-3 mb-3 border border-2 border-primary">
              <div class="card-body p-0">
                <h5 class="card-title fw-bold text-primary mb-2">
                  <i class="bi bi-building"></i> Nombre: <span class="text-dark">${cancha.nombre}</span>
                </h5>
                <p class="card-text mb-1">
                  <i class="bi bi-people-fill text-success"></i> Capacidad: <strong>${cancha.capacidad}</strong>
                </p>
                <p class="card-text">
                  <i class="bi bi-tag-fill text-warning"></i> Tipo: <strong>${cancha.tipo}</strong>
                </p>
                <div id="timer-${cancha.idcanchas}" class="fs-4 fw-bold text-danger my-2">00:00</div>

                <button type="button" class="btn btn-primary" onclick="iniciarCronometro(${cancha.idcanchas},3)">
                  Iniciar
                </button>
              </div>
            </div>
          </div>
        `;
      });
    })
    .catch((error) => console.error("Error al listar canchas:", error));
}

// 🎯 Función del cronómetro
function iniciarCronometro(id, horas) {
  const display = document.getElementById(`timer-${id}`);

  // Evitar múltiples timers por cancha
  if (cronometros[id]) return;

  let tiempoRestante = (60 * 60) * horas; // 60 minutos en segundos

  cronometros[id] = setInterval(() => {
    const minutos = Math.floor(tiempoRestante / 60);
    const segundos = tiempoRestante % 60;

    display.textContent = `${minutos.toString().padStart(2, "0")}:${segundos
      .toString()
      .padStart(2, "0")}`;

    if (tiempoRestante <= 0) {
      clearInterval(cronometros[id]);
      delete cronometros[id];
      display.textContent = "¡Tiempo terminado!";
    } else {
      tiempoRestante--;
    }
  }, 1000);
}
