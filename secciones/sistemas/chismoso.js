$(document).ready(function() {
    // Inicialización de la gráfica de donut usando ApexCharts
    var donutOptions = {
        chart: {
            type: 'donut'
        },
        series: [],
        labels: []
    };

    var donut = new ApexCharts(document.querySelector("#donut"), donutOptions);
    donut.render();

    function obtenerDatosUsuarios() {
        $.ajax({
            url: './usuarios/consultaAlChismoso.php',
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                actualizarGraficaDonut(response.datosAreas);
                
                setTimeout(obtenerDatosUsuarios, 20000); // Consultar cada 20 segundos
            },
            error: function(xhr, status, error) {
                console.error('Error al obtener los datos de usuarios:', error);

                setTimeout(obtenerDatosUsuarios, 20000); // Intentar nuevamente después de 20 segundos en caso de error
            }
        });
    }

    function actualizarGraficaDonut(datosAreas) {
        donut.updateSeries(datosAreas.series);
        donut.updateOptions({
            labels: datosAreas.labels
        });
    }

    obtenerDatosUsuarios(); // Llamar a la función para obtener los datos al cargar la página
});
