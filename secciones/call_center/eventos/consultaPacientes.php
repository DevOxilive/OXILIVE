<?php
include("../../../connection/conexion.php");

// Obtener el ID del paciente 
$pacienteId = $_GET['idPac'];   

    // Consulta para obtener los detalles del paciente utilizando el ID almacenado en la variable de sesión
    $consulta = "SELECT P.*, C.codigo_postal, C.nombre AS nombre_colonia, C.ciudad, M.nombre AS nombre_municipio, E.nombre AS nombre_estado, G.genero, T.tipoPaciente 
    FROM pacientes_call_center P, colonias C, municipios M, estados E, genero G, tipo_paciente T
    WHERE G.id_genero = P.genero
    AND T.id_tipoPaciente = P.tipoPaciente
    AND C.id = P.colonia
    AND M.id = C.municipio
    AND E.id = M.estado
    AND P.id_pacientes = :id_pacientes;
    ";
    
    $sentencia = $con->prepare($consulta);
    $sentencia->bindParam(':id_pacientes', $pacienteId);
    $sentencia->execute();
    $datos_paciente = $sentencia->fetchAll(PDO::FETCH_ASSOC);

?>