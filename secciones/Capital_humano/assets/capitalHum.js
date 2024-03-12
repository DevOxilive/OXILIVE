//ESTE AJAX ES PARA CONSULTAR LA DONA
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
    function obtenerDatosUsuarios() {
        $.ajax({
            url: './consultaAjax.php',
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                actualizarGraficaDonut(response.datosAreas);
                
                setTimeout(obtenerDatosUsuarios, 3000); 
            },
            error: function(xhr, status, error) {
                console.error('Error al obtener los datos de usuarios:', error);

                setTimeout(obtenerDatosUsuarios, 20000);
            }
        });
    }
    function actualizarGraficaDonut(datosAreas) {
        donut.updateSeries(datosAreas.series);
        donut.updateOptions({
            labels: datosAreas.labels
        });
    }
    obtenerDatosUsuarios(); 
});
//ESTE AJAX ES PARA CONSULTAR LA GRAFICA
$.ajax({
    url: '../consultaAjax.php',
    type: 'GET',
    dataType: 'json',
    success: function(data){
    console.log(data);

    var options = {
        chart:{
            type: 'bar'  
        },
        series: [{
            name: 'Cantidad',
            data: [
            {x: 'Mujeres', y: data["Mujeres"]},
            {x: 'Hombres', y: data["Hombres"]}
            ]
        }],
        xaxis: {
            categories: ['Mujeres', 'Hombres']
            }
        };
        var chart = new ApexCharts(document.querySelector("#bar"), options);
        chart.render();
    },
    error: function(xhr,status, error){
        console.error(error);
    }
});