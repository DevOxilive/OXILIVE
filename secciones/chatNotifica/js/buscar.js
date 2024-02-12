$(document).ready(function () {
    var buscador = document.getElementById('buscador');
    var caja = document.getElementById('listaUsuarios');

    function buscarUsuarios() {
        var busqueda = $(buscador).val();

        // Realizar la solicitud AJAX solo si el término no está vacío
        if (busqueda.trim() !== '') {
            $.ajax({
                type: 'POST',
                url: "php/usuarios.php",
                data: { buscar: busqueda }, 
                success: function (data) {
                    // Mostrar los resultados en la lista
                    $(caja).html(data)

                }
            });
        } else {
            // Si el término está vacío, limpiar la lista de resultados
            $(caja).empty();
        }
    }

    // Manejar el evento input para buscar usuarios en tiempo real
    $(buscador).on("input", function () {
        buscarUsuarios();
    });

    // Manejar el evento blur para limpiar los resultados cuando se pierde el foco
    $(buscador).on('blur', function () {
        buscarUsuarios();
    });
});


    // Made by Dazz

    /**
     * 
     *          ( D- A- Z- Z )
     *                /\
     *              /  /
     *            /_  /_
     *             /_   /_
     *              /   /
     *             / /      
     *             \/
     * 
     */