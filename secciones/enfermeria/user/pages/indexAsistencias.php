<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../../templates/header.php");
    include("../../../../connection/conexion.php");
    include("../model/asistencias.php");
} else {
    echo "Error en el sistema";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="<?php echo $url_base; ?>assets/css/foto_perfil.css">
    <link rel="stylesheet" href="<?php echo $url_base; ?>assets/css/edit.css">
</head>
<main id="main" class="main">
    <?php foreach ($lista_asistencias as $asis) { ?>
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
            <div class="row">
                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Check In</h5>
                            <div class="row align-items-center">
                                <img src="<?php echo $asis['checkFotografia']; ?>" alt="Foto de Asistencias">
                            </div>

                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Ubicación</h5>
                            <iframe width="600" height="450" style="border:0" loading="lazy"
                            allowfullscreen referrerpolicy="no-referrer-when-downgrade"
                            src="https://www.google.com/maps/embed/v1/place?key=API_KEY&q=Space+Needle,Seattle+WA">
                            </iframe>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Datos Generales</h5>
                            <dl class="row">
                                <dt class="col-lg-3 col-md-4 label">Paciente:</dt>
                                <dd class="col-lg-9 col-md-8" id="paciente"><?php echo $asis['id_empleadoEnfermeria']; ?></dd>
                                <dt class="col-lg-3 col-md-4 label">Hora Check:</dt>
                                <dd class="col-lg-9 col-md-8" id="horaEntrada"><?php echo $asis['checkTime']; ?></dd>
                                <dt class="col-lg-3 col-md-4 label">Fecha Check:</dt>
                                <dd class="col-lg-9 col-md-8" id="fechaEntrada"><?php echo $asis['fechaAsis']; ?></dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>
</main>

</html>
<?php
include("../../../../templates/footer.php");
?>