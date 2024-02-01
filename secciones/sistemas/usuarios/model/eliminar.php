<?php
include("../../../../connection/conexion.php");
try {
    $id = $_POST['id'];
    $sentUpp = $con->prepare("UPDATE empleados SET usuarioSistema = NULL WHERE usuarioSistema = :id");
    $sentUpp->bindParam(":id", $id);
    $sentUpp->execute();
    $sentDel = $con->prepare("DELETE FROM usuarios WHERE id_usuarios = :id ");
    $sentDel->bindParam(":id", $id);
    $sentDel->execute();
    $respuesta1 = $sentDel->fetch();
    $respuesta2 = $sentUpp->fetch();
    echo true;
} catch (Exception $e) {
    echo false;
}
