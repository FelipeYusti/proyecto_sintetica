const btnCrearCancha = document.querySelector("#btnCrearCancha");
const frmCrearCancha = document.querySelector("#frmCrearCancha");
const frmName = document.querySelector("#txtName");
const frmType = document.querySelector("#txtType");
const frmCapacitance = document.querySelector("#txtCapacitance");
const frmPrice = document.querySelector("#txtPrice");
const frmUserStatus = document.querySelector("#userStatus");
let show = document.querySelector("#show");
rederCanchas();

document.addEventListener("click", (e) => {
  try {
    let action = e.target.closest("a").getAttribute("data-action");
    let id = e.target.closest("a").getAttribute("data-id");

    switch (action) {
      case "edit":
        fetch(base_url + "/canchas/getById/" + id)
          .then((res) => res.json())
          .then((data) => {
            if (data.status) {
              data = data.data;
              frmName.value = data.nombre;
              frmPrice.value = data.valor;
              frmCapacitance.value = data.capacidad;
              frmType.value = data.tipo;
              frmUserStatus.value = data.status;
              $("#crearCanchasModal").modal("show");
              optionStatus(true);
            } else {
              Swal.fire({
                title: "Error",
                text: data.msg,
                icon: "error"
              });
              /* tablaUsuarios.api().ajax.reload(function () {}); */
            }
          });
        break;
      case "delete":
        Swal.fire({
          title: "Eliminar la cancha",
          text: "¿Está seguro de eliminar la cancha?",
          icon: "warning",
          showDenyButton: true,
          confirmButtonText: "Sí",
          denyButtonText: `Cancelar`
        }).then((result) => {
          if (result.isConfirmed) {
            let frmData = new FormData();
            frmData.append("idCancha", id);
            fetch(base_url + "/canchas/delete", {
              method: "POST",
              body: frmData
            })
              .then((res) => res.json())
              .then((data) => {
                Swal.fire({
                  title: data.status ? "Correcto" : "Error",
                  text: data.msg,
                  icon: data.status ? "success" : "error"
                });
                /*  tablaUsuarios.api().ajax.reload(function () {}); */
              });
          }
        });
        break;

      default:
        Swal.fire({
          title: "Accion no valida",
          text: "La accion que no es reconocida",
          icon: "error"
        });
        break;
    }
  } catch {}
});

btnCrearCancha.addEventListener("click", () => {
  clearForm();
  optionStatus(false);
  $("#crearCanchasModal").modal("show");
});

frmCrearCancha.addEventListener("submit", (e) => {
  e.preventDefault();
  let frmCancha = new FormData(frmCrearCancha);

  switch (action) {
    case "registar":
      fetch(base_url + "/canchas/create", {
        method: "POST",
        body: frmCancha
      })
        .then((res) => res.json())
        .then((data) => {
          if (data.status) {
            Swal.fire({
              title: "Registro Canchas",
              text: data.msg,
              icon: "success",
              showConfirmButton: false,
              timer: 1700
            });
            /*  tablaUsuarios.api().ajax.reload(function () {}); */
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
      break;
    case "modificar":
      fetch(base_url + "/canchas/modify", {
        method: "POST",
        body: frmCancha
      })
        .then((res) => res.json())
        .then((data) => {
          if (data.status) {
            Swal.fire({
              title: "Registro Canchas",
              text: data.msg,
              icon: "success",
              showConfirmButton: false,
              timer: 1700
            });
            /*  tablaUsuarios.api().ajax.reload(function () {}); */
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
      break;

    default:
      Swal.fire({
        title: "Accion no valida",
        text: "La accion que no es reconocida",
        icon: "error"
      });
      break;
  }
});

function rederCanchas() {
  fetch(base_url + "/canchas/show")
    .then((res) => res.json())
    .then((data) => {
      if (data.length > 0) {
        data.forEach((cancha) => {
          let fila = `
          <div class="col-md-6">
                        <div class="card border-primary" style="max-width: 600px; margin: auto;" data-aos="fade-up" data-aos-delay="800">
                            <div class="flex-wrap card-header d-flex justify-content-between  bg-primary text-white align-items-end position-relative">
                                <div class="position-absolute top-0 end-0 mt-2 me-2">
                                    <input type="hidden" id="txtIdCancha" value="${cancha.ID}">
                                    <button class="btn btn-outline-secondary rounded-pill" style="border: transparent;" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-gear-wide"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item mb-0" data-id="${cancha.ID}" data-action="edit"><i class="bi bi-pen"></i> Editar </a></li>
                                        <li><a class="dropdown-item" data-id="${cancha.ID}" data-action=" delete"><i class="bi bi-trash3"></i> Eliminar </a></li>
                                    </ul>
                                </div>
                                <div>
                                    <h4 class="card-title text-white mb-0">${cancha.nombre}</h4>
                                    <p class="mb-2">${cancha.tipo} de ${cancha.capacidad}</p>
                                </div>
                            </div>
                            <div class="card-body text-center">
                                <img src="${cancha.rutaImagen}" class="img-fluid border border-dark" alt="Cancha de Fútbol 5 vs 5">
                            </div>
                        </div>
                    </div>

          `;
          show.innerHTML += fila;
        });
      } else {
        Swal.fire({
          title: "Error",
          text: data.msg,
          icon: "error"
        });
        /* tablaUsuarios.api().ajax.reload(function () {}); */
      }
    });
}

function clearForm() {
  frmName.value = "";
  frmType.value = "";
  frmCapacitance.value = "";
  frmPrice.value = "";
}

function optionStatus(mode) {
  let userStatus = document.getElementById("userStatusZone");

  if (mode) {
    userStatus.style.display = "block";
  } else {
    userStatus.style.display = "none";
  }
}
