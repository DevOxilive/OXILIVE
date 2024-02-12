<?php
include("../../../../connection/conexion.php");
$data = json_decode(file_get_contents('php://input'), true);
if(!empty($data['text'])){
    $inpText = $data['text'];
    $sql = 'SELECT CONCAT(nombres, " ", apellidos) nomComp, id_pacientes FROM pacientes_call_center WHERE apellidos LIKE :search OR nombres LIKE :search';
    $stmt = $con->prepare($sql);
    $stmt->execute(['search' => '%' . $inpText . '%']);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
} else {
    echo json_encode('');
} 
?>