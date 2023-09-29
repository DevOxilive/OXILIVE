<?php
include('../../../../../connection/conexion.php');

$nomServ = $_POST['nombreServicio'];
$horasServicio = $_POST['horasServicio'];
$sueldo = $_POST['sueldo'];

$sentenciaTServicio = $con->prepare('
    INSERT INTO tipos_servicios VALUES (NULL, :nomServ, :horasServicio, :sueldo);
    ');
//Se convierten todos estos valores en mayusculas o minusculas (según sea el caso)
//para que quede unificada en la base de datos
    
$nomServ=strtoupper($nomServ);

$sentenciaTServicio->bindParam(':nomServ', $nomServ);
$sentenciaTServicio->bindParam(':horasServicio', $horasServicio);
$sentenciaTServicio->bindParam(':sueldo', $sueldo);
$sentenciaTServicio->execute();
?>