<?php
session_start();
if (!isset($_SESSION['us'])) {
  header('Location: ../../../login.php');
} elseif (isset($_SESSION['us'])) {
  include("../../../../templates/header.php");
  include("../../../../connection/conexion.php");
  include("./consulta_tabla.php");
} else {
  echo "Error en el sistema";
}

?>

<!-- Empieza main -->
<main id="main" class="main">
    <div class="row">
        <div class="card-header" style="text-align: right;">
            <!-- Boton para el reporte en PDF -->
            <a class="btn btn-outline-info" href="" role="button"><i class="bi bi-printer-fill"></i></a>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <p class="font-weight-bold">Bitacora de asistencia</p>
        </div>
        <div class="card-body">
            <div class="table-responsive-sm">
                <table class="table table-bordered border-dark table-hover" id="myTable">
                    <thead class="table-dark">
                        <tr class="table-active table-group-divider" style="text-align: center;">
                            <th scope="col">Id asistencia</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Hora de entrada</th>
                            <th scope="col">Hora de salida</th>
                            <th scope="col">Estatus</th>
                            <th scope="col">Detalles</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($lista_bitacora as $Lsb) { ?>
                        <tr>
                            <th scope="row">
                                <?php echo $Lsb['id_Rbitacora']; ?>
                            </th>
                            <td>
                                <?php echo $Lsb['Registro_fecha']; ?>
                            </td>
                            <td>
                                <?php echo $Lsb['hora_entrada']; ?>
                            </td>

                            <td>
                                <?php echo $Lsb['hora_salida']; ?>
                            </td>

                            <td>
                                <?php
                                 if ($Lsb['id_checkOut']) {
                                 // Si existe id_checkOut, muestra "Servicio completo" en verde
                                 echo '<span style="color: green;">Servicio completo</span>';
                                 } elseif ($Lsb['id_checkIn']) {
                                 // Si solo existe id_checkIn, muestra "En proceso" en naranja
                                 echo '<span style="color: orange;">En proceso</span>';
                                 } else {
                                 // Si no existe ninguna de las dos, puedes mostrar un valor 
                                 // predeterminado o un mensaje de error
                                 // esto solo si no reliza el check de manera correcta
                                  echo 'Error en el estatus';
                                  }
                                 ?>
                            </td>
                            <td>


                                <a name="" id="" class="btn btn-outline-warning"
                                    href="prueba2.php?checkIn=<?php echo $Lsb['id_checkIn'];?>&checkOut=<?php echo $Lsb['id_checkOut'];?>" role="button"><i
                                        class="bi bi-info-square"></i></a>


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
include("../../../../templates/footer.php");
?>