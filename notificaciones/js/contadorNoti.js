$(document).ready(function() {
    campana = document.getElementById('cont');

    function totalNotificaciones() {
        $.ajax({
            url: 'http://localhost:8080/OXILIVE/notificaciones/cont.php',
            success: function(response) {
                $(campana).html(response)
            }
        })
    }

    setInterval(totalNotificaciones, 5000)
})