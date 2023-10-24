<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");
    include("../../../connection/conexion.php");
    include("../../../module/pacientesCallCenter.php");
} else {
    echo "Error en el sistema";
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <link rel="stylesheet" href="../../../../assets/css/foto_perfil.css">
    <link rel="stylesheet" href="../../../../assets/css/edit.css">
</head>
<main id="main" class="main">
    <section class="section dashboard">
        <div class="card">
            <div class="card-header">
                <h2>Pacientes</h2>
                <a class="btn btn-outline-primary" href="pages/crearPaciente.php" role="button">
                    <i class="bi bi-calendar-plus"></i>
                    Nuevo Paciente
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table class="table table-bordered border-dark table-hover" id="myTable">
                        <thead class="table-dark">
                            <tr class="table-active table-group-divider" style="text-align: center;">
                                <th scope="col">N° de Exp</th>
                                <th scope="col">Nombres</th>
                                <th scope="col">Apellidos</th>
                                <th scope="col">Tipo de Paciente</th>
                                <?php if ($_SESSION['puesto'] == 1 || $_SESSION['puesto'] == 5) { ?>
                                    <th scope="col">Acciones</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pacientes as $datos) { ?>
                                <tr>
                                    <td>
                                        <center><?php echo $datos['id_pacientes'] ?></center>
                                    </td><!-- Por definir numero de expediente -->
                                    <td><?php echo $datos['nombres']; ?></td>
                                    <td><?php echo $datos['apellidos']; ?></td>
                                    <td>
                                        <center>
                                            <?php if ($datos['idTipoPac'] == 1) { ?>
                                                <span class="badge text-bg-primary fs-6">
                                                <?php } else if ($datos['idTipoPac'] == 2) { ?>
                                                    <span class="badge text-bg-secondary fs-6">
                                                    <?php }
                                                echo $datos['tipoPaciente']; ?>
                                                    </span>
                                        </center>
                                    </td>
                                    <?php if ($_SESSION['puesto'] == 1 || $_SESSION['puesto'] == 5) { ?>
                                        <td>
                                            <center>
                                                <a name="" id="" class="btn btn-outline-warning" href="pages/editarPaciente.php?idPac=<?php echo $datos['id_pacientes']; ?>" role="button">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a> |
                                                <a name="" class="btn btn-outline-danger" role="button" onclick="cancelHor(<?php echo $datos['id_pacientes']; ?>)">
                                                    <i class="bi bi-x-lg text-danger"></i>
                                                </a>
                                            </center>
                                        </td>
                                    <?php } ?>
                                </tr>

                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</main>

</html>
<script>
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