<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../../login.php');
} elseif (isset($_SESSION['us'])) {
    include '../../../connection/conexion.php';
    include("../../../templates/header.php");
    echo '<link rel="stylesheet" href="css/probar.css">';
} else {
    // esto queda pendiente para mostrar una mejor vista al usuario y no se confunca sobre esto...
    echo "Error en el sistema";
}
?>
<main id="main" class="main">
    <div id="mostrarArribo" class="row">
        <!-- aqui se muestra la tabla del arribo -->
    </div>
</main>
<script src="js/arribo.js"></script>

<?php
include("../../../templates/footer.php");
?>