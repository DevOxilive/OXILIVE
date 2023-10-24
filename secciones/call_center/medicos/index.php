<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");
    // Obtener o inicializar el estado de la consulta desde la sesión
    $id = $_SESSION['idus'];
} else {
    echo "Error en el sistema";
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="<?php echo $url_base; ?>assets/css/foto_perfil.css">
    <link rel="stylesheet" href="<?php echo $url_base; ?>assets/css/edit.css">
</head>
<body>
    <main id="main" class="main">
    <div class="container">
        <div class="row">
            <div class="col-12">
                 <div class="mostrarServicios"  >
                    <!-- aqui se imprime el servicio -->
                 </div>
            </div>
        </div>
       
    </div>
    </main>
    <?php
    include("../../../templates/footer.php");
    ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <script src="js/mostrarServicios.js"></script>
</body>

</html>