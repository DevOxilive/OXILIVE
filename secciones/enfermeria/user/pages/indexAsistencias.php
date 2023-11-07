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
<html lang="en">

<head>
    <link rel="stylesheet" href="<?php echo $url_base; ?>assets/css/foto_perfil.css">
    <link rel="stylesheet" href="<?php echo $url_base; ?>assets/css/edit.css">
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
        <div class="row">
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Check In</h5>
                        <div class="row align-items-center">
                            <img src="" alt="">
                        </div>
                                                
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Datos Generales</h5>
                        <dl class="row">
                            <dt class="col-lg-3 col-md-4 label">Paciente:</dt>
                            <dd class="col-lg-9 col-md-8" id="paciente">asdasda</dd>
                            <dt class="col-lg-3 col-md-4 label">Hora Check:</dt>
                            <dd class="col-lg-9 col-md-8" id="horaEntrada">asdasda</dd>
                            <dt class="col-lg-3 col-md-4 label">Fecha Check:</dt>
                            <dd class="col-lg-9 col-md-8" id="fechaEntrada">asdasdas</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

</html>
<?php
include("../../../../templates/footer.php");
?>