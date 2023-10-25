<?php
include("../../../connection/conexion.php");
$data = json_decode(file_get_contents("php://input"), true);
$idPac = $data['idPac'];
$secuencia = $con->prepare('SELECT * FROM pacientes_call_center WHERE id_pacientes=:idPac');
$secuencia->bindparam(':idPac', $idPac);
$secuencia->execute();
$datos=$secuencia->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($datos);
?>