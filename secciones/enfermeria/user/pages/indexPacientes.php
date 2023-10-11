<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../../templates/header.php");
    include("../../../../connection/conexion.php");
    include("../model/paciente.php");
} else {
    echo "Error en el sistema";
}
?>
<!DOCTYPE html>

<head>
    <link rel="stylesheet" href="<?php echo $url_base; ?>assets/css/foto_perfil.css">
    <link rel="stylesheet" href="<?php echo $url_base; ?>assets/css/edit.css">
</head>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Lista de Pacientes</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo $url_base; ?>secciones/enfermeria/user/index.php">Dashboard</a></li>
                <li class="breadcrumb-item active">Pacientes</li>
            </ol>
        </nav>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive-sm">
                <table class="table table-bordered  border-dark table-hover" id="myTable">
                    <thead class="table-dark">
                        <tr class="table-active table-group-divider" style="text-align: center;">
                            <th scope="col">Nombre(s)</th>
                            <th scope="col">Apellidos</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($datosPaciente as $paciente) { ?>
                            <tr class="clickeable-row" data-url="paciente.php?idPac=<?php echo $paciente['id_pacientes']; ?>">
                                <td>
                                    <?php echo $paciente['Nombres']; ?>
                                </td>
                                <td>
                                    <?php echo $paciente['Apellidos']; ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
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
<script src="../js/indexPaciente.js"></script>

</html>
<?php
include("../../../../templates/footer.php");
?>