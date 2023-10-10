let idHor = document.getElementById("idHor").value;
var botonServ = document.getElementById("service-button");

nextService(botonServ);

function nextService(button) {
  fetch("model/consultaUsuario.php", {
    method: "POST",
    header: "Content-Type: application/json",
  })
  .then(response => response.json())
  .then(data => {
    console.log(data);
    var status = data[0].Estado;
    if (status == 1) {
      button.innerHTML = "";
      button.innerHTML ='<a class="btn btn-outline-success" href="crear.php?status=0&idHor=' +
        idHor +
        '" role="button"><i class="bi bi-clipboard-check-fill"></i>     Comenzar servicio</a>';
    } else if (status == 5) {
      button.innerHTML = "";
      button.innerHTML =
        '<a class="btn btn-outline-danger text-danger" href="crear.php?status=1&idHor=' +
        idHor +
        '" role="button"><i class="bi bi-clipboard-check-fill"></i>    Terminar Servicio</a>';
    }
  })
  .catch(error => {
    console.error("Error: "+error);
  })
}
setInterval(function () {
  nextService(botonServ);
}, 1000);
