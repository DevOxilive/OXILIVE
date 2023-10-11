function getPaciente(){
    //Apuntador al valor del input hidden que contiene el id del Paciente
    let paciente = document.getElementById("idPaciente").value;
    //Se setea el dato en JSON
    var data={ idPac: paciente };
    //Se manda por fetch API
    fetch("../model/paciente.php", {
        body: JSON.stringify(data),
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
    })
    .then(response => response.json())
    .then(datos => {
        datos.forEach(dato => {
            console.log(dato);
            setGeneral(dato);
        });
    })
}
//Función para setear los datos de la seccion General
function setGeneral(dato){
    //Apuntadores al DOM para setear los divs
    let nombre = document.getElementById("nombre"),
    apellidos = document.getElementById("apellidos"),
    rfc = document.getElementById("rfc");
    //Datos que se les introducirá al div
    nombre.textContent = dato.Nombres;
    apellidos.textContent = dato.Apellidos;
    rfc.textContent = dato.rfc;
}
//Se ejecuta una vez cada que se refresca la página
getPaciente();