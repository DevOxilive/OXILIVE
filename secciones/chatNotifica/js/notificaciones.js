function obtenerNuevosMensajes() {
    $.ajax({
        url: 'src/notifica.php',
        method: 'POST',
        success: function (data) {
                // Mostrar notificación solo si hay nuevos mensajes
                $('#notifi').html(data);
        },
        error: function (error) {
            console.error('Error al obtener nuevos mensajes:', error);
        }
    });
}
setInterval(obtenerNuevosMensajes, 500);
