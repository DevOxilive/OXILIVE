<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../../../../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../../templates/header.php");
    include('../../../../connection/conexion.php');
    include("../../../usuarios/consulta.php");
    include('model/eliminar.php');
    include("model/consulta.php");
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
        <div class="card">
            <div class="card-header">
                <h2>Horario de servicios</h2>
                <hr>
                <div class="btn-group">
                    <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        Action
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Separated link</a></li>
                    </ul>
                </div>
                <a class="btn btn-outline-primary" href="crear.php" role="button">
                    <i class="bi bi-calendar-plus"></i>
                    Nueva Guardia
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table class="table table-bordered border-dark table-hover" id="myTable">
                        <thead class="table-dark">
                            <tr class="table-active table-group-divider" style="text-align: center;">
                                <th scope="col">Enfermero(a)</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Horario</th>
                                <th scope="col">Paciente</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($lista_horarios as $horario) { ?>
                                <tr id="fila<?php echo $horario['id_asignacionHorarios']; ?>">
                                    <td id="fila<?php echo $horario['id_asignacionHorarios']; ?>">
                                        <?php echo $horario['enfermero']; ?>
                                    </td>
                                    <td>
                                        <center>
                                            <?php echo $horario['fecha']; ?>
                                        </center>
                                    </td>
                                    <td>
                                        <center>
                                            <?php echo $horario['horarioEntrada']; ?> /<br>
                                            <?php echo $horario['horarioSalida']; ?>
                                        </center>
                                    </td>
                                    <td>
                                        <?php echo $horario['paciente']; ?>
                                    </td>
                                    <td>
                                        <center>
                                            <span id="status<?php echo $horario['id_asignacionHorarios'] ?>">
                                            </span>
                                        </center>
                                    </td>
                                    <td>
                                        <center id="acciones<?php echo $horario['id_asignacionHorarios'] ?>">
                                        </center>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main><!-- End #main -->
<script>
    $(document).ready(function() {
        $.noConflict();
        $('#myTable').DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
            },
            "order": [], 
        });
    });

    function cancelHor(e, id) {
        e.preventDefault();
        Swal.fire({
            title: '¿Seguro que quieres cancelar este horario?',
            text: 'Esta acción no se podrá deshacer una vez se realice, pero podrás seguir viendo el horario en la seccion de Cancelados',
            showCancelButton: true,
            width: 700,
            confirmButtonText: 'Confirmar',
            confirmButtonColor: '#3085d6',
            cancelButtonText: `Cancelar`,
            cancelButtonColor: '#d33',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "model/cancel.php",
                    data: {
                        id: id
                    },
                    success: function() {
                        Swal.fire({
                            position: 'top-end',
                            title: "Servicio cancelado correctamente",
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1000
                        }).then(function() {
                            let fila = document.getElementById("fila" + id);
                            fila.remove();
                        });
                    }
                });
            }
        });
    }
</script>
<script src="js/statusHorario.js"></script>
<script src="js/cancelados.js"></script>

</html>
<?php
include("../../../../templates/footer.php");
?>