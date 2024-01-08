<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../../../login.php');
} elseif (isset($_SESSION['us'])) {
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
    <link rel="stylesheet" href="<?php echo $url_base; ?>secciones/enfermeria/user/css/horarios.css">
</head>
<main id="main" class="main">
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Lista de Horarios</h3>
                <div class="breadcrumb-box">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo $url_base; ?>secciones/enfermeria/user/index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Horario</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    
</main>

</html>
<script src="../js/indexHorario.js"></script>
<script src="../js/statusHorario.js"></script>
<script src="../../../../js/tables.js"></script>

<?php
include("../../../../templates/footer.php");
?>