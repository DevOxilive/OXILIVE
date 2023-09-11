<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../templates/header.php");
    include_once 'materiales/consulta.php';
} else {
    echo "Error en el sistema";
}
?>
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">
                    <!-- Reports -->
                    <div class="col-16">
                        <div class="card">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Reporte Almacen <span>/Hoy</span></h5>

                                <!-- Line Chart -->
                                <div id="reportsChart"></div>

                                <script>
                                    document.addEventListener("DOMContentLoaded", () => {
                                        var datosAlmacen = <?php echo json_encode($datos); ?>;
                                        var nombresMateriales = datosAlmacen.map(function(item) {
                                            return item.nombre;
                                        });

                                        var cantidadesActuales = datosAlmacen.map(function(item) {
                                            return item.cantidad;
                                        });

                                        var cantidadesAdecuadas = datosAlmacen.map(function(item) {
                                            return item.cantidad_adecuada;
                                        });

                                        // Calcular la cantidad suficiente para que sea de color amarillo
                                        var cantidadesSuficientes = cantidadesAdecuadas.map(function(cantidadAdecuada) {
                                            return cantidadAdecuada * 0.26; // Cambia 1.25 al valor que desees para definir el umbral amarillo
                                        });

                                        var seriesData = [
                                            {
                                            name: 'Faltan recursos',
                                            // data: cantidadesActuales,
                                            data: ['#'],
                                            type: 'line',
                                            color: '#FF0000', // Color para la Cantidad Actual
                                        }, 
                                        {
                                            name: 'Recursos adecuados',
                                            data: cantidadesAdecuadas,
                                            type: 'line',
                                            color: '#2eca6a', // Color para la Cantidad Adecuada
                                        }, {
                                            name: 'Recursos estables',
                                            data: cantidadesSuficientes,
                                            type: 'line',
                                            color: '#FFA500', // Color para la Cantidad Suficiente (Amarillo)
                                        }];

                                        // Calcular el porcentaje de diferencia entre la cantidad actual y la cantidad adecuada para cada material
                                        var porcentajesDiferencia = cantidadesActuales.map(function(valor, index) {
                                            return ((valor / cantidadesAdecuadas[index]) * 100);
                                        });

                                        // Crear un arreglo de colores para etiquetas en el eje X basado en los porcentajes de diferencia
                                        var etiquetasColores = porcentajesDiferencia.map(function(porcentaje) {
                                            if (porcentaje <= 25) {
                                                return '#FF0000'; // Rojo si es menor o igual al 25%
                                            } else if (porcentaje <= 49) {
                                                return '#FFA500'; // Amarillo si está entre 26% y 49%
                                            } else {
                                                return '#2eca6a'; // Verde si es mayor al 50%   
                                            }
                                        });

                                        new ApexCharts(document.querySelector("#reportsChart"), {
                                            series: seriesData,
                                            chart: {
                                                height: 350,
                                                type: 'line', // Cambiar a 'line' en lugar de 'area'
                                                toolbar: {
                                                    show: false
                                                },
                                            },
                                            markers: {
                                                size: 4
                                            },
                                            colors: ['#FF0000', '#2eca6a', '#FFA500'], // Colores de las series
                                            fill: {
                                                type: "gradient",
                                                gradient: {
                                                    shadeIntensity: 1,
                                                    opacityFrom: 0.3,
                                                    opacityTo: 0.4,
                                                    stops: [0, 90, 100]
                                                }
                                            },
                                            dataLabels: {
                                                enabled: false
                                            },
                                            stroke: {
                                                curve: 'smooth',
                                                width: 2
                                            },
                                            xaxis: {
                                                categories: nombresMateriales,
                                                labels: {
                                                    show: true,
                                                    rotate: -45, // Rotar etiquetas para una mejor legibilidad
                                                    style: {
                                                        colors: etiquetasColores // Aplicar colores a las etiquetas en el eje X
                                                    }
                                                }
                                            },
                                            yaxis: {
                                                labels: {
                                                    formatter: function(value) {
                                                        return Math.round(value); // Formatear valores como enteros
                                                    }
                                                }
                                            }
                                        }).render();
                                    });

                                </script>
                                <!-- End Line Chart -->

                            </div>

                        </div>
                    </div><!-- End Reports -->
                </div><!-- End Right side columns -->

            </div>
    </section>

</main><!-- End #main -->

</html>
<?php
include("../../templates/footer.php");
?>