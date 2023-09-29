<?php
include("../../connection/conexion.php");
include("../../templates/hea.php");
if ($_POST) {

    $usuario = (isset($_POST["usuario"]) ? $_POST["usuario"] : "");
    $password = (isset($_POST["password"]) ? $_POST["password"] : "");
    $nombres = (isset($_POST["nombres"]) ? $_POST["nombres"] : "");
    $apellidos = (isset($_POST["apellidos"]) ? $_POST["apellidos"] : "");
    $genero = (isset($_POST["genero"]) ? $_POST["genero"] : "");
    $telefono = (isset($_POST["telefono"]) ? $_POST["telefono"] : "");
    $email = (isset($_POST["email"]) ? $_POST["email"] : "");
    $Foto_perfil = (isset($_FILES["Foto_perfil"]['name']) ? $_FILES["Foto_perfil"]['name'] : "");
    $departamento = (isset($_POST["departamento"]) ? $_POST["departamento"] : "");
    $rfc = (isset($_POST["rfc"]) ? $_POST["rfc"] : "");
    $alcaldia = (isset($_POST["alcaldia"]) ? $_POST["alcaldia"] : "");
    $num_interior = (isset($_POST["num_interior"]) ? $_POST["num_interior"] : "");
    $num_exterior = (isset($_POST["num_exterior"]) ? $_POST["num_exterior"] : "");
    $codigo_postal = (isset($_POST["codigo_postal"]) ? $_POST["codigo_postal"] : "");
    $calleUno = (isset($_POST["calleUno"]) ? $_POST["calleUno"] : "");
    $calleDos = (isset($_POST["calleDos"]) ? $_POST["calleDos"] : "");
    $referencias = (isset($_POST["referencias"]) ? $_POST["referencias"] : "");
    $credencialFrente = (isset($_FILES["credencialFrente"]['name']) ? $_FILES["credencialFrente"]['name'] : "");
    $credencialAtras = (isset($_FILES["credencialAtras"]['name']) ? $_FILES["credencialAtras"]['name'] : "");
    $comprobante_domicilio = (isset($_FILES["comprobante_domicilio"]['name']) ? $_FILES["comprobante_domicilio"]['name'] : "");

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

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
                                VALUES (Null, :usuario, :password, :nombres, :apellidos, :genero, :telefono, :email, 1, :Foto_perfil, :departamento , :rfc , :alcaldia, :num_interior, :num_exterior, :codigo_postal, :calleUno, :calleDos, :referencias, :credencialFrente, :credencialAtras, :comprobante_domicilio, :token);");
    //insercion del token nuevo para usuario nuevo..
    $sentencia->bindParam(":token", $token);

    //Se convierten todos estos valores en mayusculas o minusculas (según sea el caso)
    //para que quede unificada en la base de datos
    
    $usuario=strtolower($usuario);
    $nombres=strtoupper($nombres);
    $apellidos=strtoupper($apellidos);
    $email=strtolower($email);
    $rfc=strtoupper($rfc);
    $alcaldia=strtoupper($alcaldia);
    $calle=strtoupper($calle);
    $num_interior=strtoupper($num_interior);
    $num_exterior=strtoupper($num_exterior);
    $calleUno=strtoupper($calleUno);
    $calleDos=strtoupper($calleDos);
    $referencias=strtoupper($referencias);

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
        $fecha_Foto_perfil = new DateTime();
        $nombre_Foto_perfil_orginal = ($fecha_Foto_perfil != '') ? $fecha_Foto_perfil->getTimestamp() . "_" . $_FILES["Foto_perfil"]['name'] : "";
        $tmp_Foto_perfil = $_FILES["Foto_perfil"]['tmp_name'];

        $fecha_credencialFrente = new DateTime();
        $nombre_credencialFrente_orginal = ($fecha_credencialFrente != '') ? $fecha_credencialFrente->getTimestamp() . "_" . $_FILES["credencialFrente"]['name'] : "";
        $tmp_credencialFrente = $_FILES["credencialFrente"]['tmp_name'];

        $fecha_credencialAtras = new DateTime();
        $nombre_credencialAtras_orginal = ($fecha_credencialAtras != '') ? $fecha_credencialAtras->getTimestamp() . "_" . $_FILES["credencialAtras"]['name'] : "";
        $tmp_credencialAtras = $_FILES["credencialAtras"]['tmp_name'];

        $fecha_comprobante_domicilio = new DateTime();
        $nombre_comprobante_domicilio_orginal = ($fecha_comprobante_domicilio != '') ? $fecha_comprobante_domicilio->getTimestamp() . "_" . $_FILES["comprobante_domicilio"]['name'] : "";
        $tmp_comprobante_domicilio = $_FILES["comprobante_domicilio"]['tmp_name'];

        if ($tmp_Foto_perfil != '' && $credencialFrente != '' && $credencialAtras != '' && $comprobante_domicilio != '') {
            $carpeta_usuario = "./OXILIVE/" . $apellidos . " " . $nombres;
            if (!is_dir($carpeta_usuario)) {
                mkdir($carpeta_usuario);
            }

            move_uploaded_file($tmp_Foto_perfil, $carpeta_usuario . "/" . $nombre_Foto_perfil_orginal);
            move_uploaded_file($tmp_credencialFrente, $carpeta_usuario . "/" . $nombre_credencialFrente_orginal);
            move_uploaded_file($tmp_credencialAtras, $carpeta_usuario . "/" . $nombre_credencialAtras_orginal);
            move_uploaded_file($tmp_comprobante_domicilio, $carpeta_usuario . "/" . $nombre_comprobante_domicilio_orginal);
        }
        $sentencia->bindParam(":departamento", $departamento);
        $sentencia->bindParam(":Foto_perfil", $nombre_Foto_perfil_orginal);
        $sentencia->bindParam(":credencialFrente", $nombre_credencialFrente_orginal);
        $sentencia->bindParam(":credencialAtras", $nombre_credencialAtras_orginal);
        $sentencia->bindParam(":comprobante_domicilio", $nombre_comprobante_domicilio_orginal);
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
}
