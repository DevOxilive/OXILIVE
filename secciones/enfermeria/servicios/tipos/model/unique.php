<?php
include("../../../../../connection/conexion.php");
$data = json_decode(file_get_contents('php://input'), true);
$nom = $data['nomServ'];
$nom = strtoupper($nom);

$sentencia = $con->prepare('SELECT COUNT(id_tipoServicio) as cont FROM tipos_servicios WHERE nombreServicio LIKE :nom');
$sentencia->bindParam(':nom', $nom);
$sentencia->execute();
$cont = $sentencia->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($cont);
?>