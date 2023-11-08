<?php
$datos = json_decode(file_get_contents("php://input"), true);
$paciente = isset($datos['idPac']) ? $datos['idPac'] : "";
include("../../../connection/conexion.php");
$consultaPaciente = $con->prepare("
        SELECT p.*, g.genero AS genName, t.tipoPaciente AS tipoName, c.nombre AS colName, c.codigo_postal, m.nombre AS munName, e.nombre AS estName
        FROM pacientes_call_center p, genero g, colonias c, municipios m, estados e, tipo_paciente t
        WHERE id_pacientes = :pac
        AND p.genero = g.id_genero
        AND p.tipoPaciente = t.id_tipoPaciente
        AND p.colonia = c.id
        AND c.municipio = m.id
        AND m.estado = e.id;
        ");
$consultaPaciente->bindParam(':pac', $paciente);
$consultaPaciente->execute();
$datosPaciente = $consultaPaciente->fetchAll(PDO::FETCH_ASSOC);
$datosPaciente = json_encode($datosPaciente);
echo $datosPaciente;
?>
