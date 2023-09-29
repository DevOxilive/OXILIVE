<?php 
include("../../../connection/conexion.php");
/*Esta consulta es para la lista de lectura para recuperar solo
       la información de los pacientes que contiene cada aseguradora*/
       $sentencia = $con->prepare("SELECT id_pacientes,  Nombre_aseguradora, CONCAT (Nombres, ' ' ,Apellidos) AS 'Nombre'
       FROM pacientes_oxigeno INNER JOIN aseguradoras
       WHERE Aseguradora = id_aseguradora;");   
        $sentencia->execute();
        $vistaLectura = $sentencia->fetchAll(PDO::FETCH_ASSOC);
      
?>
