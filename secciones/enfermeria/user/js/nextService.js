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
    var status = data[0].Estado;
    let card = document.getElementById('service-card');
    if (status == 1) {
      card.setAttribute('class', 'card info-card next-service-card');
      button.innerHTML = "";
      button.innerHTML ='<a class="btn btn-outline-success" href="crear.php?status=3&idHor=' +
        idHor +
        '" role="button"><i class="bi bi-clipboard-check-fill"></i>     Comenzar servicio</a>';
    } else if (status == 5) {
      card.setAttribute('class', 'card info-card finish-service-card');
      button.innerHTML = "";
      button.innerHTML =
        '<a class="btn btn-outline-danger text-danger" href="crear.php?status=2&idHor=' +
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
