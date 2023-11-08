<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../../templates/header.php");
    include("../../../../connection/conexion.php");
    $id = $_GET['id'];
    include("../model/fechasAsistencias.php");
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
        <div class="container animated animated-done bootdey" data-animate="fadeIn" data-animate-delay="0.05" style="animation-delay: 0.05s;">
            <hr class="hr-lg mt-0 mb-2 w-10 mx-auto hr-primary">
            <h2 class="text-slab text-center text-uppercase mt-0 mb-5">
                Timeline de asistencias
            </h2>
            <div class="timeline timeline-left mx-lg-10">
                <?php foreach ($lista_fechas as $fechas) { ?>
                    <div class="timeline-breaker"><?php echo $fechas['fechaAsis']; ?></div>
                    <!--Timeline item 1-->
                    <div class="timeline-item mt-3 row text-center p-2" data-date="<?php echo $fechas['fechaAsis']; ?>">
                        <div class="col font-weight-bold text-md-right">West Ham</div>
                        <div class="col-1">vs</div>
                        <div class="col font-weight-bold text-md-left">Chelsea</div>
                        <div class="col-12 text-xs text-muted">Football - English Premier League - 19:45 GMT</div>
                    </div>
                   
                    <!--<div class="timeline-breaker timeline-breaker-bottom">More next week........</div>-->
                <?php } ?>
            </div>
        </div>
    </section>
</main>

</html>
<?php
include("../../../../templates/footer.php");
?>