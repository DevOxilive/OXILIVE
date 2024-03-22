$(document).ready(function() {
    var donutOptions = {
        chart: {
            type: 'donut'
        },
        series: [],
        labels: []
    };
    var donut = new ApexCharts(document.querySelector("#donut"), donutOptions);
    donut.render();

    // Crea una instancia de ApexCharts para la gráfica de barras fuera del ámbito de la función consultarGenero()
    var barOptions = {
        chart: {
            type: 'bar'  
        },
        series: [{
            name: 'Cantidad',
            data: []
        }],
        xaxis: { 
            categories: ['FEMENINO', 'MASCULINO']
        }
    };
    var barChart = new ApexCharts(document.querySelector("#bar"), barOptions);
    barChart.render();

    function obtenerDatosUsuarios() {
        $.ajax({
            url: './consultaAlChismoso.php',
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                actualizarGraficaDonut(response.datosAreas);  
            },
            error: function(xhr, status, error) {
                console.error('Error al obtener los datos de usuarios:', error);
            }
        });
    }

    function actualizarGraficaDonut(datosAreas) {
        donut.updateSeries(datosAreas.series);
        donut.updateOptions({
            labels: datosAreas.labels
        });
    }

    function consultarGenero() {
        $.ajax({
            url: './consultaAjax.php',
            type: 'GET',
            dataType: 'json',
            success: function(data){
                // Actualiza los datos de la serie en la gráfica de barras
                barChart.updateSeries([{
                    data: [
                        {x: 'FEMENINO', y: data["FEMENINO"]},
                        {x: 'MASCULINO', y: data["MASCULINO"]}
                    ]
                }]);
            },
            error: function(xhr,status, error){
                console.error(error);
            }
        });
    }

    function consultarDatos() {
        obtenerDatosUsuarios();
        consultarGenero();
    }
    // Realizar la primera consulta cuando la página se carga
    consultarDatos();
    setInterval(consultarDatos, 7000);
});
