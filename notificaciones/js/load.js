$(document).ready(function () {
    box = document.getElementById('notify');
    console.log(box);
    function notificaciones() {
        $.ajax({
            method: 'POST',
            url: 'http://localhost:8080/OXILIVE/notificaciones/notifica.php',
            success: function (response) {
                $(box).html(response)
            },
            error: function (xhr, status, error) {

            }
        })
    }

    setInterval(notificaciones, 2000)

})