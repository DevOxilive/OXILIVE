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
            |<!-- Boton de para el reporte en pdf -->
            <a class="btn btn-outline-info" href="gene_pdf.php" role="button"><i class="bi bi-printer-fill"></i></a>
            |
            <!-- Boton de para el reporte en excel -->
            <a class="btn btn-outline-success" href="reporte.php" role="button"><i 
            class="bi bi-filetype-xlsx"></i></a>
            |
        
        </div>
        <div class="card">
            <div class="card-header">
                Registro de nóminas

                <!-- Inicia tabla -->
            </div>
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table class="table table-bordered  border-dark table-hover" id="myTable">
                        <thead class="table-dark">
                            <tr class="table-active table-group-divider" style="text-align: center;">
                                <th scope="col">Usuario</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Apellidos</th>
                                <th scope="col">Dias laborados</th>
                                <th scope="col">Sueldo Total</th>
                                <th scope="col">Tipo de guardia</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($trabajador as $trab) { ?>
                            <tr>
                                <th scope="row">
                                    <?php echo $trab['id_usuarios']; ?>
                                </th>
                                <td>
                                    <?php echo $trab['Nombres']; ?>
                                </td>
                                <td>
                                    <?php echo $trab['Apellidos']; ?>
                                </td>
                                <td>
                                    <?php echo $trab['Nombre_puestos']; ?>
                                </td>
                                <td>
                                    <?php echo $trab['codigo_postal']; ?>
                                </td>
                                <td>
                                    
                                <?php echo $trab['rfc']; ?>

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