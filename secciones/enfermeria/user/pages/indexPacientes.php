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
        <br>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo $url_base; ?>secciones/enfermeria/user/index.php">Dashboard</a></li>
                <li class="breadcrumb-item active">Pacientes</li>
            </ol>
        </nav>
    </div>
    <div class="card">
        <br>
        <div class="card-body">
            <div class="table-responsive-sm">
                <table class="table   border-dark table-hover" id="myTable">
                    <thead class="table-dark">
                        <tr class="table-active table-group-divider" style="text-align: center;">
                            <th scope="col">Nombre(s)</th>
                            <th scope="col">Apellidos</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($datosPaciente as $paciente) { ?>
                            <tr class="clickeable-row" data-url="../../../pacientes/paciente.php?idPac=<?php echo $paciente['id_pacientes']; ?>">
                                <td>
                                    <?php echo $paciente['nombres']; ?>
                                </td>
                                <td>
                                    <?php echo $paciente['apellidos']; ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
<script src="../js/indexPaciente.js"></script>
<script src="../../../../js/tables.js"></script>
</html>
<?php
include("../../../../templates/footer.php");
?>