<?php
include("../../../../connection/conexion.php");
include("../../../../connection/url.php");
include("../../../../ctrlArchivos/control/Archivero.php");
include("../../../../templates/hea.php");
$archivero = new Archivero();
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //recibir datos del formulario
    $usuario = $_POST['usuario'];
    $id_departamento = $_POST['departamento'];
    $id_usuario = $_POST['id_usuarios'];
    $id_empleado = $_POST['id_empleado'];
    $pass = $_POST['password'];
    $fotoNueva = $_FILES['Foto_perfil']['name'];
    $fotoNuevaX = $_FILES['Foto_perfil']['tmp_name'];

    $mensajes = "Revisión: ";
    // actualizacion de usuarios
    if (!empty($usuario)) {
        // Verificar si el usuario ya existe
        $verificar_usuario = $con->prepare("SELECT count(*) FROM usuarios WHERE Usuario = :usuario AND id_usuarios <> $id_usuario");
        $verificar_usuario->bindParam(":usuario", $usuario);
        $verificar_usuario->execute();
        $existe_usuario = $verificar_usuario->fetch();
        // si se repite el usuario, denegar el registro del usuario.
        if ($existe_usuario[0] > 0) {
            $mensajes = "usuario repetido no se guarda. X" . ' ';
            // si no se repite el usuario, almacenar el usuario.
        } else {
            $sql = "UPDATE usuarios SET usuario = '$usuario' WHERE id_usuarios = $id_usuario";
            $update = $con->prepare($sql);
            $update->execute();
            $mensajes .= "usuario actualizado ";
        }
    }
    if (!empty($id_departamento)) {
        $sql = "UPDATE empleados SET departamento = $id_departamento WHERE id_empleado = $id_empleado";
        $update = $con->prepare($sql);
        $update->execute();
        $mensajes .= "departamento actualizado";
    }
    // actualizacion de contraseña
    if (!empty($pass)) {
        $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);
        $sql = "UPDATE usuarios SET paswword = '$hashedPassword' WHERE id_usuarios = $id_usuario";
        $update = $con->prepare($sql);
        $update->execute();
        $mensajes .= "contraseña actualizada ";
    }
    // actualizacion de foto
    if ($_FILES['Foto_perfil']['error'] != 4) {
        $query = "SELECT fotoPerfil, curp, nombres, apellidos FROM usuarios, empleados WHERE id_usuarios = $id_usuario AND usuarioSistema = $id_usuario";
        $user = $con->prepare($query);
        $user->execute();
        $respuesta = $user->fetchAll(PDO::FETCH_ASSOC);
        //checar el contendio de la la foto en la base de datos y eliminarla de la carpeta del usuario.
        foreach ($respuesta as $fila);
        $ruta = '../Capital_humano/empleados/OXILIVE/' . $fila['curp'] . ' ' . $fila['nombres'] . ' ' . $fila['apellidos'];
        $img = explode("/", $fila['fotoPerfil']);
        echo $ruta . $img[9];
        $respuesta = $archivero->eliminarArchivo($ruta . "/" . $img[9]);
        if ($respuesta === false) {
            $archivero->eliminarArchivo($ruta . "/" . $img[9]);
        } else {
            echo "imagen borrada exitosamente.";
            $respuesta = $archivero->guardarArchivo($fotoNueva, $fotoNuevaX, $ruta);
            if ($respuesta === false) {
                echo "algo fallo al guardar";
            } else {
                $ruta = $url_base . 'secciones/Capital_humano/empleados/OXILIVE/' . $fila['curp'] . ' ' . $fila['nombres'] . ' ' . $fila['apellidos'] . '/' . $fotoNueva;
                $_SESSION['foto'] = $ruta;
                $sql2 = "UPDATE usuarios SET fotoPerfil = '$ruta', usuario = '$usuario'  WHERE id_usuarios = $id_usuario";
                $stmt = $con->prepare($sql2);
                $stmt->execute();
                $mensajes .= "imagen guardad exitosa mente ";
            }
        }
    }
?>
    <script>
        Swal.fire({
            title: 'info de carga',
            text: '<?php echo $mensajes ?>',
            icon: 'info',
        }).then(() => {
            window.location = "./index.php";
        });
    </script>
<?php
} else {
?>
    <script>
        Swal.fire({
            title: "ERROR EN EL SERVIDOR",
            text: "estamos teniendo problemas para comunicarnos con el servidor",
            icon: "error",
        }).then(() => {
            window.location = "./index.php";
        });
    </script>
<?php
}
