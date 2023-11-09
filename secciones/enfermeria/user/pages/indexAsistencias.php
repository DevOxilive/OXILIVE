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
<html lang="en">

<head>
    <link rel="stylesheet" href="<?php echo $url_base; ?>assets/css/foto_perfil.css">
    <link rel="stylesheet" href="<?php echo $url_base; ?>assets/css/edit.css">
    <link rel="stylesheet" href="<?php echo $url_base; ?>secciones/enfermeria/user/css/timeline.css">
</head>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Asistencias</h1>
        <br>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo $url_base; ?>secciones/enfermeria/user/index.php">Dashboard</a></li>
                <li class="breadcrumb-item active">Asistencias</li>
            </ol>
        </nav>
    </div>
    <section class="section dashboard">
        <div class="page-content page-container" id="page-content">
            <div class="padding">
                <div class="row">
                    <div class="col-lg-10">
                        <div class="timeline p-4 block mb-4">
                            <?php foreach ($lista_timeline as $dato) { ?>
                                <div class="tl-item">
                                    <div class="tl-dot <?php echo ($dato['id_check'] == 1 ? "b-success" : "b-danger") ?>"></div>
                                    <div class="tl-content">
                                        <div class="">Servicio de <b><?php echo $dato['nombreServicio'] ?></b> con <b><?php echo $dato['paciente'] ?></b></div>
                                        <div class="tl-date text-muted mt-1"><?php echo $dato['fechaAsis'] . " | " . $dato['checkTime']; ?></div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>
</main>
<script src="../js/timeline.js"></script>

</html>
<?php
include("../../../../templates/footer.php");
?>