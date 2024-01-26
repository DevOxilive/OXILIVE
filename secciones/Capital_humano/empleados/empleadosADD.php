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
    $cuentaInput = (isset($_POST['cuentaInput']) ? $_POST['cuentaInput'] : null);
    $estudio = (isset($_POST['nivel_educativo']) ? $_POST['nivel_educativo'] : "");
    $contrato = (isset($_POST['contrato']) ? $_POST['contrato'] : "");
    $nss = (isset($_POST['nss']) ? $_POST['nss'] : "");
    $ineAnverso = (isset($_POST['ineAnverso']) ? $_POST['ineAnverso'] : "");
    $ineReverso = (isset($_POST['ineReverso']) ? $_POST['ineReverso'] : "");
    $actaNacimiento = (isset($_POST['actaNacimiento']) ? $_POST['actaNacimiento'] : null);
    $comprobanteDomicilio = (isset($_POST['comprobanteDomicilio']) ? $_POST['comprobanteDomicilio'] : null);
    $nssDoc = (isset($_POST['nssDoc']) ? $_POST['nssDoc'] : "");
    $curpDoc = (isset($_POST['curpDoc']) ? $_POST['curpDoc'] : "");
    $rfcDoc = (isset($_POST['rfcDoc']) ? $_POST['rfcDoc'] : "");
    //Los restantes
    $referenciaLabUno = (isset($_POST['referenciaLabUno']) ? $_POST['referenciaLabUno'] : "");
    $referenciaLabDos = (isset($_POST['referenciaLabDos']) ? $_POST['referenciaLabDos'] : "");
    $licenciaUno = (isset($_POST['licenciaUno']) ? $_POST['licenciaUno'] : "");
    $licenciaDos = (isset($_POST['licenciaDos']) ? $_POST['licenciaDos'] : "");
    $licenciaTres = (isset($_POST['licenciaTres']) ? $_POST['licenciaTres'] : "");

    //Los anteriores ya se insertan
    $doc[] = $_FILES['cuenta']['name'];
    $doc[] = $_FILES['certificadoEstudios']['name'];
    $doc[] = $_FILES['ineAnverso']['name'];
    $doc[] = $_FILES['ineReverso']['name'];
    $doc[] = $_FILES['actaNacimiento']['name'];
    $doc[] = $_FILES['comprobanteDomicilio']['name'];
    $doc[] = $_FILES['nssDoc']['name'];
    $doc[] = $_FILES['curpDoc']['name'];
    $doc[] = $_FILES['rfcDoc']['name'];
    $doc[] = $_FILES['referenciaLabUno']['name'];
    $doc[] = $_FILES['referenciaLabDos']['name'];
    $doc[] = $_FILES['licenciaUno']['name'];
    $doc[] = $_FILES['licenciaDos']['name'];
    $doc[] = $_FILES['licenciaTres']['name'];

    //Contenido del file
    $contenido[] = $_FILES['cuenta']['tmp_name'];
    $contenido[] = $_FILES['certificadoEstudios']['tmp_name'];
    $contenido[] = $_FILES['ineAnverso']['tmp_name'];
    $contenido[] = $_FILES['ineReverso']['tmp_name'];
    $contenido[] = $_FILES['actaNacimiento']['tmp_name'];
    $contenido[] = $_FILES['comprobanteDomicilio']['tmp_name'];
    $contenido[] = $_FILES['nssDoc']['tmp_name'];
    $contenido[] = $_FILES['curpDoc']['tmp_name'];
    $contenido[] = $_FILES['rfcDoc']['tmp_name'];

    $contenido[] = $_FILES['referenciaLabUno']['tmp_name'];
    $contenido[] = $_FILES['referenciaLabDos']['tmp_name'];
    $contenido[] = $_FILES['licenciaUno']['tmp_name'];
    $contenido[] = $_FILES['licenciaDos']['tmp_name'];
    $contenido[] = $_FILES['licenciaTres']['tmp_name'];

    //mayuscula o minuscula según sea el caso 
    $nombres = strtolower($nombres);
    $curp = strtoupper($curp);
    //comprobar errores de creacion de la carpeta del usuario nuevo.
    $carpetaNueva = "OXILIVE/" . $curp . " " . $nombres;
    $solicitud1 = $archivero->crearCarpeta("OXILIVE/", $curp . " " . $nombres);
    echo $solicitud1;
    if ($solicitud1 === true) {
        //Sale aquí sigue la comprobación
        if ($_FILES["cuenta"]['error'] !== 4) {
            $cuenta = $url_base . "secciones/" . $carpetaNueva . $_FILES['cuenta']['name'];
        } else {
            $cuenta = $url_base . "secciones/chatNotifica/img/usuario.png";
        }
        if ($_FILES["certificadoEstudios"]["error"] !== 4){
            $certificadoEstudios = $url_base . "secciones/" . $carpetaNueva . $_FILES['certificadoEstudios']['name'];
        }else {
            $cuenta = $url_base . "secciones/chatNotifica/img/usuario.png";
        }
        if ($_FILES["ineAnverso"]['error'] !== 4) {
            $ineAnverso = $url_base . "secciones/" . $carpetaNueva . $_FILES['ineAnverso']['name'];
        } else {
            $ineAnverso = $url_base . "secciones/chatNotifica/img/usuario.png";
        }
        if ($_FILES["ineReverso"]['error'] !== 4) {
            $ineReverso = $url_base . "secciones/" . $carpetaNueva . $_FILES['ineReverso']['name'];
        } else {
            $ineReverso = $url_base . "secciones/chatNotifica/img/usuario.png";
        }
        if ($_FILES["actaNacimiento"]['error'] !== 4){
            $actaNacimiento = $url_base . "secciones/" .  $carpetaNueva . $_FILES['actaNacimiento']['name'];
        } else{
            $ineReverso = $url_base . "secciones/chatNotifica/img/usuario.png";
        }
        if ($_FILES["comprobanteDomicilio"]['error'] !==4){
            $comprobanteDomicilio = $url_base . "secciones/" .  $carpetaNueva . $_FILES['comprobanteDomicilio']['name'];
        } else{
            $ineReverso = $url_base . "secciones/chatNotifica/img/usuario.png";
        }
        if ($_FILES["nssDoc"]['error'] !==4){
            $nssDoc = $url_base . "secciones/" .  $carpetaNueva . $_FILES['nssDoc']['name'];
        } else{
            $ineReverso = $url_base . "secciones/chatNotifica/img/usuario.png";
        }
        if ($_FILES["curpDoc"]['error'] !==4){
            $curpDoc = $url_base . "secciones/" .  $carpetaNueva . $_FILES['curpDoc']['name'];
        }else{
            $ineReverso = $url_base . "secciones/chatNotifica/img/usuario.png";
        }
        if ($_FILES["rfcDoc"]['error'] !==4){
            $rfcDoc = $url_base . "secciones/" .  $carpetaNueva . $_FILES['rfcDoc']['name'];
        }else{
            $ineReverso = $url_base . "secciones/chatNotifica/img/usuario.png";
        }
        //Aqui van los que faltan
        if ($_FILES["referenciaLabUno"]['error'] !==4){
            $referenciaLabUno = $url_base . "secciones/" .  $carpetaNueva . $_FILES['referenciaLabUno']['name'];
        }else{
            $referenciaLabUno = $url_base . "secciones/chatNotifica/img/usuario.png";
        }
        if ($_FILES["referenciaLabDos"]['error'] !==4){
            $referenciaLabDos = $url_base . "secciones/" .  $carpetaNueva . $_FILES['referenciaLabDos']['name'];
        }else{
            $referenciaLabDos = $url_base . "secciones/chatNotifica/img/usuario.png";
        }
        if ($_FILES["licenciaUno"]['error'] !==4){
            $licenciaUno = $url_base . "secciones/" .  $carpetaNueva . $_FILES['licenciaUno']['name'];
        }else{
            $licenciaUno = $url_base . "secciones/chatNotifica/img/usuario.png";
        }
        if ($_FILES["licenciaDos"]['error'] !==4){
            $licenciaDos = $url_base . "secciones/" .  $carpetaNueva . $_FILES['licenciaDos']['name'];
        }else{
            $licenciaDos = $url_base . "secciones/chatNotifica/img/usuario.png";
        }
        if ($_FILES["licenciaTres"]['error'] !==4){
            $licenciaTres = $url_base . "secciones/" .  $carpetaNueva . $_FILES['licenciaTres']['name'];
        }else{
            $licenciaTres = $url_base . "secciones/chatNotifica/img/usuario.png";
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
            // Verificar si el usuario ya existe
            $verificar_usuario = $con->prepare("SELECT * FROM empleados WHERE curp = :curp");
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
                // Usuario no existe, realizar la inserción en la base de datos
                $sentencia = $con->prepare("INSERT INTO empleados (nombres, apellidos, genero, telefonoUno, correo, curp, rfc, departamento,calle, numExt,numInt, colonia,calleUno,calleDos,referenciasDireccion,cuenta,numCuenta, estudio, contrato, nss, certificadoEstudios,ineAnverso,ineReverso, actaNacimiento,comprobanteDomicilio,nssDoc, curpDoc, rfcDoc,referenciaLabUno, referenciaLabDos,licenciaUno,licenciaDos,licenciaTres) VALUES (:nombres, :apellidos, :genero, :telefonoUno, :correo, :curp, :rfc, :departamento,:calle,:numExt,:numInt,:colonia,:calleUno,:calleDos,:referencias,:numCuenta,'$cuenta', :estudio, :contrato, :nss , '$certificadoEstudios' , '$ineAnverso' , '$ineReverso' , '$actaNacimiento', '$comprobanteDomicilio', '$nssDoc','$curpDoc', '$rfcDoc' , '$referenciaLabUno', '$referenciaLabDos', '$licenciaUno', '$licenciaDos', '$licenciaTres')");
                $sentencia->bindParam(":nombres", $nombres);
                $sentencia->bindParam(":apellidos", $apellidos);
                $sentencia->bindParam(":genero", $genero);
                $sentencia->bindParam(":telefonoUno", $telefono);
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
                $sentencia->bindParam(":numCuenta", $cuentaInput);
                $sentencia->bindParam(":estudio", $estudio);
                $sentencia->bindParam(":contrato", $contrato);
                $sentencia->bindParam(":nss", $nss);
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
            text: "Error al guardar los archivos",
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
?>
