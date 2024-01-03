<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    include_once 'templates/hea.php';
    include_once 'connection/conexion.php';
    $vUsuario = $_POST["txtUsu"];
    $vPassword = $_POST["txtPass"];

    if (!empty($vUsuario) && !empty($vPassword)) {
        $consu = "SELECT * FROM usuarios WHERE Usuario = :vUsuario AND Estado != 2";
        $stmt = $con->prepare($consu);
        $stmt->bindParam(":vUsuario", $vUsuario);
        $stmt->execute();
        $datos = $stmt->fetch(PDO::FETCH_ASSOC);

        $incremento = "UPDATE usuarios SET inicios_sesion = inicios_sesion + 1 WHERE Usuario = :vUsuario";
        $incre = $con->prepare($incremento);
        $incre->bindParam(":vUsuario", $vUsuario);
        $incre->execute();

        if ($datos && password_verify($vPassword, $datos["paswword"])) {
            $_SESSION['idus'] = $datos["id_usuarios"];
            $_SESSION['us'] = $datos["Usuario"];
            $_SESSION['no'] = $datos["Nombres"];
            $_SESSION['ape'] = $datos["Apellidos"];
            $_SESSION['puesto'] = $datos["id_departamentos"];
            $_SESSION['foto'] = $datos["Foto_perfil"];
            $_SESSION['genero'] = $datos["Genero"];
            $_SESSION['tel'] = $datos["Telefono"];
            $_SESSION['email'] = $datos["Correo"];
            $_SESSION['rfc'] = $datos["rfc"];
            $_SESSION['estado'] = $datos['Estado'];

            $sentensia2 = $con->prepare("UPDATE usuarios SET estatus = '1' WHERE id_usuarios = '{$_SESSION['idus']}' ");
            $sentensia2->execute();

            alertSuccess();
        } else {
            alertError("Campos Incorrectos", "Usuario y/o contraseña incorrecto(a)");
        }
    } else {
        alertError("Error", "Los campos no deben ir vacíos.");
    }
}
function alertSuccess(){
    $name=ucfirst(strtolower($_SESSION['no']));
    if($_SESSION['genero'] == 1){
        $msg = "Bienvenido ". $name;
    } else {
        $msg = "Bienvenida ". $name;
    }
    echo "<script>
        Swal.fire({
            icon: 'success',
            title: '".$msg."',
            showConfirmButton: false,
            timer: 1500,
        }).then(function() {
            window.location = 'index.php';
        });
    </script>";
}
function alertError($ttl, $msg){
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: '".$ttl."',
            text: '".$msg."',
            showConfirmButton: false,
            timer: 2000,
        }).then(function() {
            window.location = 'login.php';
        });
    </script>";
}
?>
<title>OXILIVE S.A de C.V</title>