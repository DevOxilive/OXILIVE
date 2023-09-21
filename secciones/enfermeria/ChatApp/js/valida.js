const campoTexto = document.getElementById("message");
const submitButton = document.getElementById("submitButton");
// la fuincion comprueba si se hizo click en el boton para agregar la funcion sendMessage(); si no pues la elimina y el boton no envia na
function actualizar() {
    if (campoTexto.value.trim()) {
        submitButton.onclick = sendMessage;
    } else {
        submitButton.sendMessage = null;
    }
}

submitButton.addEventListener('click', actualizar);