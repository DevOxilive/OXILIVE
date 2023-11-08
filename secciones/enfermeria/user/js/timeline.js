function getTimeline(){
    fetch("../model/timeline.php", {
        headers: {"Content-Type":"application/json"},
        body: JSON.stringify({fecha: fecha}),
        method: "POST"
    })
    .then(response => response.json())
    .then(datos => {
        datos.forEach(dato => {

        })
    })
}