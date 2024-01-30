<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    include_once 'templates/hea.php';
    include_once 'connection/conexion.php';
    $vUsuario = $_POST["txtUsu"];
    $vPassword = $_POST["txtPass"];

    if (!empty($vUsuario) && !empty($vPassword)) {
        $consu = "SELECT * FROM usuarios u, empleados e WHERE e.usuarioSistema = u.id_usuarios AND u.usuario = :vUsuario AND u.estadoUsuarios != 2";
        $stmt = $con->prepare($consu);
        $stmt->bindParam(":vUsuario", $vUsuario);
        $stmt->execute();
        $datos = $stmt->fetch(PDO::FETCH_ASSOC);

        $incremento = "UPDATE usuarios SET iniciosSesion = iniciosSesion + 1 WHERE usuario = :vUsuario";
        $incre = $con->prepare($incremento);
        $incre->bindParam(":vUsuario", $vUsuario);
        $incre->execute();

        if ($datos && password_verify($vPassword, $datos["paswword"])) {
            $_SESSION['idus'] = $datos["id_usuarios"];
            $_SESSION['us'] = $datos["usuario"];
            $_SESSION['no'] = $datos["nombres"];
            $_SESSION['ape'] = $datos["apellidos"];
            $_SESSION['puesto'] = $datos["departamento"];
            $_SESSION['foto'] = $datos["fotoPerfil"];
            $_SESSION['genero'] = $datos["genero"];
            $_SESSION['telUno'] = $datos["telefonoUno"];
            $_SESSION['rfc'] = $datos["rfc"];
            $_SESSION['estado'] = $datos['estadoUsuarios'];

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
function alertSuccess()
{
    $name = ucfirst(strtolower($_SESSION['no']));
    if ($_SESSION['genero'] == 1) {
        $msg = "Bienvenido " . $name;
    } else {
        $msg = "Bienvenida " . $name;
    }
    echo "<script>
        Swal.fire({
            icon: 'success',
            title: '" . $msg . "',
            showConfirmButton: false,
            timer: 1500,
        }).then(function() {
            window.location = 'index.php';
        });
    </script>";
}
function alertError($ttl, $msg)
{
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: '" . $ttl . "',
            text: '" . $msg . "',
            showConfirmButton: false,
            timer: 2000,
        }).then(function() {
            window.location = 'login.php';
        });
    </script>";
}
?>
<title>OXILIVE S.A de C.V</title>