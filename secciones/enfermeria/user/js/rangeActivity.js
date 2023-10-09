// Obtener el elemento <span> por su ID
var spanFilter = document.getElementById("range-activity");
// Crear una instancia de MutationObserver y pasar una función de retorno de llamada
var observer = new MutationObserver(function(mutationsList) {
    // Esta función se ejecutará cuando haya cambios en el DOM
    console.log(mutationsList);
    obtenerDatos();
});
// Configurar las opciones para observar cambios en el contenido
var opciones = { subtree: true, characterData: true, childList: true };
// Comenzar a observar el <span> con las opciones especificadas
observer.observe(spanFilter, opciones);

//Funcion para el uso del filtro
function range(rango){
    //Se setea con el texto de la opción seleccionada
    var textoRango = rango.textContent;
    //Se trae la etiqueta de span dentro de donde lo meteremos
    var etiquetaRango = document.getElementById("range-activity");
    //Se valida a cuál opción corresponde y se asigna el valor
    if(textoRango == "Esta semana") {
        etiquetaRango.textContent = "Semana";
    } else if(textoRango == "Esta quincena") {
        etiquetaRango.textContent = "Quincena";
    } else{
        etiquetaRango.textContent = textoRango;
    }
}
//Función para obtener los datos de actividad reciente
function obtenerDatos() {
    //Se ocupa la API fetch para ejecutar y almacenar las consultas en un arreglo JSON
    fetch("model/actividadReciente.php")
    .then(response => response.json())//La respuesta es el arreglo con los datos
    .then(data => {
        // Actualizar el apartado según la opción seleccionada
        let filtro = document.getElementById("range-activity").textContent;
        if (filtro === "Hoy") {
            setRangeActivity(data.hoy);
        } else if (filtro === "Semana") {
            console.log(data.semana);
            setRangeActivity(data.semana);
        } else if (filtro === "Quincena") {
            console.log(data.quicena);
            setRangeActivity(data.quincena);
        }
    })
    //Cachamos errores
    .catch(error => {
        console.error("Error al :", error);
    });
}
//Ejecutamos por primera vez para setear en "Hoy"
obtenerDatos();
//Funcion para actualizar el apartado de actividad reciente
function setRangeActivity(datos){
    //Indicamos el div donde contendra este apartado
    let activity = document.getElementById("activity");
    //Se vacía
    activity.innerHTML=" ";
    //Se llena con un foreach con cada dato
    datos.forEach(function(dato){
        getTime(dato.fechaAsis, dato.checkTime);
        //La variable dot es llenada con las etiquetas que corresponden a la linea del tiempo
        var dot ='<div class="activity-item d-flex">';
        dot += '<div class="activite-label">';
        //Tiempo transcurrido desde el check
        dot += 'asdfghjkl'
        dot += '</div>';
        //Condicional para saber si se pondra verde (check in) o rojo (check out)
        if (dato.id_check == 1) { 
            dot += '<i class="bi bi-circle-fill activity-badge text-success align-self-start"></i>';
        } else if (dato.id_check == 5) {
            dot += '<i class="bi bi-circle-fill activity-badge text-danger align-self-start"></i>';
        }
        dot += '<div class="activity-content">';
        //Datos del check
        dot += 'Registró un <b>'+dato.checkName+'</b> con el paciente '+dato.nomPaciente;
        dot += '</div>';
        dot += '</div>';
        //Se introduce todo en el div activity
        activity.innerHTML += dot;

        console.log(dato);
    });
}

function getTime(fecha, hora){
    var fechaActual = new Date();
    var fechaDato = new Date(fecha);
    var dif = fechaActual-fechaDato;

    var minutos = Math.floor(dif / (1000*60));
    var horas = Math.floor(dif / (1000*60*60));
    var dias = Math.floor(dif / (1000*60*60*24));
    
    console.log("Minutos: "+minutos);
    console.log("Horas: "+horas);
    console.log("Dias: "+dias);
    console.log(fechaActual);
    console.log(fechaDato);
}
/*var divTiempo = document.getElementById('tiempoTranscurrido');
    if (dias > 0) {
        divTiempo.textContent = dias + (dias === 1 ? ' día' : ' días');
    } else if (horas > 0) {
        divTiempo.textContent = horas + (horas === 1 ? ' hora' : ' horas');
    } else {
        divTiempo.textContent = minutos + (minutos === 1 ? ' minuto' : ' minutos');
    }*/
