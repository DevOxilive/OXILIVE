<?php

include("../../../../connection/conexion.php");

// consulta para la vista de la tabla
$sentenciaReg = $con->prepare(

    'SELECT *
    FROM registro_bitacora
    '
    
);

$sentenciaReg->execute();
$lista_bitacora = $sentenciaReg->fetchAll(PDO::FETCH_ASSOC);





?>
