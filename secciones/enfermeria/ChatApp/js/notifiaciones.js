function mostrarNotifiacion() {
    Push.create("Hola mundo", {
        body: "Este es el cuerpo de la notificacion",
        icon: "img/logo.png",
        timeout: 4000,
        onClick: function() {
            window.focus();
            this.close();
        }
    });
}

function autorizarNotificacion() {
    Push.Permission.request(onGranted, onDenied);
}

function onGranted() {
    $("#autorizarNotificacion").css("background-color", "green");
}


function onDenied() {
    $("#autorizarNotificacion").css("background-color", "red");
}