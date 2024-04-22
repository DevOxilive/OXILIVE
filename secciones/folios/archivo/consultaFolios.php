<?php

use SebastianBergmann\Environment\Console;

include("../../../connection/conexion.php");
//Esta consulta es para el index
$sentencia=$con->prepare("SELECT fs.*, f.estatus
FROM folios fs,folio_estatus f 
WHERE fs.estado = f.id_estatus 
AND fs.estado != 4");
$sentencia->execute();
$listaArchivoFolio=$sentencia->fetchAll(PDO::FETCH_ASSOC);

//Consulta para traerme los bancos
$bancos = $con->prepare("SELECT DISTINCT(bancoFolio) FROM folios;"); 
$bancos->execute();
$listafolio=$bancos->fetchAll(PDO::FETCH_ASSOC);

//Consulta para el motivo de devolución
$sen=$con->prepare("SELECT fe.* FROM folio_estatus fe
WHERE fe.id_estatus IN (4, 10)");
$sen->execute();
$listMotivos=$sen->fetchAll(PDO::FETCH_ASSOC);

//Aquí va la consulta del ajax
$selectedBanco = $_POST['banco'];
$traerFolios = $con->prepare("SELECT * FROM folios 
WHERE estado != 4
AND bancoFolio = :banco");
$traerFolios->bindParam(':banco', $selectedBanco);
$traerFolios->execute();

$folios = $traerFolios->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($folios);


//Consulta para el filtro




?>