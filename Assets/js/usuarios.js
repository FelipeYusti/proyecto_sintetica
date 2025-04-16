const btnCrearUsuario = document.querySelector("#btnCrearUsuario");
const frmCrearUsuario = document.querySelector("#frmCrearUsuario");
const frmUsername = document.querySelector("#txtUsername");
const frmPassword = document.querySelector("#txtPassword");
const frmEmail = document.querySelector("#txtCorreo");
const frmRol = document.querySelector("#txtRol");

const frmUserStatus = document.querySelector("#txtStatus");
let tablaUsuarios = document.querySelector("#tablaUsuarios");
let btnEnviar = document.querySelector("#btnEnviar");
let frmIdUsuario = 0;
loadTable();

document.addEventListener("click", (e) => {
  try {
    let action = e.target.closest("button").getAttribute("data-action");
    let id = e.target.closest("button").getAttribute("data-id");

    if (action == "delete") {
      Swal.fire({
        title: "Eliminar usuario",
        text: "¿Está seguro de eliminar el usuario?",
        icon: "warning",
        showDenyButton: true,
        confirmButtonText: "Sí",
        denyButtonText: `Cancelar`
      }).then((result) => {
        if (result.isConfirmed) {
          let frmData = new FormData();
          frmData.append("idUser", id);
          fetch(base_url + "/usuarios/deleteUsuario", {
            method: "POST",
            body: frmData
          })
            .then((res) => res.json())
            .then((data) => {
              Swal.fire({
                title: data.status ? "Correcto" : "Error",
                text: data.msg,
                icon: data.status ? "success" : "error",
                showConfirmButton: false,
                timer: 1700
              });
              tablaUsuarios.ajax.reload(function () {});
            });
        }
      });
    }

    if (action == "edit") {
      fetch(base_url + "/usuarios/getUsariosById/" + id)
        .then((res) => res.json())
        .then((data) => {
          if (data.status) {
            data = data.data;
            frmUsername.value = data.username;
            frmPassword.value = data.password;
            frmRol.value = data.rol;
            frmEmail.value = data.correo;
            frmUserStatus.value = data.status;
            frmIdUsuario = data.ID;
            btnEnviar.setAttribute("data-action", "Modificar");
            $("#crearUsuarioModal").modal("show");
            optionStatus(true);
          } else {
            Swal.fire({
              title: "Error",
              text: data.msg,
              icon: "error",
              showConfirmButton: false,
              timer: 1700
            });
            tablaUsuarios.ajax.reload(function () {});
          }
        });
    }
  } catch {}
});

btnCrearUsuario.addEventListener("click", () => {
  clearForm();
  optionStatus(false);
  btnEnviar.setAttribute("data-action", "Crear");
  $("#crearUsuarioModal").modal("show");
});

frmCrearUsuario.addEventListener("submit", (e) => {
  e.preventDefault();

  let action = document.querySelector("#btnEnviar").getAttribute("data-action");
  let frmUsuarios = new FormData(frmCrearUsuario);
  switch (action) {
    case "Crear":
      fetch(base_url + "/usuarios/create", {
        method: "POST",
        body: frmUsuarios
      })
        .then((res) => res.json())
        .then((data) => {
          if (data.status) {
            Swal.fire({
              title: "Registro Usuarios",
              text: data.msg,
              icon: "success",
              showConfirmButton: false,
              timer: 1900
            });
            tablaUsuarios.ajax.reload(function () {});
            $("#crearUsuarioModal").modal("hide");
            clearForm();
          } else {
            Swal.fire({
              title: "Error",
              text: data.msg,
              icon: "error",
              showConfirmButton: false,
              timer: 1900
            });
          }
        });
      break;
    case "Modificar":
      frmUsuarios.append("txtIdUsuario", frmIdUsuario);
      fetch(base_url + "/usuarios/modify", {
        method: "POST",
        body: frmUsuarios
      })
        .then((res) => res.json())
        .then((data) => {
          if (data.status) {
            Swal.fire({
              title: "Actualizacion Usuarios",
              text: data.msg,
              icon: "success",
              showConfirmButton: false,
              timer: 1700
            });
            tablaUsuarios.ajax.reload(function () {});
            $("#crearUsuarioModal").modal("hide");
            clearForm();
          } else {
            Swal.fire({
              title: "Error",
              text: data.msg,
              icon: "error",
              showConfirmButton: false,
              timer: 1900
            });
          }
        });
      break;
    default:
      Swal.fire({
        title: "Error",
        text: data.msg,
        icon: "error",
        showConfirmButton: false,
        timer: 1700
      });
      break;
  }
});

function loadTable() {
  // lo que hacemos es preguntar si ya esta inicializado el datable y si ya esta inicializado - destruimos esa instancia
  if ($.fn.DataTable.isDataTable("#tablaUsuarios")) {
    $("#tablaUsuarios").DataTable().destroy(); // Destruye la instancia previa
  }
  tablaUsuarios = $("#tablaUsuarios").DataTable({
    language: {
      url: `${base_url}/Assets/vendor/datatables/dataTables_es.json`
    },
    ajax: {
      url: " " + base_url + "/usuarios/show",
      dataSrc: ""
    },
    columns: [
      { data: "username" },
      { data: "correo" },
      { data: "rol" },
      { data: "status" },
      { data: "accion" }
    ],
    responsive: "true",
    iDisplayLength: 10,
    order: [[0, "asc"]]
  });
}

function clearForm() {
  frmUsername.value = "";
  frmPassword.value = "";
  frmRol.value = "";
  frmEmail.value = "";
}

function optionStatus(mode) {
  let userStatus = document.getElementById("userStatusZone");

  if (mode) {
    userStatus.style.display = "block";
  } else {
    userStatus.style.display = "none";
  }
}
