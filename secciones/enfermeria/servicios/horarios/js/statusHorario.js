function getStatus() {
  fetch("model/status.php", {
    headers: { "Content-Type": "application/json" },
  })
    .then((response) => response.json())
    .then((datos) => {
      datos.forEach((dato) => {
        let status = document.getElementById("status" + dato.id);
        status.classList = "";
        switch (dato.id_est) {
          case 1:
            status.classList.add("badge", "bg-warning", "fs-6");
            break;
          case 2:
            status.classList.add("badge", "bg-success", "fs-6");
            break;
          case 3:
            status.classList.add("badge", "bg-info", "fs-6");
            break;
          case 4:
            status.classList.add("badge", "bg-danger", "fs-6");
            break;
          default:
            status.classList.add("badge", "bg-secondary", "fs-6");
            break;
        }
        status.textContent=dato.estado;
      });
    });
}
getStatus();
setInterval(getStatus, 1500);
