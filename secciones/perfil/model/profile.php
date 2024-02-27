<?php
$idus = $_GET['idus'];
$stmt = $con->prepare(
    "SELECT *
    FROM empleados e, usuarios u
    WHERE e.usuarioSistema = u.id_usuarios
    AND u.id_usuarios = :idus"
);
$stmt->bindParam(":idus", $idus);
$stmt->execute();
$datos_usuario = $stmt->fetchAll(PDO::FETCH_ASSOC);