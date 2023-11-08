var table = document.getElementById("tableCont"),
idus = document.getElementById("idUs").value;

function getDatos(){
    fetch("../model/horarios.php", {
        method: "POST",
        body: JSON.stringify({id: idus}),
        headers: {"Content-Type":"application/json"}
    })
    .then(response => response.json())
    .then(datos => {
        datos.forEach(dato => {
            var fila = document.createElement("tr"),
            
            pac = document.createElement("td"),
            hor = document.createElement("td"),
            fecha = document.createElement("td"),
            status = document.createElement("td"),
            acciones = document.createElement("td");
            
            pac.textContent = dato.nomPaciente;
            hor.innerHTML = "<center>" + dato.horarioEntrada + " /<br>" + dato.horarioSalida + "</center>";
            fecha.innerHTML = "<center>" + dato.fecha + "</center>";
            status.innerHTML = "<center class='placeholder-glow'><span id='status" + dato.id_asignacionHorarios + "' class='placeholder placeholder-lg col-md-8 bg-secondary'></span></center>";
            acciones.innerHTML = "<center id='acciones" + dato.id_asignacionHorarios + "' class='placeholder-glow'><a class='btn btn-secondary disabled placeholder col-2' aria-disabled='true'></a>  |  <a class='btn btn-secondary disabled placeholder col-2' aria-disabled='true'></a></center>";

            fila.appendChild(pac);
            fila.appendChild(hor);
            fila.appendChild(fecha);
            fila.appendChild(status);
            fila.appendChild(acciones);

            table.appendChild(fila);
        })
    })
}
getDatos();