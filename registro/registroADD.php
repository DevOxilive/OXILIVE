<?php
include_once '../templates/hea.php';
include("../connection/conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST)) {

        $usuario = (isset($_POST["usuario"]) ? $_POST["usuario"] : "");
        $rfc = (isset($_POST["rfc"]) ? $_POST["rfc"] : "");
        $password = (isset($_POST["password"]) ? $_POST["password"] : "");
        $nombre = (isset($_POST["nombre"]) ? $_POST["nombre"] : "");
        $apellidoP = (isset($_POST["apellidoP"]) ? $_POST["apellidoP"] : "");
        $telefono = (isset($_POST["telefono"]) ? $_POST["telefono"] : "");
        $email = (isset($_POST["email"]) ? $_POST["email"] : "");
        $genero = (isset($_POST["genero"]) ? $_POST["genero"] : "");
        $alcaldia = (isset($_POST["alcaldia"]) ? $_POST["alcaldia"] : "");
        $num_interior = (isset($_POST["num_interior"]) ? $_POST["num_interior"] : "");
        $num_exterior = (isset($_POST["num_exterior"]) ? $_POST["num_exterior"] : "");
        $codigo_postal = (isset($_POST["codigo_postal"]) ? $_POST["codigo_postal"] : "");
        $calleUno = (isset($_POST["calleUno"]) ? $_POST["calleUno"] : "");
        $calleDos = (isset($_POST["calleDos"]) ? $_POST["calleDos"] : "");
        $referencias = (isset($_POST["referencias"]) ? $_POST["referencias"] : "");
        $foto = (isset($_FILES["foto"]["name"]) ? $_FILES["foto"]["name"] : "");
        $credencialFrente = (isset($_FILES["credencialFrente"]["name"]) ? $_FILES["credencialFrente"]["name"] : "");
        $credencialAtras = (isset($_FILES["credencialAtras"]["name"]) ? $_FILES["credencialAtras"]["name"] : "");
        $comprobante_domicilio = (isset($_FILES["comprobante_domicilio"]["name"]) ? $_FILES["comprobante_domicilio"]["name"] : "");

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sentencia = $con->prepare("INSERT INTO `usuarios` (`id_usuarios`, `Usuario`, `rfc`,`paswword`, `Nombres`, `Apellidos`, `Telefono`, `Correo`,  `Estado`, `Genero`, `Foto_perfil`,`alcaldia`,`num_interior`,`num_exterior`,`codigo_postal`,`calleUno`,`calleDos`,`referencias`,`credencialFrente`,`credencialAtras`,`comprobante_domicilio`,`id_departamentos`,`inicios_sesion`) VALUES 
                                                            (Null, :usuario, :rfc, :password, :nombre, :apellidoP, :telefono, :email, 1, :genero, :foto, :alcaldia, :num_interior, :num_exterior, :codigo_postal, :calleUno, :calleDos, :referencias, :credencialFrente, :credencialAtras, :comprobante_domicilio, 10, 0);");

        $sentencia->bindParam(":usuario", $usuario);
        $sentencia->bindParam(":rfc", $rfc);
        $sentencia->bindParam(":password", $hashedPassword);
        $sentencia->bindParam(":nombre", $nombre);
        $sentencia->bindParam(":apellidoP", $apellidoP);
        $sentencia->bindParam(":telefono", $telefono);
        $sentencia->bindParam(":email", $email);
        $sentencia->bindParam(":genero", $genero);
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
                    icon: "warning",
                    title: "USUARIO EXISTENTE",
                    text: "El usuario ya existe",
                    showConfirmButton: false,
                    timer: 2000,
                }).then(function() {
                    window.location = "./registro.php";
                });';
            echo '</script>';
        } else {
            $fecha_foto = new DateTime();
            $nombre_foto_orginal = ($foto != '') ? $fecha_foto->getTimestamp() . "_" . $_FILES["foto"]["name"] : "";
            $tmp_foto = $_FILES["foto"]["tmp_name"];

            $fecha_credencialFrente = new DateTime();
            $nombre_credencialFrente_orginal = ($credencialFrente != '') ? $fecha_credencialFrente->getTimestamp() . "_" . $_FILES["credencialFrente"]["name"] : "";
            $tmp_credencialFrente = $_FILES["credencialFrente"]["tmp_name"];

            $fecha_credencialAtras = new DateTime();
            $nombre_credencialAtras_orginal = ($credencialAtras != '') ? $fecha_credencialAtras->getTimestamp() . "_" . $_FILES["credencialAtras"]["name"] : "";
            $tmp_credencialAtras = $_FILES["credencialAtras"]["tmp_name"];

            $fecha_comprobante_domicilio = new DateTime();
            $nombre_comprobante_domicilio_orginal = ($comprobante_domicilio != '') ? $fecha_comprobante_domicilio->getTimestamp() . "_" . $_FILES["comprobante_domicilio"]["name"] : "";
            $tmp_comprobante_domicilio = $_FILES["comprobante_domicilio"]["tmp_name"];

            if ($tmp_foto != '' && $credencialFrente != '' && $credencialAtras != '' && $comprobante_domicilio != '') {
                $carpeta_usuario = "../secciones/usuarios/OXILIVE/" . $apellidoP . " " . $nombre;
                if (!is_dir($carpeta_usuario)) {
                    mkdir($carpeta_usuario);
                }

                move_uploaded_file($tmp_foto, $carpeta_usuario . "/" . $nombre_foto_orginal);
                move_uploaded_file($tmp_credencialFrente, $carpeta_usuario . "/" . $nombre_credencialFrente_orginal);
                move_uploaded_file($tmp_credencialAtras, $carpeta_usuario . "/" . $nombre_credencialAtras_orginal);
                move_uploaded_file($tmp_comprobante_domicilio, $carpeta_usuario . "/" . $nombre_comprobante_domicilio_orginal);
            }
            $sentencia->bindParam(":foto", $nombre_foto_orginal);
            $sentencia->bindParam(":credencialFrente", $nombre_credencialFrente_orginal);
            $sentencia->bindParam(":credencialAtras", $nombre_credencialAtras_orginal);
            $sentencia->bindParam(":comprobante_domicilio", $nombre_comprobante_domicilio_orginal);
            $sentencia->execute();
            echo '<script language="javascript"> ';
            echo 'Swal.fire({
                    icon: "success",
                    title: "REGISTRO EXITOSO",
                    text: "Ya puedes iniciar sesión",
                    showConfirmButton: false,
                    timer: 2000,
                }).then(function() {
                    window.location = "../login.php";
                });';
            echo '</script>';
        }
    }
}
