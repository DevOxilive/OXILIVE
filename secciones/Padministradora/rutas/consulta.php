<?php
$sentencia=$con->prepare("SELECT * FROM `ruta_diaria_oxigeno`");
$sentencia->execute();
$lista_ruta=$sentencia->fetchAll(PDO::FETCH_ASSOC);

//CONSULTA ADMINISTRADORA USUARIO
$us = $_SESSION['us'];
$consulta = "
SELECT rd.*
FROM ruta_diaria_oxigeno rd
JOIN aseguradoras a ON rd.Aseguradora = a.id_aseguradora
JOIN administradora ad ON a.administradora = ad.id_administradora
WHERE ad.Nombre_administradora = :us
";
$sen = $con->prepare($consulta);
$sen->bindParam(":us", $us);
$sen->execute();
$pacientes = $sen->fetchAll(PDO::FETCH_ASSOC);

$sente = $con->prepare("SELECT COUNT(*)
FROM pacientes_oxigeno rd
JOIN aseguradoras a ON rd.Aseguradora = a.id_aseguradora
JOIN administradora ad ON a.administradora = ad.id_administradora
WHERE ad.Nombre_administradora = :us");
$sente->bindParam(":us", $us);
$sente->execute();
$cantidad_pacien = $sente->fetchColumn();
?>