<?php
    include("../../../../connection/conexion.php");
    $datos = json_decode(file_get_contents("php://input"), true);
    $paciente = $datos['idPac'];
    $consultaPaciente=$con->prepare("
        SELECT * FROM pacientes_oxigeno p, genero g WHERE id_pacientes = :pac AND p.Genero=g.id_genero;
    ");
    $consultaPaciente->bindParam(':pac', $paciente);
    $consultaPaciente->execute();
    $datosPaciente=$consultaPaciente->fetchAll(PDO::FETCH_ASSOC);
    $datosPaciente=json_encode($datosPaciente);
    echo $datosPaciente;
?>