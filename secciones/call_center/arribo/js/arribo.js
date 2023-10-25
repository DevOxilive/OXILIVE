$(document).ready(function () {

    function arribo() {
        $.ajax({
            url: 'php/cargarArribo.php',
            type: 'POST',
            success: function (data) {
                $('#mostrarArribo').html(data);
            }
        });
    }

    setInterval(() => {
        arribo();
    }, 1000);
});