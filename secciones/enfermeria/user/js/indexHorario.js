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
          cardBody = document.createElement("div"),
          list = document.createElement("dl");
        //Clase de la List
        list.classList.add("row");
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
          "<div class='row justify-content-between d-flex'>" +
          "<div class='col-10'>" +
          "<b class='title-hour'>" +
          dato.nomPaciente +
          "</b>" +
          "</div>" +
          "<div class='col-2'>" +
          "<i class='bi bi-chevron-down ms-auto'></i>" +
          "</div>" +
          "</div>";
        list.innerHTML +=
          "<dt class='col-4'>" +
          "Fecha:" +
          "</dt>" +
          "<dd class='col-8'>" +
          dato.fecha +
          "</dd>" +
          "<dt class='col-4'>" +
          "Hora entrada:" +
          "</dt>" +
          "<dd class='col-8'>" +
          dato.horarioEntrada +
          "</dd>" +
          "<dt class='col-4'>" +
          "Hora salida:" +
          "</dt>" +
          "<dd class='col-8'>" +
          dato.horarioSalida +
          "</dd>" +
          "<dt class='col-4'>" +
          "Servicio:" +
          "</dt>" +
          "<dd class='col-8'>" +
          dato.nomGuardia +
          "</dd>" +
          "<dt class='col-4'>" +
          "Estado:" +
          "</dt>" +
          "<dd class='col-8' id='estado" +
          dato.id_asignacionHorarios +
          "'>" +
          "<span class='badge' id='badge" +
          dato.id_asignacionHorarios +
          "'>" +
          dato.estado +
          "</span>" +
          "</dd>";
        //Se insertan dentro del Card sus partes
        cardBody.appendChild(list);
        card.appendChild(cardHead);
        card.appendChild(cardBody);
        //Se añade en el main antes de la etiqueta oculta con el id del usuario
        main.insertBefore(card, idus);
      });
    });
}
function getStatus() {
  var idus = document.getElementById("idus");
  fetch("../model/statusHorario.php", {
    method: "POST",
    body: JSON.stringify({ id: idus.value }),
    headers: { "Content-Type": "application/json" },
  })
    .then((response) => response.json())
    .then((datos) => {
      console.log(datos);
      datos.forEach((dato) => {
        console.log(dato);
      });
    });
}
getDatos();
getStatus();
