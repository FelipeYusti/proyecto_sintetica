window.addEventListener("DOMContentLoaded", () => {
  getCanchas();
  restaurarCronometrosActivos();
});

function notificacionCancha() {
  if (Notification.permission !== "granted") {
    Notification.requestPermission();
  }
}

const cronometros = {};
const STORAGE_KEY = "cronometrosActivos";

function getCanchas() {
  fetch(base_url + "/showCanchas/getCanchas")
    .then((res) => res.json())
    .then((data) => {
      const contenido = document.querySelector("#contenidoCanchas");
      contenido.innerHTML = "";

      data.forEach((cancha) => {
        let imagen = "";
        if (cancha.tipo === "Futbol") imagen = "canchas/canchaFutbol.png";
        else if (cancha.tipo === "Volley") imagen = "volley/canchaVolley.png";
        else if (cancha.tipo === "Tenis") imagen = "tenis/canchaTenis.png";

        contenido.innerHTML += `
          <div class="col-12 col-md-8 col-lg- col-xl-3">
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
                <input 
                  class="form-control form-control-sm mb-2" 
                  type="number"
                  id="horasReservadas-${cancha.idcanchas}" 
                  name="horasReservadas" 
                  min="1" 
                  max="5" 
                  placeholder="Horas reservadas" 
                  oninput="this.value = Math.max(1, Math.min(5, this.value))">
                <div id="timer-${cancha.idcanchas}" class="fs-4 fw-bold text-danger my-2">00:00</div>
                <div class="d-flex gap-2">
                  <button 
                    id="btn-${cancha.idcanchas}" 
                    type="button" 
                    class="btn btn-primary" 
                    onclick="toggleCronometro(${cancha.idcanchas})">
                    Iniciar
                  </button>
                  <button 
                    type="button" 
                    class="btn btn-danger" 
                    onclick="resetCronometro(${cancha.idcanchas})">
                    <i class="bi bi-skip-start-circle"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
        `;
      });

      restaurarCronometrosActivos(); // Vuelve a poner en funcion los cronometros si estan corriendo
    })
    .catch((error) => console.error("Error al listar canchas:", error));
}

function toggleCronometro(id) {
  const display = document.getElementById(`timer-${id}`);
  const boton = document.getElementById(`btn-${id}`);
  const inputHoras = document.getElementById(`horasReservadas-${id}`);
  let horas = parseInt(inputHoras.value);

  if (!cronometros[id]) {
    // si numero de horas llega null o "", sale alerta
    if (isNaN(horas) || horas < 1 || horas > 5) {
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "Ingrese una cantidad entre 1 y 5!",
      });
      return;
    }

    inputHoras.style.display = "none";

    const tiempoTotal = 60 * 60 * horas;
    const fin = Date.now() + tiempoTotal * 1000;

    cronometros[id] = {
      tiempoTotal,
      fin,
      enPausa: false,
    };

    localStorage.setItem(STORAGE_KEY, JSON.stringify(cronometros));
  }

  // Si está corriendo, lo detenemos (guardamos tiempo restante)
  if (cronometros[id].intervalo) {
    clearInterval(cronometros[id].intervalo);
    const ahora = Date.now();
    const tiempoRestante = Math.floor((cronometros[id].fin - ahora) / 1000);

    cronometros[id].tiempoRestante = tiempoRestante;
    cronometros[id].enPausa = true;

    delete cronometros[id].intervalo;
    boton.textContent = "Iniciar";
    return;
  }

  // Si estaba pausado, reanudar desde tiempoRestante
  if (cronometros[id].enPausa) {
    const nuevoFin = Date.now() + cronometros[id].tiempoRestante * 1000;
    cronometros[id].fin = nuevoFin;
    delete cronometros[id].tiempoRestante;
    cronometros[id].enPausa = false;
  }

  boton.textContent = "Detener";
  actualizarDisplay(id);
  cronometros[id].intervalo = setInterval(() => actualizarDisplay(id), 1000);

  // Solo actualiza el localStorage si no está pausado
  localStorage.setItem(STORAGE_KEY, JSON.stringify(cronometros));
}

function actualizarDisplay(id) {
  const now = Date.now();
  const tiempoRestante = Math.floor((cronometros[id].fin - now) / 1000);
  const display = document.getElementById(`timer-${id}`);
  const boton = document.getElementById(`btn-${id}`);

  if (tiempoRestante <= 0) {
    clearInterval(cronometros[id].intervalo);
    display.textContent = "¡Tiempo terminado!";
    boton.textContent = "Iniciar";
    delete cronometros[id];
    localStorage.setItem(STORAGE_KEY, JSON.stringify(cronometros));

    // Notificación
    if (Notification.permission === "granted") {
      new Notification("¡Tiempo terminado!", {
        body: `La cancha ${id} ha completado su tiempo.`,
      });
    }

    //  Sonido
    const audio = new Audio(
      "http://localhost/proyecto_sintetica/Assets/images/sound/alarma.mp3"
    );
    audio.play();

    return;
  }

  const minutos = Math.floor(tiempoRestante / 60); // Metodo floor es para redondear, si ingreso 5.6, redondea a 6
  const segundos = tiempoRestante % 60;
  display.textContent = `${minutos.toString().padStart(2, "0")}:${segundos
    .toString()
    .padStart(2, "0")}`;
}

function resetCronometro(id) {
  clearInterval(cronometros[id]?.intervalo);
  delete cronometros[id];
  localStorage.setItem(STORAGE_KEY, JSON.stringify(cronometros));
  document.getElementById(`timer-${id}`).textContent = "00:00";
  document.getElementById(`btn-${id}`).textContent = "Iniciar";
  document.getElementById(`horasReservadas-${id}`).style.display = "block";
}

function restaurarCronometrosActivos() {
  const guardados = JSON.parse(localStorage.getItem(STORAGE_KEY)) || {};
  Object.entries(guardados).forEach(([id, data]) => {
    id = parseInt(id);
    const display = document.getElementById(`timer-${id}`);
    const boton = document.getElementById(`btn-${id}`);
    const input = document.getElementById(`horasReservadas-${id}`);

    if (!display || !boton) return;

    cronometros[id] = {
      tiempoTotal: data.tiempoTotal,
      fin: data.fin,
    };

    if (input) input.style.display = "none";
    boton.textContent = "Detener";
    actualizarDisplay(id);
    cronometros[id].intervalo = setInterval(() => actualizarDisplay(id), 1000);

    if (data.enPausa) {
      display.textContent = formatTiempo(data.tiempoRestante || 0);
      boton.textContent = "Iniciar";
    } else {
      boton.textContent = "Detener";
      actualizarDisplay(id);
      cronometros[id].intervalo = setInterval(
        () => actualizarDisplay(id),
        1000
      );
    }
  });
}
function formatTiempo(segundos) {
  const min = Math.floor(segundos / 60);
  const seg = segundos % 60;
  return `${min.toString().padStart(2, "0")}:${seg
    .toString()
    .padStart(2, "0")}`;
}
