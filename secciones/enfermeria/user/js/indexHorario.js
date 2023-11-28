var idus = document.getElementById("idus"),
  main = document.getElementById("main");
function getDia(d){
  var day;
  switch(d){
    case 0:
      day = "Domingo";
      break;
    case 1:
      day = "Lunes";
      break;
    case 2:
      day = "Martes";
      break;
    case 3:
      day = "Miércoles";
      break;
    case 4:
      day = "Jueves";
      break;
    case 5:
      day = "Viernes";
      break;
    case 6:
      day = "Sábado";
      break;
  }
  return day;
}
function getMes(m){
  var mon;
  switch(m){
    case 0:
      mon = "Enero";
      break;
    case 1:
      mon = "Febrero";
      break;
    case 2:
      mon = "Marzo";
      break;
    case 3:
      mon = "Abril";
      break;
    case 4:
      mon = "Mayo";
      break;
    case 5:
      mon = "Junio";
      break;
    case 6:
      mon = "Julio";
      break;
    case 7:
      mon = "Agosto";
      break;
    case 8:
      mon = "Septiembre";
      break;
    case 9:
      mon = "Octubre";
      break;
    case 10:
      mon = "Noviembre";
      break;
    case 11:
      mon = "Diciembre";
      break;
  }
  return mon;
}
function getBtns(s, id){
  var btns;
  switch(s){
    case 1:
      btns = "<div class='col-12'><a class='btn btn-success' href='crear.php?status=2&idHor=" + id + "' role='button'>Comenzar Servicio</a></div>";
      break;
    case 2:
      btns = "<div class='col-12'><a class='btn btn-info' href='#' role='button'>Ver Checks</a> | <a class='btn btn-danger' href='crear.php?status=3&idHor=" + id + "' role='button'>Terminar Servicio</a></div>";
      break;
    case 3:
      btns = "<div class='col-12'><a class='btn btn-info' href='#' role='button'>Ver Checks</a></div>";
      break;
  }
  return btns;
}
  function getDatos() {
  fetch("../model/horarios.php", {
    method: "POST",
    body: JSON.stringify({ id: idus.value }),
    headers: { "Content-Type": "application/json" },
  })
    .then((response) => response.json())
    .then((datos) => {
      datos.forEach((dato) => {
        //Creación de las partes de la Card
        var card = document.createElement("div"),
          cardHead = document.createElement("div"),
          cardBody = document.createElement("div"),
          //La lista de elementos dentro de la Card
          list = document.createElement("dl"),
          //La sección de botones
          btns = document.createElement("div"),
          //La fecha con sus elementos en español
          date =  new Date(dato.fecha+"T"+dato.horarioEntrada),
          day = getDia(date.getDay()),
          month = getMes(date.getMonth());
        //Clase de la List
        list.classList.add("row");
        //Clase de la Card
        card.classList.add("card");
        //Clase de los botones
        btns.classList.add("row");
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
          day + " " + date.getDate() + " de " + month + " / " + date.getHours() + ":" + date.getMinutes() +
          "</b>" +
          "</div>" +
          "<div class='col-2'>" +
          "<i class='bi bi-chevron-down ms-auto'></i>" +
          "</div>" +
          "</div>";
        list.innerHTML +=
          "<dt class='col-5'>" +
          "Paciente:" +
          "</dt>" +
          "<dd class='col-7'>" +
          dato.nomPaciente +
          "</dd>" +
          "<dt class='col-5'>" +
          "Fecha:" +
          "</dt>" +
          "<dd class='col-7'>" +
          dato.fecha +
          "</dd>" +
          "<dt class='col-5'>" +
          "H. Entrada:" +
          "</dt>" +
          "<dd class='col-7'>" +
          dato.horarioEntrada +
          "</dd>" +
          "<dt class='col-5'>" +
          "H. Salida:" +
          "</dt>" +
          "<dd class='col-7'>" +
          dato.horarioSalida +
          "</dd>" +
          "<dt class='col-5'>" +
          "Servicio:" +
          "</dt>" +
          "<dd class='col-7'>" +
          dato.nomGuardia +
          "</dd>" +
          "<dt class='col-5'>" +
          "Estado:" +
          "</dt>" +
          "<dd class='col-7'>" +
          "<span id='badge" +
          dato.id_asignacionHorarios +
          "'>" +
          dato.estado +
          "</span>" +
          "</dd>";
        //Se traen los datos correspondientes a los botones
        btns.innerHTML = getBtns(dato.statusHorario, dato.id_asignacionHorarios);  
        //Se insertan dentro del Card Body sus elementos
        cardBody.appendChild(list);
        //Se checa que no sea Cancelado para poder agregar la sección de botones
        if(dato.statusHorario != 4){
         cardBody.appendChild(btns); 
        }
        //Se insertan dentro del Card sus partes
        card.appendChild(cardHead);
        card.appendChild(cardBody);
        
        //Se añade en el main antes de la etiqueta oculta con el id del usuario
        main.insertBefore(card, idus);
      });
    });
}
getDatos();
