<?php
session_start();
if (!isset($_SESSION['us'])) {
  header('Location: ../../../login.php');
} elseif (isset($_SESSION['us'])) {
  include("../../../templates/header.php");
  include("../../../connection/conexion.php");
  include("../control_de_nomina/model/consultaAsistencias.php");
  include("../control_de_nomina/model/consultaSueldo.php");
  include("../control_de_nomina/model/consultaHorarios.php");

} else {
  echo "Error en el sistema";
}

?>

<!-- Empieza main -->
<main id="main" class="main">
    <div class="row mb-3">
        <div class="col-md-3">
            <input type="date" class="form-control" id="fecha1">
        </div>
        <div class="col-md-3">
            <input type="date" class="form-control" id="fecha2">
        </div>
        <div class="col-md-2">
            <!-- Boton para el reporte en PDF -->
            <a class="btn btn-info" href="#" onclick="generarReportePDF();" role="button"
                onclick="return validarFechas();">
                <i class="bi bi-file-earmark-pdf-fill"></i> Generar PDF
            </a>
        </div>
        <div class="col-md-2">
            <!-- Boton para el reporte en Excel -->
            <a class="btn btn-success" href="#" onclick="generarReporteExcel();" role="button"
                onclick="return validarFechas();">
                <i class="bi bi-file-earmark-spreadsheet-fill"></i> Generar Excel
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            Registro de nóminas

            <!-- Inicia tabla -->
        </div>
        <div class="card-body">
            <div class="table-responsive-sm">
                <!-- Mostrar los datos en la tabla -->
                <table class="table table-bordered border-dark table-hover" id="myTable">
                    <thead class="table-dark">
                        <tr class="table-active table-group-divider" style="text-align: center;">
                            <th scope="col">Asistencias</th>
                            <th scope="col">Nombre completo</th>
                            <th scope="col">Retardos</th>
                            <th scope="col">Decuento</th>
                            <th scope="col">Sueldo Total</th>
                        </tr>
                    </thead>
                    <tbody>



                        <?php 
        $usuariosUnicos = [];

        // Combina la información de asistencias y sueldo para cada usuario
        foreach ($trabajador as $usuario) {
            $idUsuario = $usuario['id_usuarios'];
        
            if (!isset($usuariosUnicos[$idUsuario])) {
                $usuariosUnicos[$idUsuario] = [
                    'numero_de_Asistencias' => $usuario['numero_de_Asistencias'],
                    'NombreCompleto' => $usuario['NombreCompleto'],
                    'retardos' => 0, // Inicializar el retardo
                    'sueldo_total' => 0, // Inicializar el sueldo total
                ];
            }
        }
        foreach ($sueldo as $pago) {
            $idUsuario = $pago['id_usuarios'];
        
            if (isset($usuariosUnicos[$idUsuario])) {
                $usuariosUnicos[$idUsuario]['sueldo_total'] = $pago['sueldo_total'];
            }
        }

        foreach ($horarios as $retardo) {
            $idUsuario = $retardo['id_usuarios'];
        
            if (isset($usuariosUnicos[$idUsuario])) {
                $usuariosUnicos[$idUsuario]['retardos'] = $retardo['retardos'];
        
                // Aplicar descuento si hay 3 o más retardos
                if ($retardo['retardos'] >= 3) {
                    // Ajusta el valor del descuento según tus necesidades
                    $usuariosUnicos[$idUsuario]['descuento'] = $usuariosUnicos[$idUsuario]['sueldo_total'] /  $usuariosUnicos[$idUsuario]['numero_de_Asistencias'] ; // Por ejemplo, 10%
                } else {
                    // Si no hay descuento, establecerlo en 0
                    $usuariosUnicos[$idUsuario]['descuento'] = 0;
                }
            }
        }
    ?>
                        <?php foreach ($usuariosUnicos as $usuario): ?>
                        <tr>
                            <th scope="row"><?php echo $usuario['numero_de_Asistencias']; ?></th>
                            <td><?php echo $usuario['NombreCompleto']; ?></td>
                            <td><?php echo $usuario['retardos']; ?></td>
                            <td><?php echo isset($usuario['descuento']) ? $usuario['descuento'] : 0; ?></td>
                            <td><?php echo $usuario['sueldo_total'] - $usuario['descuento']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <!-- fin de la tabla -->
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


$(document).ready(function() {
    $.noConflict();

    $('#myTable').DataTable({
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
        }
    });

});
</script>

<?php
include("../../../templates/footer.php");
?>