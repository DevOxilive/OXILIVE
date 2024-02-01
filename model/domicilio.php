<?php
    include('../connection/conexion.php');
    $data = json_decode(file_get_contents('php://input'), true);
    $cp = $data['codigo_postal'];
    $sentenciaCP = $con->prepare('
    SELECT c.*, m.nombre as municipioName, e.nombre as estadoName
    FROM colonias c, municipios m, estados e
    WHERE codigo_postal = :cp
    AND c.municipio = m.id
    AND m.estado = e.id
    ');
    $sentenciaCP -> bindParam(':cp', $cp);
    $sentenciaCP -> execute();
    $datosCP = $sentenciaCP->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($datosCP);