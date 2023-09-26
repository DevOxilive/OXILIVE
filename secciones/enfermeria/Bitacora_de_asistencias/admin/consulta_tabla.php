<?php

include("../../../../connection/conexion.php");

$sentenciaReg = $con->prepare(

    'SELECT *
    FROM usuarios U
    INNER JOIN registro_bitacora R ON U.id_usuarios = R.id_usuario
    INNER JOIN asistencias A_checkIn ON U.id_usuarios = A_checkIn.id_empleadoEnfermeria 
    AND R.id_checkIn = A_checkIn.id_asistencias;
    '
    
);

$sentenciaReg->execute();
$lista_bitacora = $sentenciaReg->fetchAll(PDO::FETCH_ASSOC);


?>
