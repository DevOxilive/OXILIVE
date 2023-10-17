<?php
include ("../../../connection/conexion.php");

if (isset($_POST['query'])) {
    $inpText = $_POST['query'];
    $sql = 'SELECT Apellidos, Nombres, id_pacientes FROM pacientes_oxigeno WHERE Apellidos LIKE :search OR Nombres LIKE :search';
    $stmt = $con->prepare($sql);
    $stmt->execute(['search' => '%' . $inpText . '%']);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($result) {
        // Devolver los datos como un objeto JSON
        echo json_encode($result);
    } else {
        // Devolver un mensaje de error si el paciente no fue encontrado
        echo json_encode(array("error" => "Paciente no encontrado o no registrado"));
    }
}



?>
