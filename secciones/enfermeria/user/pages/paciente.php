<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../../../login.php');
} elseif (isset($_SESSION['us'])) {
    $paciente=$_GET['idPac'];
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
    
    <input type="hidden" id="idPaciente" value="<?php echo $paciente; ?>">
</main>

</html>
<script src="../js/paciente.js"></script>
<?php
include('../../../../templates/footer.php');
?>