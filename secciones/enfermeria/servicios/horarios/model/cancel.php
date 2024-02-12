<?php 
    include('../../../../../connection/conexion.php');

    $id = $_POST['id'];
    
    $sentenciaDel = $con->prepare('UPDATE asignacion_horarios SET statusHorario = 4 WHERE id_asignacionHorarios = :id;');
    $sentenciaDel->bindParam(':id', $id);
    $sentenciaDel->execute()
?>