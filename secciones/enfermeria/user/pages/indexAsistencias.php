<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../../templates/header.php");
    include("../../../../connection/conexion.php");
    $id = $_GET['id'];
    include("../model/timeline.php");
} else {
    echo "Error en el sistema";
}
?>
<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="<?php echo $url_base; ?>assets/css/foto_perfil.css">
    <link rel="stylesheet" href="<?php echo $url_base; ?>assets/css/edit.css">
    <link rel="stylesheet" href="<?php echo $url_base; ?>secciones/enfermeria/user/css/timeline.css">
</head>
<main id="main" class="main">
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Asistencias</h3>
                <div class="breadcrumb-box">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo $url_base; ?>secciones/enfermeria/user/index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Asistencias</li>
                        </ol>
                    </nav>
                </div>
                <hr>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-10">
                        <div class="timeline p-4 block mb-4">
                            <?php foreach ($lista_timeline as $dato) { ?>
                                <div class="tl-item">
                                    <div class="tl-dot <?php echo ($dato['id_check'] == 1 ? "b-success" : "b-danger") ?>"></div>
                                    <div class="tl-content">
                                        <div class="">
                                            <?php echo ($dato['id_check'] == 1 ? "Entrada" : "Salida"); ?> del servicio
                                            <a class="fw-bold text-dark" href="datosAsistencia.php?idSer=<?php echo $dato['id_asistencias']; ?>"><?php echo $dato['nombreServicio'] ?></a> con
                                            <a class="fw-bold text-dark" href="../../../pacientes/paciente.php?idPac=<?php echo $dato['id_pacientes']; ?>"><?php echo $dato['paciente'] ?></a>
                                        </div>
                                        <div class="tl-date text-muted mt-1">
                                            <?php echo $dato['fechaAsis'] . " | " . $dato['checkTime']; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</main>
<script src="../js/timeline.js"></script>
<?php
include("../../../../templates/footer.php");
?>