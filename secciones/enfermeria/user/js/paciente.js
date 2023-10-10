function getPaciente(){
    let paciente = document.getElementById("idPaciente").value,
        nombre = document.getElementById("nombre"),
        apellidos = document.getElementById("apellidos"),
        rfc = document.getElementById("rfc");

    var data={ idPac: paciente };
    fetch("../model/paciente.php", {
        body: JSON.stringify(data),
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
    })
}
getPaciente();