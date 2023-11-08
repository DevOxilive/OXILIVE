<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../../../../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../../../templates/header.php");
    include("../../../../../connection/conexion.php");
} else {
    echo "Error en el sistema";
}
?>
<!DOCTYPE html>

<head>

</head>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Servicios</h1>
    </div>
    <div class="row">
       
    </div>

</main>

</html>
<?php
include("../../../../../templates/footer.php");
?>