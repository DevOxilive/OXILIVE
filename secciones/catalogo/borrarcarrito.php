<?php
session_start();

include("../../connection/conexion.php"); 

// Obtén el ID del usuario actual de la sesión
$idUsuario = $_SESSION['us']['id_usuarios'];

$query = "DELETE FROM carrito WHERE id_usuario = :idUsuario";
$stmt = $con->prepare($query);
$stmt->bindValue(':idUsuario', $idUsuario, PDO::PARAM_INT);
$stmt->execute();

$_SESSION['carrito'] = array();

echo "success"; 
?>
