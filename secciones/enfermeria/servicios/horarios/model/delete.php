<?php 
    include('../../../../../connection/conexion.php');

    $id = $_POST['id'];
    
    $sentenciaDel = $con->prepare('DELETE FROM asignacion_horarios WHERE id_asignacionHorarios=:id;');
    $sentenciaDel->bindParam(':id', $id);

    $sentenciaDel->execute();
?>