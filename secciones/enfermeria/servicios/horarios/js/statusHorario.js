function getStatus(n) {
  fetch("model/status.php", {
    headers: { "Content-Type": "application/json" },
    method: "POST",
    body: JSON.stringify({estado: n}),
  })
    .then((response) => response.json())
    .then((datos) => {
      datos.forEach((dato) => {
        let status = document.getElementById("status" + dato.id);
        let btns = document.getElementById("acciones" + dato.id);
        status.classList = "";
        switch (dato.id_est) {
          case 1:
            status.classList.add("badge", "bg-warning", "text-black", "fs-6");
            break;
          case 3:
            status.classList.add("badge", "bg-success", "fs-6");
            break;
          case 2:
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
        if(dato.id_est === 1){
          btns.innerHTML = "<a class='btn btn-outline-warning' href='pages/editar.php?idHor=" + dato.id + "' role='button'><i class='i bi-pencil-square'></i></a> | <a class='btn btn-outline-danger' role='button' href='#' onclick='cancelHor(event, "+ dato.id +")'><i class='bi bi-x-lg'></i></a>"
        }
        else if(dato.id_est === 2 || dato.id_est === 3) {
          btns.innerHTML = "<a class='btn btn-outline-primary' href='pages/servicio.php?idSer="+ dato.id +"' role='button'><i class='bi bi-eye-fill'></i></a>";
        } else {
          btns.textContent = "N / A";
        }
      });
    });
}
getStatus();
setInterval(getStatus, 2500);
