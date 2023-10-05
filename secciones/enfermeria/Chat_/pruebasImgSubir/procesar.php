<?php
include '../../../../connection/conexion.php';


$img = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
$id_persona = $_POST['id'];
$subir = $con->prepare("UPDATE usuarios SET Foto_perfil = '$img' WHERE id_usuarios = '$id_persona'");
$subir->execute();
    
