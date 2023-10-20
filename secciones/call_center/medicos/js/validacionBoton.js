$(document).ready(function () {
    var mostrar = document.querySelector('.mostrarServicios');
    // var boton = document.querySelector('button');
    var boton = document.getElementById('start');
    var botonStart = boton.dataset.caso;
    var id = boton.dataset.sv;
   

    console.log(id);
    console.log(botonStart);
    // funcion de cambio de estado
    boton.onclick = function () {
        $.ajax({
            type: "POST",
            url: 'php/actualizaEstado.php',
            data: {caso: botonStart, sv: id},
            success: function (data) {
                $(mostrar).html(data);
                console.log("datos recuperados");
            }
        });
    }

});



