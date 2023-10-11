<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../../../login.php');
} elseif (isset($_SESSION['us'])) {
    $paciente = $_GET['idPac'];
    include("../../../../templates/header.php");
    include("../../../../connection/conexion.php");
} else {
    echo "Error en el sistema";
}
?>
<!DOCTYPE html>

<head>
    <link rel="stylesheet" href="<?php echo $url_base; ?>assets/css/foto_perfil.css">
    <link rel="stylesheet" href="<?php echo $url_base; ?>assets/css/edit.css">
</head>
<main id="main" clas="main">
    <div class="pagetitle">
        <h1>Paciente </h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo $url_base; ?>secciones/enfermeria/user/index.php">Dashboard</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <div>
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs nav-tabs-bordered">
                    <li class="nav-item">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#general">General</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#direccion">Dirección</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#diagnostico">Diagnóstico</button>
                    </li>
                </ul>
                <div class="tab-content pt-2">
                    <div class="tab-pane fade show active paciente" id="general">
                        <h5 class="card-title">Datos generales</h5>
                        <dl class="row">
                            <dt class="col-lg-3 col-md-4 label">Nombre(s):</dt>
                            <dd class="col-lg-9 col-md-8" id="nombre"></dd>

                            <dt class="col-lg-3 col-md-4 label">Apellidos:</dt>
                            <dd class="col-lg-9 col-md-8" id="apellidos"></dd>
                            
                            <dt class="col-lg-3 col-md-4 label">RFC:</dt>
                            <dd class="col-lg-9 col-md-8" id="rfc"></dd>

                            <dt class="col-lg-3 col-md-4 label">Aseguradora:</dt>
                            <dd class="col-lg-9 col-md-8" id="rfc"></dd>

                            
                        </dl>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" id="idPaciente" value="<?php echo $paciente; ?>">
</main>

</html>
<script src="../js/paciente.js"></script>
<?php
include('../../../../templates/footer.php');
?>