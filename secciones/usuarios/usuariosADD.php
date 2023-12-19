<?php
include("../../connection/conexion.php");
include("../../connection/url.php");
include("../../templates/hea.php");
include("../../ctrlArchivos/control/Archivero.php");
$archivero = new Archivero();
// comprobacion de envio de valores por metodo post.

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $usuario = (isset($_POST["usuario"]) ? $_POST["usuario"] : "");
    $password = (isset($_POST["password"]) ? $_POST["password"] : "");
    $nombres = (isset($_POST["nombres"]) ? $_POST["nombres"] : "");
    $apellidos = (isset($_POST["apellidos"]) ? $_POST["apellidos"] : "");
    $genero = (isset($_POST["genero"]) ? $_POST["genero"] : "");
    $telefono = (isset($_POST["telefono"]) ? $_POST["telefono"] : "");
    $email = (isset($_POST["email"]) ? $_POST["email"] : "");
    $departamento = (isset($_POST["departamento"]) ? $_POST["departamento"] : "");
    $rfc = (isset($_POST["rfc"]) ? $_POST["rfc"] : "");
    $alcaldia = (isset($_POST["alcaldia"]) ? $_POST["alcaldia"] : "");
    $num_interior = (isset($_POST["num_interior"]) ? $_POST["num_interior"] : "");
    $num_exterior = (isset($_POST["num_exterior"]) ? $_POST["num_exterior"] : "");
    $codigo_postal = (isset($_POST["codigo_postal"]) ? $_POST["codigo_postal"] : "");
    $calleUno = (isset($_POST["calleUno"]) ? $_POST["calleUno"] : "");
    $calleDos = (isset($_POST["calleDos"]) ? $_POST["calleDos"] : "");
    $referencias = (isset($_POST["referencias"]) ? $_POST["referencias"] : "");

    //encriptar contraseña
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    //valores archivos
    $doc[] = $_FILES['Foto_perfil']['name'];
    $doc[] = $_FILES['comprobante_domicilio']['name'];
    $doc[] = $_FILES['credencialFrente']['name'];
    $doc[] = $_FILES['credencialAtras']['name'];

    $Contenido[] = $_FILES['Foto_perfil']['tmp_name'];
    $Contenido[] = $_FILES['comprobante_domicilio']['tmp_name'];
    $Contenido[] = $_FILES['credencialFrente']['tmp_name'];
    $Contenido[] = $_FILES['credencialAtras']['tmp_name'];

    //mayuscula o minuscula según sea el caso 
    $usuario = strtolower($usuario);
    $nombres = strtoupper($nombres);
    $apellidos = strtoupper($apellidos);
    //comprobar errores de creacion de la carpeta del usuario nuevo.
    $carpetaNueva = "OXILIVE/" . $apellidos . " " . $nombres;
    $solicitud1 = $archivero->crearCarpeta("OXILIVE/", $apellidos . " " . $nombres);
    echo $solicitud1;
    if ($solicitud1 === true) {
        // comprobacion de contenido del archivo.
        if ($_FILES['Foto_perfil']['error'] !== 4) {
            $Foto_perfilX = $url_base . "secciones/" . $carpetaNueva . $_FILES['Foto_perfil']['name'];
        } else {
            $Foto_perfilX = $url_base . "secciones/chatNotifica/img/usuario.png";
        }

        if ($_FILES["credencialFrente"]['error'] !== 4) {
            $credencialFrenteX = $url_base . "secciones/" . $carpetaNueva . $_FILES['comprobante_domicilio']['name'];
        } else {
            $credencialFrenteX = $url_base . "secciones/chatNotifica/img/usuario.png";
        }

        if ($_FILES["credencialAtras"]['error'] !== 4) {
            $credencialAtrasX = $url_base . "secciones/" . $carpetaNueva . $_FILES['credencialFrente']['name'];
        } else {
            $credencialAtrasX = $url_base . "secciones/chatNotifica/img/usuario.png";
        }

        if ($_FILES["comprobante_domicilio"]['error'] !== 4) {
            $comprobante_domicilioX = $url_base . "secciones/" . $carpetaNueva . $_FILES['credencialAtras']['name'];
        } else {
            $comprobante_domicilioX = $url_base . "secciones/chatNotifica/img/usuario.png";
        }
        echo "<br>";
        for ($i = 0; $i < count($Contenido); $i++) {
            $respuestas[] = $archivero->guardarArchivo($doc[$i], $Contenido[$i], $carpetaNueva) . "<br>";
        }
        for ($i = 0; $i < count($respuestas); $i++) {
            if ($respuestas[$i] === false) {
                $permitir = false;
                break;
            }
            $permitir = true;
        }
        if ($permitir === true) {
            //revision de token asignado... 
            do {
                $regresar = false;
                $token = bin2hex(random_bytes(32));

                $checkToken = $con->prepare("SELECT token FROM usuarios");
                $checkToken->execute();
                $existToken = $checkToken->fetchAll(PDO::FETCH_ASSOC);
                foreach ($existToken as $tokenCheck) {
                    if ($tokenCheck == $token) {
                        $regresar = true;
                    } else {
                        $token = bin2hex(random_bytes(32));
                        $regresar = false;
                    }
                }
            } while ($regresar == true);
            $sentencia = $con->prepare("INSERT INTO `usuarios` (`id_usuarios`, `Usuario`, `paswword`, `Nombres`, `Apellidos`, `Genero`, `Telefono`, `Correo`, `Estado`, `Foto_perfil`, `id_departamentos`, `rfc`, `alcaldia`,`num_interior`,`num_exterior`,`codigo_postal`,`calleUno`,`calleDos`,`referencias`,`credencialFrente`,`credencialAtras`,`comprobante_domicilio`, `token`) 
                                VALUES (Null, :usuario, :password, :nombres, :apellidos, :genero, :telefono, :email, 1, '$Foto_perfilX', :departamento , :rfc , :alcaldia, :num_interior, :num_exterior, :codigo_postal, :calleUno, :calleDos, :referencias, '$credencialFrenteX', '$credencialAtrasX', '$comprobante_domicilioX', :token);");

            //Se convierten todos estos valores en mayusculas o minusculas (según sea el caso)
            //para que quede unificada en la base de datos
            $email = strtolower($email);
            $rfc = strtoupper($rfc);
            $alcaldia = strtoupper($alcaldia);
            $num_interior = strtoupper($num_interior);
            $num_exterior = strtoupper($num_exterior);
            $calleUno = strtoupper($calleUno);
            $calleDos = strtoupper($calleDos);
            $referencias = strtoupper($referencias);

            //insercion del token y demas para usuario nuevo..
            $sentencia->bindParam(":token", $token);
            $sentencia->bindParam(":usuario", $usuario);
            $sentencia->bindParam(":password", $hashedPassword);
            $sentencia->bindParam(":nombres", $nombres);
            $sentencia->bindParam(":apellidos", $apellidos);
            $sentencia->bindParam(":genero", $genero);
            $sentencia->bindParam(":telefono", $telefono);
            $sentencia->bindParam(":email", $email);
            $sentencia->bindParam(":rfc", $rfc);
            $sentencia->bindParam(":alcaldia", $alcaldia);
            $sentencia->bindParam(":num_interior", $num_interior);
            $sentencia->bindParam(":num_exterior", $num_exterior);
            $sentencia->bindParam(":codigo_postal", $codigo_postal);
            $sentencia->bindParam(":calleUno", $calleUno);
            $sentencia->bindParam(":calleDos", $calleDos);
            $sentencia->bindParam(":referencias", $referencias);

            // Verificar si el usuario ya existe
            $verificar_usuario = $con->prepare("SELECT COUNT(*) FROM usuarios WHERE Usuario = :usuario");
            $verificar_usuario->bindParam(":usuario", $usuario);
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
                window.location = "./crear.php";
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
            $objArchivo->eliminarCarpeta($carpetaNueva);
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
