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
    <link rel="stylesheet" href="../../../assets/css/foto_perfil.css">
    <link rel="stylesheet" href="../../../assets/css/edit.css">
</head>
<main id="main" class="main">
    <section class="section dashboard">
        <div class="card">
            <div class="card-header">
                <h2>Pacientes</h2>
                <?php if ($_SESSION['puesto'] == 1 || $_SESSION['puesto'] == 5) { ?>
                    <a class="btn btn-outline-primary" href="pages/crearPaciente.php" role="button">
                        <i class="bi bi-person-fill-add"></i>
                        Nuevo Paciente
                    </a>
                <?php } ?>
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
                                    <td class="clickeable-row" data-url="../../pacientes/paciente.php?idPac=<?php echo $datos['id_pacientes']; ?>">
                                        <center><?php echo $datos['id_pacientes'] ?></center>
                                    </td><!-- Por definir numero de expediente -->
                                    <td class="clickeable-row" data-url="../../pacientes/paciente.php?idPac=<?php echo $datos['id_pacientes']; ?>"><?php echo $datos['nombres']; ?></td>
                                    <td class="clickeable-row" data-url="../../pacientes/paciente.php?idPac=<?php echo $datos['id_pacientes']; ?>"><?php echo $datos['apellidos']; ?></td>
                                    <td class="clickeable-row" data-url="../../pacientes/paciente.php?idPac=<?php echo $datos['id_pacientes']; ?>">
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
                                                <a class="btn btn-outline-primary" href="pages/editarPaciente.php?idPac=<?php echo $datos['id_pacientes']; ?>" role="button">
                                                    <i class="bi bi-pencil-square"></i><span> Editar</span>
                                                </a> |
                                                <a class="btn btn-outline-danger" onclick="deletePac(<?php echo $datos['id_pacientes']; ?>)" role="button">
                                                    <i class="bi bi-trash-fill text-danger"></i><span class="text-danger"> Eliminar</span>
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

    function deletePac(idPac) {
        Swal.fire({
            title: "¿Estás seguro?",
            html: "Se eliminará permanentemente todos los datos de este paciente<br><b>No podrás recuperar la información</b>",
            icon: "warning",
            showCancelButton: true,
            width: 700,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Continuar",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.isConfirmed) {
                fetch("model/borrarPaciente.php", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({
                            idPac: idPac
                        })
                    })
                    .then(response => response.text())
                    .then(respuesta => {
                        if (respuesta == 1) {
                            Swal.fire({
                                title: "Eliminado",
                                text: "Paciente eliminado correctamente",
                                icon: "success",
                                showConfirmButton: false,
                                timer: 1500,
                            }).then(function() {
                                window.location.reload();
                            });
                        }
                    });
            }
        });
    }
</script>
<script src="js/tableClick.js"></script>
<?php
include("../../../templates/footer.php");
?>