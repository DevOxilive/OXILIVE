$(document).ready(function () {
    var mostrar = document.querySelector('.mostrarServicios');
    var interval;

    function actualizarCronometro(tiempoSpan, botonTerminar) {
        var tiempoRestante = parseInt(tiempoSpan.textContent);
        
        if (tiempoRestante > 0) {
            tiempoRestante--;
            tiempoSpan.textContent = tiempoRestante;
        }

        if (tiempoRestante <= 0) {
            clearInterval(interval); // Detengo el cronómetro
            tiempoSpan.textContent = "0";
            botonTerminar.removeAttribute("disabled"); // Habilito el botón "Terminar"
        }
    }

    function buscarServicio() {
        $.ajax({
            type: "POST",
            url: "php/estadoServicio.php",
            beforeSend: function (){
                clearInterval(interval);
            },
            success: function (data) {
                console.log('archivo encontrado');
                $(mostrar).html(data);
                // Aquí llamo al AJAX, reinicio el intervalo
                interval = setInterval(function () {
                    var tiempoSpan = document.getElementById("tiempo");
                    var botonTerminar = document.getElementById("start");
                    if (tiempoSpan && botonTerminar) {
                        actualizarCronometro(tiempoSpan, botonTerminar);
                    }
                }, 2000);
            },
            error: function (error) {
                console.error("Error en la solicitud AJAX: " + error.responseText);
            }
        });
    }

    // Actualiza el cronómetro y busca servicios cada 2 segundos
    interval = setInterval(function () {
        buscarServicio();
        var tiempoSpan = document.getElementById("tiempo");
        var botonTerminar = document.getElementById("start");

        if (tiempoSpan && botonTerminar) {
            actualizarCronometro(tiempoSpan, botonTerminar);
        }
    }, 2000);
});
