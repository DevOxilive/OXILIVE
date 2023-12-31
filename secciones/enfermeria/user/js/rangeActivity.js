// Obtener el elemento <span> por su ID
var spanFilter = document.getElementById("range-activity");
// Crea una instancia de MutationObserver y pasa una función de retorno de llamada
var observer = new MutationObserver(function (mutationsList) {
  // Esta función se ejecutará cuando haya cambios en el DOM
  obtenerDatos();
});
// Configurar las opciones para observar cambios en el contenido
var opciones = { subtree: true, characterData: true, childList: true };
// Comenzar a observar el <span> con las opciones especificadas
observer.observe(spanFilter, opciones);

//Funcion para el uso del filtro
function range(rango) {
  //Se setea con el texto de la opción seleccionada
  var textoRango = rango.textContent;
  //Se trae la etiqueta de span dentro de donde lo meteremos
  var etiquetaRango = document.getElementById("range-activity");
  //Se valida a cuál opción corresponde y se asigna el valor
  if (textoRango == "Esta semana") {
    etiquetaRango.textContent = "Semana";
  } else if (textoRango == "Esta quincena") {
    etiquetaRango.textContent = "Quincena";
  } else {
    etiquetaRango.textContent = textoRango;
  }
}
//Función para obtener los datos de actividad reciente
function obtenerDatos() {
  //Se ocupa la API fetch para ejecutar y almacenar las consultas en un arreglo JSON
  fetch("model/actividadReciente.php")
    .then((response) => response.json()) //La respuesta es el arreglo con los datos
    .then((data) => {
      // Actualizar el apartado según la opción seleccionada
      let filtro = document.getElementById("range-activity").textContent;
      if (filtro === "Hoy" && data.hoy.length > 0) {
        setRangeActivity(data.hoy);
      } else if (filtro === "Semana" && data.hoy.length > 0) {
        setRangeActivity(data.semana);
      } else if (filtro === "Quincena" && data.hoy.length > 0) {
        setRangeActivity(data.quincena);
      } else {
        var notData = "<div></div>";
      }
    })
    //Cachamos errores
    .catch((error) => {
      console.error("Error al :", error);
    });
}
//Ejecutamos por primera vez para setear en "Hoy"
obtenerDatos();
setInterval(obtenerDatos, 1000);
//Funcion para actualizar el apartado de actividad reciente
function setRangeActivity(datos) {
  //Indicamos el div donde contendra este apartado
  let activity = document.getElementById("activity");
  //Se vacía
  activity.innerHTML = " ";
  //Se llena con un foreach con cada dato
  datos.forEach(function (dato) {
    //La variable tiempo es seteada con la funcion que retorna el tiempo transcurrido desde el check
    var tiempo = getTime(dato.fechaAsis, dato.checkTime);
    //La variable dot es llenada con las etiquetas que corresponden a la linea del tiempo
    var dot = '<div class="activity-item d-flex">';
    dot += '<div class="activite-label">';
    //Tiempo transcurrido desde el check
    dot += tiempo;
    dot += "</div>";
    //Condicional para saber si se pondra verde (check in) o rojo (check out)
    if (dato.id_check == 1) {
      dot +=
        '<i class="bi bi-circle-fill activity-badge text-success align-self-start"></i>';
    } else if (dato.id_check == 5) {
      dot +=
        '<i class="bi bi-circle-fill activity-badge text-danger align-self-start"></i>';
    }
    dot += '<div class="activity-content">';
    //Datos del check
    dot +=
      "Registró un <i>" +
      dato.checkName +
      '</i> con el paciente <a class="fw-bold text-dark" href="../../pacientes/paciente.php?idPac=' +
      dato.id_pacientes +
      '">' +
      dato.nomPaciente +
      "</a>";
    dot += "</div>";
    dot += "</div>";
    //Se introduce todo en el div activity
    activity.innerHTML += dot;
  });
}

function getTime(fecha, hora) {
  var fechaActual = new Date();
  var fechaDato = new Date(fecha + "T" + hora);
  var dif = fechaActual - fechaDato;

  var minutos = Math.floor(dif / (1000 * 60));
  var horas = Math.floor(dif / (1000 * 60 * 60));
  var dias = Math.floor(dif / (1000 * 60 * 60 * 24));

  var tiempo;
  if (minutos == 0) {
    tiempo = "<1 min";
  } else if (minutos > 0 && minutos < 60) {
    tiempo = minutos + (minutos === 1 ? " min" : " mins");
  } else if (horas > 0 && horas < 24) {
    tiempo = horas + (horas === 1 ? " hr" : " hrs");
  } else if (dias > 0) {
    tiempo = dias + (dias === 1 ? " día" : " días");
  }
  return tiempo;
}
