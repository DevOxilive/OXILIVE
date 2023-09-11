<?php
$sentencia=$con->prepare("SELECT * FROM `ruta_diaria_oxigeno`");
$sentencia->execute();
$lista_ruta=$sentencia->fetchAll(PDO::FETCH_ASSOC);

//CONSULTA ADMINISTRADORA USUARIO
$consulta = "
SELECT rd.*
FROM ruta_diaria_oxigeno rd
JOIN aseguradoras a ON rd.Aseguradora = a.id_aseguradora
JOIN administradora ad ON a.administradora = ad.id_administradora
";
$sen = $con->prepare($consulta);
$sen->execute();
$pacientes = $sen->fetchAll(PDO::FETCH_ASSOC);

//CUENTA LA CANTIDAD DE PACIENTES QUE HAY
$sente = $con->prepare("SELECT COUNT(*) FROM pacientes_oxigeno");
$sente->execute();
$cantidad_pacien = $sente->fetchColumn();

//ESTE FRAGMENTO ES UNA CONSULTA PARA VER LAS RUTAS DEL DIA, ES DECIR MUESTRA EN EL DASHBOARD LA CANTIDAD DE RUTAS ACTUALES, SOLO APLICA A LA VISTA DEL COORDINADOR DE OXIGENO.
date_default_timezone_set('America/Mexico_City'); 
$fechaActual = date("Y-m-d"); 
$sen3 = $con->prepare("SELECT COUNT(*) FROM `ruta_diaria_oxigeno` WHERE estado != 3 AND Fecha_agenda = :fechaActual");
$sen3->bindParam(':fechaActual', $fechaActual);
$sen3->execute();
$canti_rutas = $sen3->fetchColumn();

//PARA SABER CUANTAS RUTAS DE RECOLECCION DE FIRMAS SE HACE SEGUN EL DIA QUE ES
$fechaActual = date("Y-m-d"); 
$sen4 = $con->prepare("SELECT COUNT(*) FROM `ruta_diaria_oxigeno` WHERE estado = 2 AND Fecha_agenda = :fechaActual");
$sen4->bindParam(':fechaActual', $fechaActual);
$sen4->execute();
$ru_firma = $sen4->fetchColumn();

//PARA SABER CUANTAS RUTAS DE ENTREGA SE HACEN SEGUN EL DIA
$fechaActual = date("Y-m-d"); 
$sen5 = $con->prepare("SELECT COUNT(*) FROM `ruta_diaria_oxigeno` WHERE estado = 1 AND Fecha_agenda = :fechaActual");
$sen5->bindParam(':fechaActual', $fechaActual);
$sen5->execute();
$ru_entrega = $sen5->fetchColumn();
?>