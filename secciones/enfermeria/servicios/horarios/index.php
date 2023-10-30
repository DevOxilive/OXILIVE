<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../../../../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../../templates/header.php");
    include('../../../../connection/conexion.php');
    include("../../../usuarios/consulta.php");
    include('model/eliminar.php');
    include('model/consulta.php');
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
                                <th scope="col">Fecha</th>
                                <th scope="col">Horario</th>
                                <th scope="col">Paciente</th>
                                <th scope="col">Estado</th>
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
                                        <?php echo $horario['Paciente']; ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($horario['statusHorario'] == 1) {
                                            $badgeColor = 'class="badge bg-warning fs-6"';
                                            $text = $horario['estado'];
                                        } else if ($horario['statusHorario'] == 2) {
                                            $badgeColor = 'class="badge bg-success fs-6"';
                                            $text = $horario['estado'];
                                        } else if ($horario['statusHorario'] == 3 ){
                                            $badgeColor = 'class="badge bg-info fs-6"';
                                            $text = $horario['estado'];
                                        }
                                        ?>
                                        <center>
                                            <span <?php echo $badgeColor; ?>>
                                                <?php echo $text; ?>
                                            </span>
                                        </center>
                                    </td>
                                    <td>
                                        <center>
                                            <a name="" id="" class="btn btn-outline-warning" href="editar.php?idHor=<?php echo $horario['id_asignacionHorarios']; ?>" role="button">
                                                <i class="bi bi-pencil-square"></i>
                                            </a> |
                                            <a name="" class="btn btn-outline-danger" role="button" onclick="cancelHor(<?php echo $horario['id_asignacionHorarios']; ?>)">
                                                <i class="bi bi-x-lg text-danger"></i>
                                            </a>
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
            }
        });
    });

    function cancelHor(id) {
        var $id = id;
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
                    url: "model/delete.php",
                    data: {
                        id: $id
                    },
                    success: function() {
                        Swal.fire({
                            position: 'top-end',
                            title: "Servicio borrado correctamente",
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1000
                        }).then(function() {
                            window.location.replace('index.php');
                        });
                    }
                });
            }
        });
    }
</script>
<script src="js/statusHorario.js"></script>
</html>
<?php
include("../../../../templates/footer.php");
?>