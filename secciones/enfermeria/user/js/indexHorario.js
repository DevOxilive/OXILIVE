var idus = document.getElementById("idus");

function getDatos(){
    fetch("../model/horarios.php", {
        method: "POST",
        body: JSON.stringify({id: idus.value}),
        headers: {"Content-Type":"application/json"}
    })
    .then(response => response.json())
    .then(datos => {
        datos.forEach(dato => {

            console.log(dato);
        })
    })
}
getDatos();