<?php
include("../../../../connection/conexion.php");
$data = json_decode(file_get_contents('php://input'), true);

$nombres = $data['nombres'];
$apellido = $data['apellidos'];
$genero = $data['genero'];
$edad = $data['edad'];
$tipoPaciente = $data['tipo'];
$telUno = $data['telUno'];
$telDos = isset($data['telDos']) ? $data['telDos'] : NULL;
$colonia = $data['colonia'];
$calle = $data['calle'];
$num_ext = $data['numExt'];
$num_int = isset($data['numInt']) ? $data['numInt'] : NULL;
$calleUno = isset($data['calleUno']) ? $data['calleUno'] : NULL;
$calleDos = isset($data['calleDos']) ? $data['calleDos'] : null;
$referencias = isset($data['referencias']) ? $data['referencias'] : NULL;
$banco = $data['banco'];
$expediente = $data['expediente'];


$nombres = strtoupper($nombres);
$apellido = strtoupper($apellido);
$calle = strtoupper($calle);
if ($calleUno != NULL) {
    $calleUno = strtoupper($calleUno);
}
if ($calleDos != NULL) {
    $calleDos = strtoupper($calleDos);
}
if ($referencias != NULL) {
    $referencias = strtoupper($referencias);
}


$consulta = $con->prepare("
INSERT INTO pacientes_call_center 
(nombres, apellidos, genero, edad, tipoPaciente, telefono, telefonoDos, colonia, calle, num_ext, num_int, calleUno, calleDos, referencias, bancosAdmi, No_nomina)
VALUES 
(:nom, :ape, :genero, :edad, :tipoPaciente, :telUno, :telDos, :colonia, :calle, :num_ext, :num_int, :calleUno, :calleDos, :referencia, :banco, :expediente)
");

$consulta->bindParam(":nom", $nombres);
$consulta->bindParam(":ape", $apellido);
$consulta->bindParam(":genero", $genero);
$consulta->bindParam(":edad", $edad);
$consulta->bindParam(":tipoPaciente", $tipoPaciente);
$consulta->bindParam(":telUno", $telUno);
$consulta->bindParam(":telDos", $telDos);
$consulta->bindParam(":colonia", $colonia);
$consulta->bindParam(":calle", $calle);
$consulta->bindParam(":num_ext", $num_ext);
$consulta->bindParam(":num_int", $num_int);
$consulta->bindParam(":calleUno", $calleUno);
$consulta->bindParam(":calleDos", $calleDos);
$consulta->bindParam(":referencia", $referencias);
$consulta->bindParam(":banco", $banco);
$consulta->bindParam(":expediente", $expediente);


if ($consulta->execute()) {
    echo json_encode(true);
}

?>