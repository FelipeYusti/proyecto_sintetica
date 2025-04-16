// Elementos que vamos a utlizar los guardamos en este pequeño modulo
const elements = {
  btnCrearCancha: document.querySelector("#btnCrearCancha"),
  frmCrearCancha: document.querySelector("#frmCrearCancha"),
  frmName: document.querySelector("#txtName"),
  frmType: document.querySelector("#txtType"),
  frmCapacitance: document.querySelector("#txtCapacitance"),
  frmPrice: document.querySelector("#txtPrice"),
  frmCanchaStatus: document.querySelector("#txtStatus"),
  btnEnviar: document.querySelector("#btnEnviar"),
  show: document.querySelector("#show")
};

// Estado global para mantener datos clave y utilizarlos en todo el ducumento.
const globalState = {
  frmIdCancha: 0
};

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

document.addEventListener("click", async (e) => {
  try {
    const target = e.target.closest("a");
    if (!target) return;

    let action = target.getAttribute("data-action");
    let id = target.getAttribute("data-id");
    globalState.frmIdCancha = id;

    switch (action) {
      case "edit":
        await actionInfo(id);
        break;

      case "delete":
        await actionDelete(id);
        break;

      default:
        console.warn("Acción no reconocida:", action);
        break;
    }
  } catch (error) {
    console.error("Error en el evento click:", error);
  }
});

elements.btnCrearCancha.addEventListener("click", () => {
  clearForm();
  optionStatus(false);
  elements.btnEnviar.setAttribute("data-action", "Registrar");
  $("#crearCanchasModal").modal("show");
});

elements.frmCrearCancha.addEventListener("submit", async (e) => {
  e.preventDefault();
  let frmCancha = new FormData(frmCrearCancha);
  let action = document.querySelector("#btnEnviar").getAttribute("data-action");

  let url = "";
  let mensaje = "";

  switch (action) {
    case "Registrar":
      frmCancha.delete("txtStatus");
      url = base_url + "/canchas/create";
      mensaje = "Registro de Cancha exitoso";
      break;
    case "Modificar":
      frmCancha.append("txtIdCancha", globalState.frmIdCancha);
      url = base_url + "/canchas/modify";
      mensaje = "Registro de Cancha exitoso";
      break;

    default:
      Swal.fire({
        title: "Accion no valida",
        text: "La accion que no es reconocida",
        icon: "error"
      });
      return;
  }
  // ejecutamos la petecion sea un create o un update y la enviamos con el metodo POST.
  //console.log("Payload enviado:", Object.fromEntries(frmCancha));
  const data = await fetchData(url, "POST", frmCancha);

  if (data.status) {
    Swal.fire({
      title: action,
      text: mensaje,
      icon: "success",
      showConfirmButton: false,
      timer: 1800
    });

    $("#crearCanchasModal").modal("hide");
    clearForm();
  } else {
    Swal.fire({
      title: "Error",
      text: data.msg,
      icon: "error"
    });
  }
});

function clearForm() {
  elements.frmName.value = "";
  elements.frmType.value = "";
  elements.frmCapacitance.value = "";
  elements.frmPrice.value = "";
}

function optionStatus(mode) {
  let userStatus = document.getElementById("userStatusZone");

  if (mode) {
    userStatus.style.display = "block";
  } else {
    userStatus.style.display = "none";
  }
}

const renderCanchas = async () => {
  const data = await fetchData(base_url + "/canchas/show");
  if (data.length > 0) {
    let fragment = document.createDocumentFragment();
    data.forEach((cancha) => {
      let div = document.createElement("div");
      div.classList.add("col-md-4", "mt-4", "mb-2");
      div.innerHTML = `
                    <div class="card border-primary" style="max-width: 600px; margin: auto;" data-aos="fade-down" data-aos-delay="1100">
                        <div class="flex-wrap card-header d-flex justify-content-between  bg-primary text-white align-items-end position-relative">
                            <div class="position-absolute top-0 end-0 mt-2 me-2">
                                <input type="hidden" id="txtIdCancha" value="${cancha.ID}">
                                <button class="btn btn-outline-secondary rounded-pill" style="border: transparent;" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-gear-wide"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item mb-0" data-id="${cancha.ID}" data-action="edit"><i class="bi bi-pen"></i> Editar </a></li>
                                    <li><a class="dropdown-item" data-id="${cancha.ID}" data-action="delete"><i class="bi bi-trash3"></i> Eliminar </a></li>
                                </ul>
                            </div>
                            <div>
                                <h4 class="card-title text-white mb-1">${cancha.nombre}</h4>
                                <p class="mb-2">${cancha.tipo} de ${cancha.capacidad} jugadores. </p>
                            </div>
                        </div>
                        <div class="card-body text-center">
                            <img src="${cancha.rutaImagen}" class="img-fluid border border-dark" alt="Cancha de Fútbol 5 vs 5">
                        </div>
                    </div>
      `;
      fragment.appendChild(div);
    });
    show.innerHTML += "";
    show.appendChild(fragment);
  } else {
    console.log("");
  }
};

const actionInfo = async (id) => {
  const data = await fetchData(`${base_url}/canchas/getById/${id}`, "GET");
  if (data.status) {
    const cancha = data.data;
    elements.frmName.value = cancha.nombre;
    elements.frmPrice.value = cancha.valor;
    elements.frmCapacitance.value = cancha.capacidad;
    elements.frmType.value = cancha.tipo;
    elements.frmCanchaStatus.value = cancha.status;
    elements.btnEnviar.setAttribute("data-action", "Modificar");

    $("#crearCanchasModal").modal("show");
    optionStatus(true);
  } else {
    Swal.fire({
      title: "Error",
      text: data.msg,
      icon: "error"
    });
  }
};
const actionDelete = async (id) => {
  const result = await Swal.fire({
    title: "Eliminar la cancha",
    text: "¿Está seguro de eliminar la cancha?",
    icon: "warning",
    showDenyButton: true,
    confirmButtonText: "Sí",
    denyButtonText: "Cancelar"
  });

  if (result.isConfirmed) {
    let frmData = new FormData();
    frmData.append("idCancha", id);

    const data = await fetchData(`${base_url}/canchas/delete`, "POST", frmData);

    Swal.fire({
      title: data.status ? "Correcto" : "Error",
      text: data.msg,
      icon: data.status ? "success" : "error",
      showConfirmButton: false,
      timer: 1700
    });
  }
};
renderCanchas();
