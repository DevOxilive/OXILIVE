$(document).ready(function() {
    $("#search_cliente").on("input", function() {
        // Obtén el texto de búsqueda
        let searchText = $(this).val();
        fetch("model/buscarPaciente.php", {
            method: "POST",
            headers: {'Content-Type':'application/json'},
            body: JSON.stringify({text: searchText}),
        })
        .then(response => response.json())
        .then(datos => {
            showPacientes(datos);
        })
    });
});
const lista = document.getElementById('show-list');
let select = 0;
function showPacientes(datos){
    lista.innerHTML="";
    datos.forEach((pac, i) => {
        const item = document.createElement('div');
        
        item.textContent = pac.nomComp;
        if(select === i ){
            item.setAttribute("selected");
        }
        lista.appendChild(item);
    })
}
