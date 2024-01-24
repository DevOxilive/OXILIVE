<?php
include("../../../connection/url.php");
include("../../../templates/hea.php");
include("../../../connection/conexion.php");
include("../../../ctrlArchivos/control/Archivero.php");
$archivero = new Archivero();

// comprobación de envío de valores por método POST.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombres = (isset($_POST["nombres"]) ? $_POST["nombres"] : "");
    $apellidos = (isset($_POST["apellidos"]) ? $_POST["apellidos"] : "");
    $genero = (isset($_POST["genero"]) ? $_POST["genero"] : "");
    $telefono = (isset($_POST["telefono"]) ? $_POST["telefono"] : "");
    $correo = (isset($_POST["email"]) ? $_POST["email"] : NULL);
    $curp = (isset($_POST["curp"]) ? $_POST["curp"] : "");
    $rfc = (isset($_POST["rfc"]) ? $_POST["rfc"] : "");
    $departamento = (isset($_POST["departamento"]) ? $_POST["departamento"] : null);
    $calle = (isset($_POST["calle"]) ? $_POST["calle"] : "");
    $numExt = (isset($_POST["numExt"]) ? $_POST["numExt"] : "");
    $numInt = (isset($_POST["numInt"]) ? $_POST["numInt"] : "");
    $colonia = (isset($_POST['colonia']) ? $_POST['colonia'] : null);
    $calleUno = (isset($_POST['calleUno']) ? $_POST['calleUno'] : null);
    $calleDos = (isset($_POST['calleDos']) ? $_POST['calleDos'] : null);
    $referencias = (isset($_POST['referencias']) ? $_POST['referencias'] : null);
    //Los anteriores ya se insertan
    $doc[] = $_FILES['cuenta']['name'];
    //Contenido del file
    $contenido[] = $_FILES['cuenta']['tmp_name'];

    //mayuscula o minuscula según sea el caso 
    $nombres = strtolower($nombres);
    $curp = strtoupper($curp);
    //comprobar errores de creacion de la carpeta del usuario nuevo.
    $carpetaNueva = "OXILIVE/" . $curp . " " . $nombres;
    $solicitud1 = $archivero->crearCarpeta("OXILIVE/", $curp . " " . $nombres);
    echo $solicitud1;
    if ($solicitud1 === true) {
        //Sale aquì sigue la comprobaciòn
        if ($_FILES["cuenta"]['error'] !== 4) {
            $cuenta = $url_base . "secciones/" . $carpetaNueva . $_FILES['cuenta']['name'];
        } else {
            $cuenta = $url_base . "secciones/chatNotifica/img/usuario.png";
        }

        echo "<br>";
        for ($i = 0; $i < count($contenido); $i++) {
            $respuestas[] = $archivero->guardarArchivo($doc[$i], $contenido[$i], $carpetaNueva) . "<br>";
        }
        for ($i = 0; $i < count($respuestas); $i++) {
            if ($respuestas[$i] === false) {
                $permitir = false;
                break;
            }
            $permitir = true;
        }
        // // Verificar si los campos esenciales tienen valores antes de la inserción
        if ($permitir === true) {
            echo "ya quedo XD";

            $sentencia = $con->prepare("INSERT INTO empleados (nombres, apellidos, genero, telefonoUno,telefonoDos, correo, curp, rfc, departamento,calle, numExt,numInt, colonia,calleUno,calleDos,referenciasDireccion,numCuenta) VALUES (:nombres, :apellidos, :genero, :telefonoUno, :telefonoDos, :correo, :curp, :rfc, :departamento,:calle,:numExt,:numInt,:colonia,:calleUno,:calleDos,:referencias,'$cuenta')");
            $sentencia->bindParam(":nombres", $nombres);
            $sentencia->bindParam(":apellidos", $apellidos);
            $sentencia->bindParam(":genero", $genero);
            $sentencia->bindParam(":telefonoUno", $telefono);
            $sentencia->bindParam(":telefonoDos", $telefDos);
            $sentencia->bindParam(":correo", $correo);
            $sentencia->bindParam(":curp", $curp);
            $sentencia->bindParam(":rfc", $rfc);
            $sentencia->bindParam(":departamento", $departamento);
            $sentencia->bindParam(":calle", $calle);
            $sentencia->bindParam(":numExt", $numExt);
            $sentencia->bindParam(":numInt", $numInt);
            $sentencia->bindParam(":colonia", $colonia);
            $sentencia->bindParam(":calleUno", $calleUno);
            $sentencia->bindParam(":calleDos", $calleDos);
            $sentencia->bindParam(":referencias", $referencias);
            $sentencia->execute();

         
            // Verificar si el usuario ya existe
            $verificar_usuario = $con->prepare("SELECT COUNT(*) FROM empleados WHERE curp = :curp");
            $verificar_usuario->bindParam(":curp", $curp);
            $verificar_usuario->execute();
            $existe_usuario = $verificar_usuario->fetchColumn();
            
            if ($existe_usuario) {
                echo '<script language="javascript"> ';
                echo 'Swal.fire({
                icon: "error",
                title: "ERROR",
                text: "El usuario ya existe",
                showConfirmButton: false,
                timer: 2000,
            }).then(function() {
                window.location = "./index.php";
            });';
                echo '</script>';
            } else {
                $sentencia->bindParam(":departamento", $departamento);
                $sentencia->execute();
                echo '<script language="javascript"> ';
                echo 'Swal.fire({
                                icon: "success",
                                title: "USUARIO AGREGADO",
                                text: "Los datos fueron guardados",
                                showConfirmButton: false,
                                timer: 2000,
                            }).then(function() {
                                window.location = "./index.php";
                            });';
                echo '</script>';
            }
        } else {
            $archivero->eliminarCarpeta($carpetaNueva);
            echo '<script language="javascript"> ';
            echo 'Swal.fire({
            icon: "error",
            title: "ERROR",
            text: "' . $respuesta . '",
            showConfirmButton: false,
            timer: 2000,
        }).then(function() {
            window.location = "./crear.php";
        });';
            echo '</script>';
        }
    } else {
        echo '<script language="javascript"> ';
        echo 'Swal.fire({
            icon: "error",
            title: "ERROR",
            text: "' . $solicitud1 . '",
            showConfirmButton: false,
            timer: 2000,
        }).then(function() {
            window.location = "./crear.php";
        });';
        echo '</script>';
    }
}
