<?php 
    include('../../../../../connection/conexion.php');

    $id = $_POST['id'];
    
    $sentenciaDel = $con->prepare('DELETE FROM tipos_servicios WHERE id_tipoServicio=:id;');
    $sentenciaDel->bindParam(':id', $id);

    $sentenciaDel->execute();
?>