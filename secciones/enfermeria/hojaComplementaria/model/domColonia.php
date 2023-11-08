<?php
include("../../../../connection/conexion.php");
$data = json_decode(file_get_contents('php://input'), true);
$col = $data['col'];
$sentenciaDomEdit = $con->prepare('
SELECT c.*, m.nombre as munName, e.nombre as estName
FROM colonias c, estados e, municipios m
WHERE c.id = :col AND c.municipio=m.id AND m.estado=e.id');
$sentenciaDomEdit->bindparam(':col', $col);
$sentenciaDomEdit->execute();
$datosCol = $sentenciaDomEdit->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($datosCol);
?>