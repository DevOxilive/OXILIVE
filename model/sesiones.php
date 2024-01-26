<?php
include_once 'C:\laragon\www\OXILIVE\connection/conexion.php';
if (isset($_SESSION["us"])) {
    $us = $_SESSION["us"];
    try {
        $canIni = "SELECT inicios_sesion FROM usuarios WHERE Usuario = :us";
        $cuentIni = $con->prepare($canIni);
        $cuentIni->bindParam(":us", $us);
        $cuentIni->execute();
        $num_inicios_sesion = $cuentIni->fetchColumn();
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}
?>