<?php
include_once '../../connection/conexion.php';

if (isset($_GET['id'])) {
    $id_notificacion = $_GET['id'];
    $sql = "UPDATE notificaciones SET leida = 1 WHERE id = :id";
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':id', $id_notificacion, PDO::PARAM_INT);
    $stmt->execute();
}
header("Location: ../../index.php");
exit();
?>