<?php
$fecha_actual = date("m.d.y");

$sentencia=$con->prepare("SELECT * FROM `ruta_diaria_oxigeno`");
$sentencia->execute();
$lista_ruta=$sentencia->fetchAll(PDO::FETCH_ASSOC);

$sen1=$con->prepare("SELECT * FROM `ruta_diaria_oxigeno` WHERE estado=4");
$sen1->execute();
$lista_estado=$sen1->fetchAll(PDO::FETCH_ASSOC);

$sen3=$con->prepare("SELECT COUNT(*) FROM `ruta_diaria_oxigeno` WHERE estado=4");
$sen3->execute();
$canti_rutas=$sen3->fetchColumn();
?>

