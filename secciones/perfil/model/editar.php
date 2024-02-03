<?php
include("../../../templates/hea.php");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    include("../../../connection/conexion.php");
    include("../../../ctrlArchivos/control/Archivero.php");
    include("../../../connection/url.php");
    $archivero = new Archivero();
    session_start();
    $id = $_SESSION['idus'];
    $sql = "SELECT * FROM empleados WHERE usuarioSistema = $id";
    $usuarios = $con->prepare($sql);
    $usuarios->execute();
    $user = $usuarios->fetchAll(PDO::FETCH_ASSOC);
    foreach ($user as $row);
    $id_empleado = $row['id_empleado'];
    $correo = $_POST['correo'];
    $pass = $_POST['pass'];
    $tel1 = $_POST['telefonoUno'];
    $tel2 = $_POST['telefonoDos'];
    $fotoNueva = $_FILES['Foto_perfil']['name'];
    $fotoNuevaX = $_FILES['Foto_perfil']['tmp_name'];


    if (empty($correo) && empty($pass) && empty($tel1) && empty($tel2) && empty($fotoNueva)) {
?>
        <script>
            swal.fire({
                icon: 'info',
                title: 'SIN CAMBIOS',
                text: 'no realizaste ningun cambio',
            }).then((result) => {
                window.location = "../account.php";
            });
        </script>
    <?php
    } else {
        $mensaje = "";
        if (!empty($correo)) {
            $sql = "UPDATE empleados SET correo = '$correo' WHERE id_empleado = $id_empleado";
            $update = $con->prepare($sql);
            $update->execute();
            $mensaje .= "$correo ";
        }
        if (!empty($pass)) {
            $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);
            $sql = "UPDATE usuarios SET paswword = '$hashedPassword' WHERE id_usuarios = $id";
            $update = $con->prepare($sql);
            $update->execute();
            $mensaje .= "contraseña actualizada: ";
            $mensaje .= "$pass";
        }
        if (!empty($tel1)) {
            $sql = "UPDATE empleados SET telefonoUno = '$tel1' WHERE id_empleado = $id_empleado";
            $update = $con->prepare($sql);
            $update->execute();
            $mensaje .= "$tel1 ";
        }
        if (!empty($tel2)) {
            $sql = "UPDATE empleados SET telefonoDos = '$tel2' WHERE id_empleado = $id_empleado";
            $update = $con->prepare($sql);
            $update->execute();
            $mensaje .= "$tel2 ";
        }
        if (!empty($fotoNueva)) {
            $query = "SELECT fotoPerfil, curp, nombres, apellidos FROM usuarios, empleados WHERE id_usuarios = $id AND usuarioSistema = $id";
            $user = $con->prepare($query);
            $user->execute();
            $respuesta = $user->fetchAll(PDO::FETCH_ASSOC);
            //checar el contendio de la la foto en la base de datos y eliminarla de la carpeta del usuario.
            foreach ($respuesta as $fila);
            $ruta = '../../Capital_humano/empleados/OXILIVE/' . $fila['curp'] . ' ' . $fila['nombres'];
            $img = explode("/", $fila['fotoPerfil']);

            // print_r($img) . "<br>";

            if (count($img) > 6) {
                $respuesta = $archivero->eliminarArchivo($ruta . "/" . $img[9]);
                if ($respuesta === false) {
                    $archivero->eliminarArchivo($ruta . "/" . $img[9]);
                    // echo "imagen: $img[9]";
                } else {
                    // echo "imagen borrada exitosamente.";
                    $respuesta = $archivero->guardarArchivo($fotoNueva, $fotoNuevaX, $ruta);
                    if ($respuesta === false) {
                        $mensaje .= "algo fallo al guardar la imagen";
                    } else {
                        $ruta = $url_base . 'secciones/Capital_humano/empleados/OXILIVE/' . $fila['curp'] . ' ' . $fila['nombres'] . '/' . $fotoNueva;
                        if ($_SESSION['idus'] == $id) {
                            $_SESSION['foto'] = $ruta;
                        } else {
                            $mensaje .= "no se cambio la variable de sesion";
                        }
                        $sql2 = "UPDATE usuarios SET fotoPerfil = '$ruta' WHERE id_usuarios = $id";
                        $stmt = $con->prepare($sql2);
                        $stmt->execute();
                        $mensaje .= "imagen guardad exitosa mente ";
                    }
                }
            } else {
                // echo $ruta . $img[5];
                $respuesta = $archivero->guardarArchivo($fotoNueva, $fotoNuevaX, $ruta);
                if ($respuesta === false) {
                    $mensaje .="algo fallo al guardar";
                } else {
                    $ruta = $url_base . 'secciones/Capital_humano/empleados/OXILIVE/' . $fila['curp'] . ' ' . $fila['nombres'] . '/' . $fotoNueva;
                    if ($_SESSION['idus'] === $id) {
                        $_SESSION['foto'] = $ruta;
                    }
                    $sql2 = "UPDATE usuarios SET fotoPerfil = '$ruta' WHERE id_usuarios = $id";
                    $stmt = $con->prepare($sql2);
                    $stmt->execute();
                    $mensaje .= "imagen guardad exitosa mente ";
                }
            }

            $mensaje .= "$fotoNueva";
        }
    ?>
        <script>
            swal.fire({
                icon: 'info',
                title: 'Datos Actualizados',
                text: 'datos: <?php echo $mensaje ?>',
            }).then((result) => {
                window.location = "../account.php";
            });
        </script>
    <?php
    }
} else {
    ?>
    <script>
        swal.fire({
            icon: 'info',
            title: 'ERROR',
            text: 'Error en el servidor',
        }).then((result) => {
            window.location = "../account.php";
        });
    </script>
<?php
}
