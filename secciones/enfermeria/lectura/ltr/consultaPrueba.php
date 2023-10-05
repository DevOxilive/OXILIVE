<?php 
include("../../../connection/conexion.php");

 $txtID = $_GET['txtID'];
 $sen = $con->prepare("SELECT id_pacientes, Nombres, Apellidos, Genero,Edad,calle,rfc,No_nomina,responsable, Aseguradora, id_aseguradora,  Nombre_aseguradora
 FROM pacientes_oxigeno INNER JOIN aseguradoras
 WHERE id_pacientes = :id_pacientes
 AND Aseguradora = id_aseguradora;");
 $sen->bindParam(":id_pacientes", $txtID);
 $sen->execute();
 $id_lista = $sen->fetchAll(PDO::FETCH_ASSOC); 


?>