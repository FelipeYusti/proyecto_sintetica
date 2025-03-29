function listConveniosSelect() {
  fetch(base_url + "/reservas/getConvenios")
    .then((res) => res.json())
    .then((data) => {
      let selectElem = document.getElementById("idCanchasDisponibles");
      selectElem.innerHTML = "";
      data.data.forEach((cancha) => {
        selectElem.innerHTML += `<option value="${cancha.idcanchas}">${cancha.nombre}</option>`;
      });
    })
    .catch((error) => console.error("Error al listar canchas:", error));
}
