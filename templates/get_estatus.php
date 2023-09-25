<?php
include_once('../connection/conexion.php');
session_start();

$consultaStatus= $con->prepare("SELECT Estado FROM usuarios WHERE id_usuario = :iduser;");
$iduser = $_SESSION['idus'];
$consultaStatus->bindParam(':iduser', $iduser);
$consultaStatus->execute();
$newEstado = $consultaStatus->fetchAll(PDO::FETCH_ASSOC);

// Lógica para obtener el estatus actual del usuario // Puedes obtener este valor de tu base de datos o de donde sea necesario

// Devolver el estatus como JSON
$response = array("estatus" => $newEstado);
header("Content-Type: application/json");
echo json_encode($response);
?>