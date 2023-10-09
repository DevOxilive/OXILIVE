function range(rango){
    var textoRango = rango.textContent;
    var etiquetaRango = document.getElementById("range-activity");
    if(textoRango == "Esta semana") {
        etiquetaRango.textContent = "Semana";
    } else if(textoRango == "Esta quincena") {
        etiquetaRango.textContent = "Quincena";
    } else{
        etiquetaRango.textContent = textoRango;
    }
}
function obtenerDatos() {
    fetch("../model/actividadReciente.php")
    .then(response => response.json())
    .then(data => {
        // Actualizar la tabla según la opción seleccionada
        var filtro = document.getElementById("recent-activity").textContent;
        if (filtro === "Hoy") {
            setRangeActivity(data.hoy);
        } else if (filtro === "Semana") {
            setRangeActivity(data.semana);
        } else if (filtro === "Quincena") {
            setRangeActivity(data.quincena);
        }
    })
    .catch(error => {
        console.error("Error al obtener los datos:", error);
    });
}
function setRangeActivity(datos){
    var activity = document.getElementById("activity");
    activity.innerHTML = "";


}
var fechaActual = new Date();
var formatoFecha = `${fechaActual.getFullYear()}-${fechaActual.getMonth() + 1}-${fechaActual.getDate()}`;
var formatoHora = `${fechaActual.getHours()}:${fechaActual.getMinutes()}:${fechaActual.getSeconds()}`;
