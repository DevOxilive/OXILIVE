<?php 
include ("../../../connection/conexion.php");
$us = $_SESSION['us'];
$consulta = "
    SELECT pacientes.*, aseguradoras.Nombre_aseguradora
    FROM pacientes_oxigeno AS pacientes
    JOIN administradora AS admin ON pacientes.Administradora = admin.id_administradora
    JOIN aseguradoras ON pacientes.Aseguradora = aseguradoras.id_aseguradora
    WHERE admin.Nombre_administradora = :us
";
$sentencia = $con->prepare($consulta);
$sentencia->bindParam(":us", $us);
$sentencia->execute();
$pacientes = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>