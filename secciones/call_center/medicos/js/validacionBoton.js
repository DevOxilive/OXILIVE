$(document).ready(function () {
    var mostrar = document.querySelector('.mostrarServicios');
    var boton = document.getElementById('start');
    var botonStart = boton.dataset.caso;
    var id = boton.dataset.sv;

    // Variable para rastrear si se ha recargado la página
    var recargado = false;

    console.log(id);
    console.log(botonStart);

    // Función de cambio de estado
    boton.onclick = function () {
        $.ajax({
            type: "POST",
            url: 'php/actualizaEstado.php',
            data: {caso: botonStart, sv: id},
            success: function (data) {
                $(mostrar).html(data);
                console.log("Datos recuperados");
                // Verifico si la página no se ha recargado antes
                if (!recargado) {
                    recargado = true;

                    // Recargar la página después de 1 segundo (1000 milisegundos)
                    setTimeout(function () {
                        location.href = location.href;
                    }, 1000);
                }
            }
        });
    }
});
