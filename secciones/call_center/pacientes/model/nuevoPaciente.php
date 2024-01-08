<?php
include("../../../../connection/conexion.php");
include_once '../../../../templates/hea.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombres = isset($_POST['nombre']) ? $_POST['nombre'] : ""; 
    $apellido = isset($_POST['apellidos']) ? $_POST['apellidos'] : "";
    $genero = isset($_POST['genero']) ? $_POST['genero'] : "";
    $edad = isset($_POST['edad']) ? $_POST['edad'] : "";
    $tipoPaciente = isset($_POST['tipoPaciente']) ? $_POST['tipoPaciente'] : NULL;
    $telUno = isset($_POST['telUno']) ? $_POST['telUno'] : "";
    $telDos = isset($_POST['telDos']) ? $_POST['telDos'] : NULL;
    $colonia = isset($_POST['colonia']) ? $_POST['colonia'] : "";
    $calle = isset($_POST['calle']) ? $_POST['calle'] : ""; 
    $num_ext = isset($_POST['numExt']) ? $_POST['numExt'] : "";
    $num_int = isset($_POST['numInt']) ? $_POST['numInt'] : NULL;
    $calleUno = isset($_POST['calleUno']) ? $_POST['calleUno'] : NULL;
    $calleDos = isset($_POST['calleDos']) ? $_POST['calleDos'] : null;
    $referencias = isset($_POST['referencias']) ? $_POST['referencias'] : NULL;
    $banco = isset($_POST['banco']) ? $_POST['banco'] : "";
    $expediente = isset($_POST['expediente']) ? $_POST['expediente'] : "";
        $consulta = $con->prepare("INSERT INTO pacientes_call_center (nombres, apellidos, genero, edad, tipoPaciente, telefono,
        telefonoDos, colonia, calle, num_ext, num_int,calleUno,calleDos,referencias,bancosAdmi,no_expediente) VALUES 
        (:nom, :ape, :genero, :edad, :tipoPaciente, :telUno, :telDos, :colonia, :calle, :num_ext, :num_int,:calleUno,:calleDos, :referencia,:banco,:expediente)");
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
        $consulta->bindParam(":expediente",$expediente);
        $consulta->execute();
        echo '<script language="javascript"> ';
        echo 'Swal.fire({
                icon: "success",
                title: "PACIENTE CREADO CORRECTAMENTE",
                showConfirmButton: false,
                timer: 1500,
            }).then(function() {
                window.location = "../index.php";
                });';
        echo '</script>';
    }
?>
