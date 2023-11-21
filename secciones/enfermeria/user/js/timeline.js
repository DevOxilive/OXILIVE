function getTimeline() {
  var fecha = document.getElementsByClassName("timeline-breaker"),
  body = document.getElementById("timeline-body");
  console.log(fecha);
  for (let i = 0; i < fecha.length; i++) {
    fetch("../model/timeline.php", {
        headers: {"Content-Type":"application/json"},
        body: JSON.stringify({fecha: fecha[i].textContent}),
        method: "POST"
    })
    .then(response => response.json())
    .then(datos => {
        datos.forEach(dato => {
            var fila, paciente, enfermero, datos = document.createElement("div");

            fila.classList.add("timeline-item", "mt-3", "row", "text-center", "p-2");
            paciente.classList.add("col-5", "font-weight-bold", "text-md-right");
            enfermero.classList.add("col-5", "font-weight-bold", "text-md-left");
            datos.classList.add("col-12", "text-xs", "text-muted");

            

        })
    })
  } 
}
getTimeline();
