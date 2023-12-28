<?php
$url_base = 'https://prueba.oxilive.com.mx/';
// $url_base = 'http://localhost:8080/OXILIVE2.0/';
session_start();
if (isset($_SESSION["us"])) {
    include 'baseDatos.php';
    ?>    
    <h1>Bienvenido <?php  echo $_SESSION['us']?></h1>
    <?php
} else {
    header('location: '. $url_base .'login.php');
}

