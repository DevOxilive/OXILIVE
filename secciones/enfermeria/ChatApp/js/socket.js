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
    console.log(e.data);

    var message = JSON.parse(e.data);
    appendMessage(message.user, message.message);
};

/**
 * Aquí reviso los mensajes enviados en tiempo real al ser enviados
 */

function appendMessage(user, message) {
    var chatContainer = document.getElementById("chat");
    var messageElement = document.createElement("p");
    messageElement.innerHTML = "<strong>" + user + ":</strong> " + message;
    chatContainer.appendChild(messageElement);
}

/**
 * Aquí se carga el mensaje a el otro usuario y se ve igual quien envio que mensaje al mometo
 * aun tengo dudas de como funciona esta parte.
 */

function sendMessage() {
    var user = document.getElementById("user").value;
    var message = document.getElementById("message").value;
    var formattedMessage = "<strong>" + user + ":</strong> " + message;
    appendMessage(user, message);
    var data = {
        user: user,
        message: message
    };
    conn.send(JSON.stringify(data));
    document.getElementById("message").value = "";
}


/**
 * esas son todas mis observaciones con esta practica realizada
 * pero aun tengo dudas de como mantener ejecutandoce el script del servidor.
 */

