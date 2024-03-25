$(document).ready(function () {
    notificar = document.getElementById('notificacion');
    $.ajax({
        type: 'POST',
        url: 'http://localhost:8080/OXILIVE/notificaciones/notifica.php',
        success: function (response) {
            console.log(response)
            $(notificar).html(response)
        }
    })
});