<?php 
include("../../../connection/url.php");
$servicio = $con->prepare("SELECT * FROM asignacion_servicio LIMIT 1");
$servicio->execute();
$ltServicio = $servicio->fetchAll(PDO::FETCH_ASSOC); 

?>