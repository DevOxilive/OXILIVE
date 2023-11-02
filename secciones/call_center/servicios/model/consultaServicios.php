<?php
include("../../../connection/conexion.php");
// realiza la consulta que traerá los valores de la base de datos 
   $sentencia=$con->prepare("SELECT * FROM tipos_servicios_callcenter");
   $sentencia->execute();
   $serviciosCallcenter=$sentencia->fetchAll(PDO::FETCH_ASSOC);

?>