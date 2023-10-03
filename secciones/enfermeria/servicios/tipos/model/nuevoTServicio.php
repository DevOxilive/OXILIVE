<?php
include('../../../../../connection/conexion.php');

$nomServ = $_POST['nomServ'];
$horasServ = $_POST['horasServ'];
$sueldo = $_POST['sueldo'];

$sentenciaTServicio = $con->prepare('
    INSERT INTO tipos_servicios VALUES (NULL, :nomServ, :horasServ, :sueldo);
    ');
//Se convierten todos estos valores en mayusculas o minusculas (según sea el caso)
//para que quede unificada en la base de datos
    
$nomServ=strtoupper($nomServ);

$sentenciaTServicio->bindParam(':nomServ', $nomServ);
$sentenciaTServicio->bindParam(':horasServ', $horasServ);
$sentenciaTServicio->bindParam(':sueldo', $sueldo);
$sentenciaTServicio->execute();

?>