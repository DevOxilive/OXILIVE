<?php
$sentencia = $con->prepare("SELECT * FROM `choferes`");
$sentencia->execute();
$lista_choferes = $sentencia->fetchAll(PDO::FETCH_ASSOC);

$se = $con->prepare("SELECT * FROM `choferes` WHERE estado=1");
$se->execute();
$choA = $se->fetchAll(PDO::FETCH_ASSOC);

//Cantidad de choferes activos
$sente = $con->prepare("SELECT COUNT(*) FROM `choferes` WHERE estado = 1");
$sente->execute();
$cantidad_choferes = $sente->fetchColumn();

//Total de choferes
$sente = $con->prepare("SELECT COUNT(*) FROM choferes");
$sente->execute();
$cantidad_chofer = $sente->fetchColumn();
?>  