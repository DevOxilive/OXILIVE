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
                                <th scope="col">Hora<br>entrada</th>
                                <th scope="col">Hora<br>salida</th>
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
                                        <center>
                                            <?php echo $horario['fecha']; ?>
                                        </center>
                                    </td>
                                    <td>
                                        <center>
                                            <?php echo $horario['horarioEntrada']; ?>
                                        </center>
                                    </td>
                                    <td>
                                        <center>
                                            <?php echo $horario['horarioSalida']; ?>
                                        </center>
                                    </td>
                                    <td>
                                        <?php echo $horario['Paciente']; ?>
                                    </td>
                                    <td>
                                        <center>
                                            <a name="" id="" class="btn btn-outline-warning" href="editar.php?idHor=<?php echo $horario['id_asignacionHorarios']; ?>" role="button">
                                                <i class="bi bi-pencil-square"></i>
                                            </a> |
                                            <a name="" class="btn btn-outline-danger" role="button" onclick="delHor(<?php echo $horario['id_asignacionHorarios']; ?>)">
                                                <i class="bi bi-trash-fill"></i>
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

    function delHor(id) {
        var $id = id;
        Swal.fire({
            title: '¿Seguro que quieres borrar este horario?',
            text: 'Esta acción no se podrá deshacer una vez se realice',
            showCancelButton: true,
            width: 700,
            confirmButtonText: 'Borrar',
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

</html>
<?php
include("../../../../templates/footer.php");
?>