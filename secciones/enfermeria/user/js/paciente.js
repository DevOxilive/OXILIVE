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
            let bread = document.getElementById("bread"); 
            bread.textContent = dato.Nombres;
            setGeneral(dato);
            setDireccion(dato);
        });
    })
}
//Función para setear los datos de la seccion General
function setGeneral(dato){
    //Apuntadores al DOM para setear los divs
    let nombre = document.getElementById("nombre"),
    apellidos = document.getElementById("apellidos"),
    edad = document.getElementById("edad"),
    genero = document.getElementById("genero"),
    telefono = document.getElementById("telefono"),
    expediente = document.getElementById("expediente");
    //Datos que se les introducirá al div
    nombre.textContent = dato.Nombres;
    apellidos.textContent = dato.Apellidos;
    edad.textContent = dato.Edad;
    genero.textContent = dato.genero;
    telefono.textContent = dato.Telefono;
    expediente.textContent = dato.No_nomina;
}
function setDireccion(dato){
    let calle = document.getElementById("calle"),
    noext = document.getElementById("noext"),
    noint = document.getElementById("noint"),
    colonia = document.getElementById("colonia"),
    cp = document.getElementById("cp"),
    delMun = document.getElementById("delMun"),
    estado = document.getElementById("estadoDir"),
    referencias = document.getElementById("referencias");

    calle.textContent = dato.calle;
    noext.textContent = dato.num_ext;
    noint.textContent = dato.num_in;
    colonia.textContent = dato.colonia;
    cp.textContent = dato.cp;
    delMun.textContent = dato.municipio;
    estado.textContent = dato.estado_direccion;
    referencias.textContent = dato.referencias;
}
//Se ejecuta una vez cada que se refresca la página
getPaciente();