<?php
    include ("../../../connection/conexion.php");
    $sentencia = $con->prepare("SELECT pe.*, CONCAT(po.Nombres, ' ', po.Apellidos) AS 'nomPaciente', po.No_nomina 
    FROM proce_enfer pe, pacientes_oxigeno po
    WHERE pe.pacientes = po.id_pacientes;");
    $sentencia->execute();
    $lista_nomi_paci = $sentencia->fetchAll(PDO::FETCH_ASSOC);





    


