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
            setGeneral(dato);
            setDireccion(dato);
            eraseEmpty();
        });
    })
}
//Función para setear los datos de la seccion General
function setGeneral(dato){
    //Apuntadores al DOM para setear los divs
    let nombre = document.getElementById("nombre"),
    apellidos = document.getElementById("apellidos"),
    genero = document.getElementById("genero"),
    edad = document.getElementById("edad"),
    tipo = document.getElementById("tipoPac"),
    telUno = document.getElementById("telefono"),
    telDos = document.getElementById("telefonoDos"),
    expediente = document.getElementById("expediente");
    //Datos que se les introducirá al div
    nombre.textContent = dato.nombres;
    apellidos.textContent = dato.apellidos;
    edad.textContent = dato.edad;
    genero.textContent = dato.genName;
    tipo.textContent = dato.tipoName;
    telUno.textContent = dato.telefono;
    telDos.textContent = dato.telefonoDos;
    expediente.textContent = "";
}
function setDireccion(dato){
    let calle = document.getElementById("calle"),
    noext = document.getElementById("noext"),
    noint = document.getElementById("noint"),
    colonia = document.getElementById("colonia"),
    cp = document.getElementById("cp"),
    delMun = document.getElementById("delMun"),
    estado = document.getElementById("estadoDir"),
    calleUno = document.getElementById("calleUno"),
    calleDos = document.getElementById("calleDos"),
    referencias = document.getElementById("referencias");

    calle.textContent = dato.calle;
    noext.textContent = dato.num_ext;
    noint.textContent = dato.num_in;
    colonia.textContent = (dato.colName).toUpperCase();
    cp.textContent = dato.codigo_postal;
    delMun.textContent = (dato.munName).toUpperCase();
    estado.textContent = (dato.estName).toUpperCase();
    calleUno.textContent = dato.calleUno;
    calleDos.textContent = dato.calleDos;
    referencias.textContent = dato.referencias;
}
function eraseEmpty(){
    var numInt = document.getElementById("noint"),
    numInt_label = document.getElementById("noint-label"),
    calleUno = document.getElementById("calleUno"),
    calleUno_label = document.getElementById("calleUno-label"),
    calleDos = document.getElementById("calleDos"),
    calleDos_label = document.getElementById("calleDos-label"),
    referencias = document.getElementById("referencias"),
    referencias_label = document.getElementById("referencias-label"),
    telDos = document.getElementById("telefonoDos"),
    telDos_label = document.getElementById("telefonoDos-label");
    var inputs = [numInt, calleUno, calleDos, referencias, telDos];
    var labels = [numInt_label, calleUno_label, calleDos_label, referencias_label, telDos_label];
    for (let i = 0; i < inputs.length; i++) {
        var input = inputs[i];
        var label = labels[i];
        if (input.textContent == ""){
            input.style.display = "none";
            label.style.display = "none";
        } else {
            input.style.display = "block";
            label.style.display = "block";
        }
        
    }
}
//Se ejecuta una vez cada que se refresca la página
getPaciente();

