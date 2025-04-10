window.addEventListener("DOMContentLoaded", () => {
  getCanchas();
});

function getCanchas() {
  fetch(base_url + "/showCanchas/getCanchas")
    .then((res) => res.json())
    .then((data) => {
      let contenido = document.querySelector("#contenidoCanchas");

      contenido.innerHTML = "";
      data.forEach((cancha) => {
        if (cancha.tipo == "Futbol") {
          contenido.innerHTML += `
            <div class="col-3">
                <div class="card shadow-sm p-4 mb-4 bg-white rounded">
                    <img src='http://localhost/proyecto_sintetica/Assets/images/canchas/canchaFutbol.png' alt="Cancha de Fútbol" class="img-fluid rounded"><br>
                    <label for="canchas" class="form-label">Nombre: ${cancha.nombre}</label>
                    <label for="canchas" class="form-label">Capacidad: ${cancha.capacidad}</label>
                    <label for="canchas" class="form-label">Tipo: ${cancha.tipo}</label>
                </div>
            </div>`;
        } else if (cancha.tipo == "Volley") {
          contenido.innerHTML += `
            <div class="col-3">
                <div class="card shadow-sm p-4 mb-4 bg-white rounded ">
                    <img src='http://localhost/proyecto_sintetica/Assets/images/volley/canchaVolley.png' alt="Cancha de Fútbol" class="img-fluid rounded"><br>
                    <label for="canchas" class="form-label">Nombre: ${cancha.nombre}</label>
                    <label for="canchas" class="form-label">Capacidad: ${cancha.capacidad}</label>
                    <label for="canchas" class="form-label">Tipo: ${cancha.tipo}</label>
                </div>
            </div>`;
        } else if (cancha.tipo == "Tenis") {
          contenido.innerHTML += `
            <div class="col-3">
                <div class="card shadow-sm p-4 mb-4 bg-white rounded">
                    <img src='http://localhost/proyecto_sintetica/Assets/images/tenis/canchaTenis.png' alt="Cancha de Fútbol" class="img-fluid rounded"><br>
                    <label for="canchas" class="form-label">Nombre: ${cancha.nombre}</label>
                    <label for="canchas" class="form-label">Capacidad: ${cancha.capacidad}</label>
                    <label for="canchas" class="form-label">Tipo: ${cancha.tipo}</label>
                </div>
            </div>`;
        }
      });
    })
    .catch((error) => console.error("Error al listar canchas:", error));
}
