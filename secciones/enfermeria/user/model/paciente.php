<?php
    session_start();
    $datos = json_decode(file_get_contents("php://input"), true);
    $paciente = isset($datos['idPac']) ? $datos['idPac'] : "";
    if($paciente != "" || $paciente != null){
        include("../../../../connection/conexion.php");
        $consultaPaciente=$con->prepare("
            SELECT * FROM pacientes_oxigeno p, genero g WHERE id_pacientes = :pac AND p.Genero=g.id_genero;
        ");
        $consultaPaciente->bindParam(':pac', $paciente);
        $consultaPaciente->execute();
        $datosPaciente=$consultaPaciente->fetchAll(PDO::FETCH_ASSOC);
        $datosPaciente=json_encode($datosPaciente);
        echo $datosPaciente;
    } else {
        $idUs = $_SESSION['idus'];
        $consultaPaciente=$con->prepare("
            SELECT DISTINCT p.Nombres, p.Apellidos, p.id_pacientes
            FROM pacientes_oxigeno p, asignacion_horarios a
            WHERE a.id_usuario = :idus
            AND a.id_pacienteEnfermeria = p.id_pacientes
        ");
        $consultaPaciente->bindParam(':idus', $idUs);
        $consultaPaciente->execute();
        $datosPaciente=$consultaPaciente->fetchAll(PDO::FETCH_ASSOC);
    }
?>