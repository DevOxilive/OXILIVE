var idus = document.getElementById("idus"),
  main = document.getElementById("main");
function getDatos() {
  fetch("../model/horarios.php", {
    method: "POST",
    body: JSON.stringify({ id: idus.value }),
    headers: { "Content-Type": "application/json" },
  })
    .then((response) => response.json())
    .then((datos) => {
      datos.forEach((dato) => {
        console.log(dato);
        //Creación de las partes de la Card
        var card = document.createElement("div"),
          cardHead = document.createElement("div"),
          cardBody = document.createElement("div");
        //Clase de la Card
        card.classList.add("card");
        //Clases y atributos del card header
        cardHead.classList.add("card-header");
        cardHead.setAttribute("data-bs-toggle", "collapse");
        cardHead.setAttribute(
          "data-bs-target",
          "#card" + dato.id_asignacionHorarios
        );
        cardHead.id = "cardHead" + dato.id_asignacionHorarios;
        //Clases y atributos del card body
        cardBody.classList.add("card-body", "collapse");
        cardBody.id = "card" + dato.id_asignacionHorarios;
        //Datos dentro de los card header y card body
        cardHead.innerHTML =
          "<div class='row justify-content-between d-flex'><div class='col-10'><b class='title-hour'>" +
          dato.nomPaciente +
          "</b></div><div class='col-2'><i class='bi bi-chevron-down ms-auto'></i></div></div>";
        cardBody.innerHTML +=
          "<div class='row justify-content-between d-flex'><dt class='col-lg-3 col-md-4 label'>Fecha:</dt><dd class='col-lg-9 col-md-8>" +
          dato.fecha +
          "</dd><dt class='col-lg-3 col-md-4 label'>Hora entrada:</dt><dd class='col-lg-9 col-md-8>" +
          dato.horarioEntrada +
          "</dd></div>";
        cardBody.innerHTML += "";
        cardBody.innerHTML += "";
        cardBody.innerHTML += "";
        cardBody.innerHTML += "";
        cardBody.innerHTML +=
          "<dt class='col-lg-3 col-md-4 label'>Hora salida:</dt>";
        cardBody.innerHTML +=
          "<dd class='col-lg-9 col-md-8>" + dato.horarioSalida + "</dd>";
        cardBody.innerHTML +=
          "<dt class='col-lg-3 col-md-4 label'>Servicio:</dt>";
        cardBody.innerHTML +=
          "<dd class='col-lg-9 col-md-8>" + dato.nomGuardia + "</dd>";
        cardBody.innerHTML += "</dl>";

        //Se insertan dentro del Card sus partes
        card.appendChild(cardHead);
        card.appendChild(cardBody);
        //Se añade en el main antes de la etiqueta oculta con el id del usuario
        main.insertBefore(card, idus);
      });
    });
}
getDatos();
