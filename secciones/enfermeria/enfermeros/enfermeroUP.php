<?php
if (isset($_GET['txtID'])) {

  $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";

  $sentencia = $con->prepare("SELECT * FROM usuarios WHERE id_usuarios=:id_usuarios");
  $sentencia->bindParam(":id_usuarios", $txtID);
  $sentencia->execute();
  $registro = $sentencia->fetch(PDO::FETCH_LAZY);

  //Traer los datos en la DB
  $usuario = $registro["Usuario"];
  $password = $registro["paswword"];
  $nombres = $registro["Nombres"];
  $apellidos = $registro["Apellidos"];
  $genero = $registro["Genero"];
  $telefono = $registro["Telefono"];
  $email = $registro["Correo"];
  $status = $registro["Estado"];
  $alcaldia = $registro["alcaldia"];
  $calle = $registro["calle"];
  $num_interior = $registro["num_interior"];
  $num_exterior = $registro["num_exterior"];
  $codigo_postal = $registro["codigo_postal"];
  $calleUno = $registro["calleUno"];
  $calleDos = $registro["calleDos"];
  $referencias = $registro["referencias"];
  $departamento = $registro["id_departamentos"];
  $Foto_perfil = $registro["Foto_perfil"];
  $credencialFrente = $registro["credencialFrente"];
  $credencialAtras = $registro["credencialAtras"];
  $comprobante_domicilio = $registro["comprobante_domicilio"];
  $rfc = $registro["rfc"];

}


if ($_POST) {
    include("../../../connection/conexion.php");

  $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
  $usuario = (isset($_POST["usuario"]) ? $_POST["usuario"] : "");
  $password = (isset($_POST["password"]) ? $_POST["password"] : "");
  $nombres = (isset($_POST["nombres"]) ? $_POST["nombres"] : "");
  $apellidos = (isset($_POST["apellidos"]) ? $_POST["apellidos"] : "");
  $genero = (isset($_POST["genero"]) ? $_POST["genero"] : "");
  $telefono = (isset($_POST["telefono"]) ? $_POST["telefono"] : "");
  $email = (isset($_POST["email"]) ? $_POST["email"] : "");
  $status = (isset($_POST["status"]) ? $_POST["status"] : "");
  $departamento = (isset($_POST["departamento"]) ? $_POST["departamento"] : "");
  $calle = (isset($_POST["calle"]) ? $_POST["calle"] : "");
  $alcaldia = (isset($_POST["alcaldia"]) ? $_POST["alcaldia"] : "");
  $num_interior = (isset($_POST["num_interior"]) ? $_POST["num_interior"] : "");
  $num_exterior = (isset($_POST["num_exterior"]) ? $_POST["num_exterior"] : "");
  $codigo_postal = (isset($_POST["codigo_postal"]) ? $_POST["codigo_postal"] : "");
  $calleUno = (isset($_POST["calleUno"]) ? $_POST["calleUno"] : "");
  $calleDos = (isset($_POST["calleDos"]) ? $_POST["calleDos"] : "");
  $referencias = (isset($_POST["referencias"]) ? $_POST["referencias"] : "");
  $rfc = (isset($_POST["rfc"]) ? $_POST["rfc"] : "");

  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
  $sentencia = $con->prepare("UPDATE usuarios
                            SET Usuario=:usuario, paswword=:password, Nombres=:nombres, Apellidos=:apellidos, Genero=:genero, Telefono=:telefono, Correo=:email, Estado=:status, id_departamentos=:departamento, rfc=:rfc, alcaldia=:alcaldia, calle=:calle, num_interior=:num_interior, num_exterior=:num_exterior, codigo_postal=:codigo_postal, calleUno=:calleUno, calleDos=:calleDos, referencias=:referencias
                            WHERE id_usuarios=:id_usuarios");

  $sentencia->bindParam(":usuario", $usuario);
  $sentencia->bindParam(":password", $hashedPassword);
  $sentencia->bindParam(":nombres", $nombres);
  $sentencia->bindParam(":apellidos", $apellidos);
  $sentencia->bindParam(":genero", $genero);
  $sentencia->bindParam(":telefono", $telefono);
  $sentencia->bindParam(":email", $email);
  $sentencia->bindParam(":rfc", $rfc);
  $sentencia->bindParam(":status", $status);
  $sentencia->bindParam(":alcaldia", $alcaldia);
  $sentencia->bindParam(":calle", $calle);
  $sentencia->bindParam(":num_interior", $num_interior);
  $sentencia->bindParam(":num_exterior", $num_exterior);
  $sentencia->bindParam(":codigo_postal", $codigo_postal);
  $sentencia->bindParam(":calleUno", $calleUno);
  $sentencia->bindParam(":calleDos", $calleDos);
  $sentencia->bindParam(":referencias", $referencias);
  $sentencia->bindParam(":departamento", $departamento);
  $sentencia->bindParam(":id_usuarios", $txtID);
  $sentencia->execute();

  $carpeta_usuario = "./OXILIVE/" . $apellidos . " " . $nombres;

function guardarArchivo($tmp_file, $nombre_original, $carpeta_usuario) {
    if (!empty($nombre_original) && $tmp_file != '') {
        if (!file_exists($carpeta_usuario)) {
            mkdir($carpeta_usuario, 0777, true);
        }
        $ruta_destino = $carpeta_usuario . "/" . $nombre_original;
        if (move_uploaded_file($tmp_file, $ruta_destino)) {
            return $nombre_original;
        }
    }
    return "";
}

$campos_archivos = array(
    "Foto_perfil",
    "credencialFrente",
    "credencialAtras",
    "comprobante_domicilio",
);

foreach ($campos_archivos as $campo_archivo) {
    $nombre_archivo = (isset($_FILES[$campo_archivo]['name']) ? $_FILES[$campo_archivo]['name'] : "");
    $fecha_archivo = new DateTime();
    $nombre_archivo_original = (!empty($nombre_archivo) ? $fecha_archivo->getTimestamp() . "_" . $nombre_archivo : "");
    $tmp_archivo = $_FILES[$campo_archivo]['tmp_name'];

    $archivo_guardado = guardarArchivo($tmp_archivo, $nombre_archivo_original, $carpeta_usuario);

    if (!empty($archivo_guardado)) {
        $sentencia = $con->prepare("SELECT $campo_archivo FROM `usuarios` WHERE id_usuarios=:id_usuarios");
        $sentencia->bindParam(":id_usuarios", $txtID);
        $sentencia->execute();
        $registro_recuperado = $sentencia->fetch(PDO::FETCH_ASSOC);

        if (isset($registro_recuperado[$campo_archivo])) {
            $ruta_archivo = $carpeta_usuario . "/" . $registro_recuperado[$campo_archivo];
            if (file_exists($ruta_archivo)) {
                unlink($ruta_archivo);
            }
        }

        $sentencia = $con->prepare("UPDATE usuarios SET $campo_archivo=:archivo WHERE id_usuarios=:id_usuarios");
        $sentencia->bindParam(":archivo", $archivo_guardado);
        $sentencia->bindParam(":id_usuarios", $txtID);
        $sentencia->execute();
    }
}
  header("Location:./index.php");
}
?>