/**
 * En esta parte se conecta el websocket
 * llamando a la ruta donde esta el puerto del servidor
 */
var conn = new WebSocket('ws://localhost:8181');
conn.onopen = function (e) {
    console.log("Connection established!");
};

/**
 * Aquí los mensajes se cargan en formato json pero me queda
 * pendiente aprender a procesar los datos enviados y cargarlos a la base de datos
 * tal como generar el historil y esas cosas
 */

conn.onmessage = function (e) {
    var message = e.data; // Obtener el mensaje directamente como texto
    appendMessage(message);
};

function appendMessage(message) {
    var chatContainer = document.getElementById("chat");
    var messageElement = document.createElement("p");
    messageElement.textContent = message; // Utilizar textContent para mostrar el mensaje
    chatContainer.appendChild(messageElement);
}

function sendMessage() {
    var message = document.getElementById("message").value;
    var formattedMessage = message; // Construir el mensaje como cadena de texto
    appendMessage(formattedMessage);
    conn.send(formattedMessage);
    document.getElementById("message").value = "";
}