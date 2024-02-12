<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../../../login.php');
} elseif (isset($_SESSION['us'])) {
    $paciente = $_GET['idPac'];
    include("../../templates/header.php");
    include("../../connection/conexion.php");
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
        <h1>Paciente </h1>
        <?php if ($_SESSION['puesto'] == 11) { ?>
            <nav>
                <br>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo $url_base; 
                                                            ?>secciones/enfermeria/user/index.php">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo $url_base; 
                                                            ?>secciones/enfermeria/user/pages/indexPacientes.php">Pacientes</a></li>
                    <li class="breadcrumb-item active" id="bread"></li>
                </ol>
            </nav>
        <?php } ?>
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

                            <dt class="col-lg-3 col-md-4 label">Género:</dt>
                            <dd class="col-lg-9 col-md-8" id="genero"></dd>

                            <dt class="col-lg-3 col-md-4 label">Edad:</dt>
                            <dd class="col-lg-9 col-md-8" id="edad"></dd>

                            <dt class="col-lg-3 col-md-4 label">Tipo de Paciente:</dt>
                            <dd class="col-lg-9 col-md-8" id="tipoPac"></dd>

                            <dt class="col-lg-3 col-md-4 label">Telefono:</dt>
                            <dd class="col-lg-9 col-md-8" id="telefono"></dd>

                            <dt class="col-lg-3 col-md-4 label" id="telefonoDos-label">Telefono 2:</dt>
                            <dd class="col-lg-9 col-md-8" id="telefonoDos"></dd>

                            <dt class="col-lg-3 col-md-4 label">Expediente N°:</dt>
                            <dd class="col-lg-9 col-md-8" id="expediente"></dd>

                        </dl>
                    </div>
                    <div class="tab-pane fade paciente" id="direccion">
                        <h5 class="card-title">Dirección del domicilio</h5>
                        <dl class="row">
                            <dt class="col-lg-3 col-md-4 label">Calle:</dt>
                            <dd class="col-lg-9 col-md-8" id="calle"></dd>

                            <dt class="col-lg-3 col-md-4 label">N° Exterior:</dt>
                            <dd class="col-lg-9 col-md-8" id="noext"></dd>

                            <dt class="col-lg-3 col-md-4 label" id="noint-label">N° Interior:</dt>
                            <dd class="col-lg-9 col-md-8" id="noint"></dd>

                            <dt class="col-lg-3 col-md-4 label">Colonia:</dt>
                            <dd class="col-lg-9 col-md-8" id="colonia"></dd>

                            <dt class="col-lg-3 col-md-4 label">Código Postal:</dt>
                            <dd class="col-lg-9 col-md-8" id="cp"></dd>

                            <dt class="col-lg-3 col-md-4 label">Delegación/Municipio:</dt>
                            <dd class="col-lg-9 col-md-8" id="delMun"></dd>

                            <dt class="col-lg-3 col-md-4 label">Estado:</dt>
                            <dd class="col-lg-9 col-md-8" id="estadoDir"></dd>

                            <dt class="col-lg-3 col-md-4 label" id="calleUno-label">Entre calle:</dt>
                            <dd class="col-lg-9 col-md-8" id="calleUno"></dd>

                            <dt class="col-lg-3 col-md-4 label" id="calleDos-label">Y calle:</dt>
                            <dd class="col-lg-9 col-md-8" id="calleDos"></dd>

                            <dt class="col-lg-3 col-md-4 label" id="referencias-label">Referencias:</dt>
                            <dd class="col-lg-9 col-md-8" id="referencias"></dd>

                        </dl>
                    </div>
                    <div class="tab-pane fade paciente" id="diagnostico">
                        <h5 class="card-title">Diagnóstico</h5>
                        <dl class="row">
                            <dt class="col-lg-3 col-md-4 label">Por definir datos</dt>
                            <dd class="col-lg-9 col-md-8" id=""></dd>

                        </dl>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" id="idPaciente" value="<?php echo $paciente; ?>">
        <input type="hidden" id="puesto" value="<?php echo $_SESSION['puesto']; ?>">
</main>

</html>
<script src="js/paciente.js"></script>
<?php
include('../../templates/footer.php');
?>