<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../templates/header.php");
} else {
    echo "Error en el sistema";
}
include("../../templates/404.php");
include("../../templates/footer.php");
?>