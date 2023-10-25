<?php
    include("../../../../connection/conexion.php");
    $data = json_decode(file_get_contents('php://input'), true);

    $idPac = $data['idPac'];
    $sentencia = $con->prepare('DELETE * FROM pacientes_call_center WHERE id_pacientes = :idPac');
    $sentencia->bindParam(':idPac', $idPac);
    echo ($sentencia->execute());
?>  