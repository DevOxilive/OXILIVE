<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../../templates/header.php");
    include("../../../../connection/conexion.php");
    include("../model/horarios.php");
} else {
    echo "Error en el sistema";
}
?>
<!DOCTYPE html>

<head>
    <link rel="stylesheet" href="<?php echo $url_base; ?>assets/css/foto_perfil.css">
    <link rel="stylesheet" href="<?php echo $url_base; ?>assets/css/edit.css">
    <link rel="stylesheet" href="<?php echo $url_base; ?>secciones/enfermeria/user/css/horarios.css">
</head>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Lista de Horarios</h1>
        <br>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo $url_base; ?>secciones/enfermeria/user/index.php">Dashboard</a></li>
                <li class="breadcrumb-item active">Horario</li>
            </ol>
        </nav>
    </div>
    <?php foreach ($lista_horarios as $hor) {
        switch ($hor['statusHorario']) {
            case 1:
                $border = "#ffc107";
                break;
            case 2:
                $border = "#0dcaf0";
                break;
            case 3:
                $border = "#198754";
                break;
            case 4:
                $border = "#dc3545";
                break;
        } ?>
        <div class="card">
            <div class="card-header" style = "border-bottom: <?php echo $border;?> 2px solid;"data-bs-toggle="collapse" data-bs-target="#card<?php echo $hor['id_asignacionHorarios']; ?>">
                <div class="row justify-content-between d-flex">
                    <div class="col-10">
                        <b class="title-hour"><?php echo $hor['nomPaciente']; ?></b>
                    </div>
                    <div class="col-2"><i class="bi bi-chevron-down ms-auto"></i></div>
                </div>
            </div>
            <div id="card<?php echo $hor['id_asignacionHorarios']; ?>" class="card-body collapse">
                <div class="row">
                    <div class="col">
                        sdfsdfds
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <input type="hidden" id="idus" value="<?php echo $_SESSION['idus']?>">
</main>

</html>
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
</script>
<script src="../js/indexHorario.js"></script>
<script src="../js/statusHorario.js"></script>

<?php
include("../../../../templates/footer.php");
?>