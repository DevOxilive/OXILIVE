<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");
    include("../../../connection/conexion.php");
    include("../../../model/pacientesCallCenter.php");
} else {
    echo "Error en el sistema";
}
?>
<!DOCTYPE html>
<html lang="es">
<main id="main" class="main">
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Pacientes</h3>
                <hr>
                <?php if ($_SESSION['puesto'] == 1 || $_SESSION['puesto'] == 5) { ?>
                    <div class="btn-box justify-content-first">
                        <a class="btn btn-outline-primary" href="pages/crearPaciente.php" role="button">
                            <i class="bi bi-person-fill-add"></i> Nuevo Paciente
                        </a>
                    </div>
                <?php } ?>
            </div>
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table class="table table-striped" id="myTable" >
                        <thead class="customers">
                            <tr class="table-active table-group-divider" >
                                <th scope="col">N° de Exp</th>
                                <th scope="col">Nombres</th>
                                <th scope="col">Apellidos</th>
                                <th scope="col">Tipo de Paciente</th>
                                <?php if ($_SESSION['puesto'] == 1 || $_SESSION['puesto'] == 5) { ?>
                                    <th scope="col">Acciones</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
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
                                                    <i class="bi bi-pencil-square"></i>
                                                </a> |
                                                <a class="btn btn-outline-danger" href="#" onclick="deletePac(<?php echo $datos['id_pacientes']; ?>)" role="button">
                                                    <i class="bi bi-trash-fill"></i>
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
<script src="../../../js/tables.js"></script>
<script>
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