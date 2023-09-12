<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");
    include('../../../connection/conexion.php');
    include("../../usuarios/consulta.php");
    include('eliminar.php');
    include('consulta.php');
} else {
    echo "Error en el sistema";
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<main id="main" class="main">
    <div class="row">
        <div class="card-header" style="text-align: right;">
            <a class="btn btn-outline-dark" href="genepaci.php" role="button">
                <i class="bi bi-printer-fill"></i>
            </a>
        </div>
        <hr>
        <div class="card">
            <div class="card-header">
                <a class="btn btn-outline-primary" href="crear.php" role="button">
                    <i class="bi bi-calendar-plus"></i>
                    Nueva Guardia
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table class="table table-bordered  border-dark table-hover" id="myTable">
                        <thead class="table-dark">
                            <tr class="table-active table-group-divider" style="text-align: center;">
                                <th scope="col">Nombre</th>
                                <th scope="col">Apellidos</th>
                                <th scope="col">Hora entrada</th>
                                <th scope="col">Hora salida</th>
                                <th scope="col">Paciente</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($lista_horarios as $horario) { ?>
                            <tr>
                                
                                <td>
                                    <?php echo $horario['Nombres']; ?>
                                </td>
                                <td>
                                    <?php echo $horario['Apellidos']; ?>
                                </td>
                                <td>
                                    <?php echo $horario['horarioEntrada']; ?>
                                </td>
                                <td>
                                    <?php echo $horario['horarioSalida']; ?>
                                </td>
                                <td>
                                    <?php echo $horario['Paciente']; ?>
                                </td>
                                <td>
                                    <a name="" id="" class="btn btn-outline-success"
                                        href="pacientes.php?txtID=<?php echo $horario['id_asignacionHorarios'] ?>"
                                        role="button" >
                                        <i class="bi bi-arrow-left-right"></i>
                                    </a> |
                                    <a name="" id="" class="btn btn-outline-warning"
                                        href="editar.php?txtID=<?php echo $horario['id_asignacionHorarios']; ?>"
                                        role="button">
                                        <i class="bi bi-pencil-square"></i>
                                    </a> |
                                    <a name="" id="" class="btn btn-outline-danger"
                                        onclick="eliminar(<?php echo $horario['id_asignacionHorarios']; ?>)"
                                        role="button">
                                        <i class="bi bi-trash-fill"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</main><!-- End #main -->
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
                window.location.href = "index.php"
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

</html>
<?php
include("../../../templates/footer.php");
?>