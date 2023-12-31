<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");
    include("../../../connection/conexion.php");
    include("../control_de_nomina/model/consultaTrabajador.php");
} else {
    echo "Error en el sistema";
}
?>
<!-- Empieza main -->
<main id="main" class="main">
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Registro de nóminas</h3>
                <hr>
                <div class="btn-box justify-content-between">
                    <div class="d-flex justify-content-first col-md-7">
                        <div class="col-md-6 d-flex justify-content-first">
                            <div class="col-md-11">
                                <label for="fecha1" class="form-label">Entre la fecha:</label>
                                <input type="date" class="form-control" id="fecha1">
                            </div>
                        </div>
                        <div class="col-md-6 d-flex justify-content-first">
                            <div class="col-md-11">
                                <label for="fecha2" class="form-label">Y la fecha:</label>
                                <input type="date" class="form-control" id="fecha2">
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end col-md-5">
                        <div class="w-auto d-flex justify-content-end">
                            <!-- Boton para el reporte en PDF -->
                            <a class="btn btn-info align-self-end" href="#" onclick="generarReportePDF();" role="button" onclick="return validarFechas();">
                                <i class="bi bi-file-earmark-pdf-fill"></i> Generar PDF
                            </a>
                        </div>
                        <div class="w-auto d-flex justify-content-end">
                            <!-- Boton para el reporte en Excel -->
                            <a class="btn btn-success align-self-end" href="#" onclick="generarReporteExcel();" role="button" onclick="return validarFechas();">
                                <i class="bi bi-file-earmark-spreadsheet-fill"></i> Generar Excel
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive-sm">
                    <!-- Mostrar los datos en la tabla -->
                    <table class="table border-dark table-hover" id="myTable" style="border: 1px black">
                        <thead class="table-dark">
                            <tr class="table-active table-group-divider">
                                <th scope="col">Asistencias</th>
                                <th scope="col">Nombre completo</th>
                                <th scope="col">Retardos</th>
                                <th scope="col">Descuento</th>
                                <th scope="col">Sueldo Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($trabajador as $usuario) : ?>
                                <tr>
                                    <th scope="row"><?php echo $usuario['numero_de_Asistencias']; ?></th>
                                    <td><?php echo $usuario['NombreCompleto']; ?></td>
                                    <td><?php echo $usuario['retardos']; ?></td>
                                    <?php
                                    // Calcula el descuento dividiendo sueldo_total entre retardos, y formatea el resultado
                                    $descuento = ($usuario['retardos'] > 0) ? $usuario['sueldo_total'] / $usuario['retardos'] : 0;
                                    ?>
                                    <td><?php echo isset($descuento) ? number_format($descuento, 2) : 0; ?></td>

                                    <td><?php echo number_format($usuario['sueldo_total'] - $descuento, 2); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <!-- fin de la tabla -->
                </div>
            </div>
        </div>
    </div>
</main>
<!-- End #main -->
<script>
    //este ecrip es para validar las fechas, si no an sido seleccionadas
    //no se puede generar los reportes
    function validarFechas() {
        var fecha1 = document.getElementById("fecha1").value;
        var fecha2 = document.getElementById("fecha2").value;

        if (fecha1 === "" || fecha2 === "") {
            Swal.fire({
                icon: "error",
                title: "Selecciona las fechas antes de generar el reporte.",
                width: "600px",
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            });
            return false; // Detiene la ejecución si las fechas no están seleccionadas
        }
        return true; // Continúa la ejecución si las fechas están seleccionadas
    }
    //Funcion que genera los reportes PDF
    function generarReportePDF() {
        // Validar las fechas
        if (!validarFechas()) {
            return; // Detener la ejecución si las fechas no son válidas
        }

        // Obtener los valores de fecha1 y fecha2
        var fecha1 = document.getElementById("fecha1").value;
        var fecha2 = document.getElementById("fecha2").value;

        // Construir la URL con los parámetros
        var url = "reporte_pdf.php?fecha1=" + fecha1 + "&fecha2=" + fecha2;

        // Redirigir al usuario a la página con los parámetros
        window.open(url, "_blank");
    }
    //Funcion que genera los reportes en Excel
    function generarReporteExcel() {
        // Validar las fechas
        if (!validarFechas()) {
            return; // Detener la ejecución si las fechas no son válidas
        }

        // Obtener los valores de fecha1 y fecha2
        var fecha1 = document.getElementById("fecha1").value;
        var fecha2 = document.getElementById("fecha2").value;

        // Construir la URL con los parámetros
        var url = "reporte_excel.php?fecha1=" + fecha1 + "&fecha2=" + fecha2;

        // Redirigir al usuario a la página con los parámetros
        window.location.href = url;
    }

    // Agrega la animación a los bordes de las filas
    const rows = document.querySelectorAll(".animated-border");
    rows.forEach(row => {
        row.addEventListener("mouseover", () => {
            row.classList.add("border-animation");
        });
        row.addEventListener("mouseout", () => {
            row.classList.remove("border-animation");
        });
    });
</script>
<script src="../../../js/tables.js"></script>
<?php
include("../../../templates/footer.php");
?>