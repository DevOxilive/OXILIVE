<?php
session_start();
if (!isset($_SESSION['us'])) {
  header('Location: ../../../login.php');
} elseif (isset($_SESSION['us'])) {
  include("../../../templates/header.php");
  include("../../../connection/conexion.php");
  include("./consulta.php");
} else {
  echo "Error en el sistema";
}

?>

<!-- Empieza main -->
<main id="main" class="main">
    <div class="row">
        <div class="card-header" style="text-align: right;">
            <input type="date" id="fecha1">
            |
            <input type="date" id="fecha2">
            <!-- Boton para el reporte en PDF -->
            <a class="btn btn-outline-info" href="#" onclick="generarReportePDF();" role="button">
                <i class="bi bi-printer-fill"></i>
            </a>
             <!-- Boton para el reporte en Excel -->
             <a class="btn btn-outline-success" href="#" onclick="generarReporteExcel();" role="button">
                <i class="bi bi-filetype-xlsx"></i>
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
                <table class="table table-bordered border-dark table-hover" id="myTable">
                    <thead class="table-dark">
                        <tr class="table-active table-group-divider" style="text-align: center;">
                            <th scope="col">Asistencias</th>
                            <th scope="col">Nombre completo</th>
                            <th scope="col">Tipo de guardia</th>
                            <th scope="col">Dias laborados</th>
                            <th scope="col">Sueldo Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($trabajador as $trab) { ?>
                        <tr>
                            <th scope="row">
                                <?php echo $trab['id_check']; ?>
                            </th>
                            <td>
                                <?php echo $trab['Nombre completo']; ?>
                            </td>
                            <td>
                                <?php echo $trab['Tipo de guardia']; ?>
                            </td>
                            <td>
                                <?php echo $trab['Dias laborados']; ?>
                            </td>
                            <td>

                                <?php echo $trab['Sueldo Total']; ?>

                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>


                <!-- fin de la tabla -->
            </div>
        </div>
    </div>
</main>
<!-- End #main -->
<script>
function generarReportePDF() {
    // Obtener los valores de fecha1 y fecha2
    var fecha1 = document.getElementById("fecha1").value;
    var fecha2 = document.getElementById("fecha2").value;

    // Construir la URL con los parámetros
    var url = "reporte_pdf.php?fecha1=" + fecha1 + "&fecha2=" + fecha2;

    // Redirigir al usuario a la página con los parámetros
    window.open(url, "_blank");
}

function generarReporteExcel() {
        // Obtener los valores de fecha1 y fecha2
        var fecha1 = document.getElementById("fecha1").value;
        var fecha2 = document.getElementById("fecha2").value;

        // Construir la URL con los parámetros
        var url = "reporte_excel.php?fecha1=" + fecha1 + "&fecha2=" + fecha2;

        // Redirigir al usuario a la página con los parámetros
        window.location.href = url;
    }


function eliminar(codigo) {
    Swal.fire({
        title: '¿Estas seguro?',
        text: "No podrás recuperar los datos",
        cancelButtonText: 'Cancelar',
        icon: 'warning',
        buttons: true,
        showCancelButton: true,
        dangerMode: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            mandar(codigo)
        }
    })
}

function mandar(codigo) {
    parametros = {
        id: codigo
    };
    $.ajax({
        data: parametros,
        url: "./eliminar.php",
        type: "POST",
        beforeSend: function() {},
        success: function() {
            Swal.fire("Eliminado:", "Ha sido eliminado", "success").then((result) => {
                window.location.href = "index.php";


            });
        },

    });

    // Obtener fecha actual
    let fecha = new Date();
    // Obtener cadena en formato yyyy-mm-dd, eliminando zona y hora
    let fechaMax = fecha.toISOString().split('T')[0];
    // Asignar valor mínimo
    document.querySelector('#fecha1').max = fechaMax;




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



}
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