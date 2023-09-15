<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../../../../login.php');
} elseif (isset($_SESSION['us'])){
    include("../../../../templates/header.php");
    include("../../../../connection/conexion.php");
    include("../../../../module/genero.php");
    include("../../../../module/estado.php");
    
} else {
    echo "Error en el sistema";
}
?>

<!DOCTYPE html>

<head>
    <link rel="stylesheet" href="<?php echo $url_base; ?>assets/css/foto_perfil.css">
    <link rel="stylesheet" href="<?php echo $url_base; ?>assets/css/edit.css">
    <link rel="stylesheet" href="<?php //echo $url_base; ?>assets/css/fotoAsis.css">
</head>
<main id="main" class="main">
    <section class="section dashboard">
    </section>
</main>
</html>    