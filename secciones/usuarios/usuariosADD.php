<?php
//inclucion de librerias.
include("../../connection/url.php");
include("../../templates/hea.php");
include("../../connection/conexion.php");
include("../../ctrlArchivos/control/Archivero.php");

//instancia de un objeto.
$archivero = new Archivero();

// comprobacion de envio de valores por metodo post.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (isset($_POST['idus']) ? $_POST['idus'] : "");
    $usuario = (isset($_POST["usuario"]) ? $_POST["usuario"] : "");
    $password = (isset($_POST["password"]) ? $_POST["password"] : "");
    $id_departamento = (isset($_POST["departamento"]) ? $_POST["departamento"] : "");

    // Verificar si el usuario ya existe
    $verificar_usuario = $con->prepare("SELECT COUNT(*) FROM usuarios WHERE Usuario = :usuario");
    $verificar_usuario->bindParam(":usuario", $usuario);
    $verificar_usuario->execute();
    $existe_usuario = $verificar_usuario->fetchColumn();

    // si se repite el usuario, denegar el registro del usuario.
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

        // si no se repite el usuario, almacenar el usuario.
    } else {

        //encriptar contraseña
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt2 = $con->prepare("UPDATE empleados SET departamento = :departamento WHERE id_empleado = :empleado");
        $stmt2->bindParam(':departamento', $id_departamento);
        $stmt2->bindParam(':empleado', $id);
        $stmt2->execute();
        $actualizado = $stmt2->fetchColumn();

        //si no se actualizo 
        if ($actualizado) {
            echo '<script language="javascript"> ';
            echo 'Swal.fire({
                                icon: "success",
                                title: "Error al guardar al usuario :(",
                                text: "error...",
                                showConfirmButton: false,
                                timer: 2000,
                            }).then(function() {
                                window.location = "./index.php";
                            });';
            echo '</script>';
            // si se actualizo
        } else {

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

            $sql = "INSERT INTO usuarios (usuario, passsword, estadoUsuarios, estatus, token, fotoPerfil, iniciosSesion, ultSesion, fechaRegistro) VALUES (:usuario, )";

            $sentencia->bindParam(":usuario", $usuario);
            $sentencia->bindParam(":password", $hashedPassword);


            echo '<script language="javascript"> ';
            echo 'Swal.fire({
                                icon: "success",
                                title: "USUARIO AGREGADO",
                                text: "Datos guardados",
                                showConfirmButton: false,
                                timer: 2000,
                            }).then(function() {
                                window.location = "./index.php";
                            });';
            echo '</script>';
        }
    }
} else {
    echo '<script language="javascript"> ';
    echo 'Swal.fire({
                icon: "error",
                title: "ERROR",
                text: "Error en el servidor",
                showConfirmButton: false,
                timer: 2000,
            }).then(function() {
                window.location = "./crear.php";
            });';
    echo '</script>';
}



// } else {
//     $objArchivo->eliminarCarpeta($carpetaNueva);
//     echo '<script language="javascript"> ';
//     echo 'Swal.fire({
//                 icon: "error",
//                 title: "ERROR",
//                 text: "' . $respuesta . '",
//                 showConfirmButton: false,
//                 timer: 2000,
//             }).then(function() {
//                 window.location = "./crear.php";
//             });';
//     echo '</script>';
// }
// echo '<script language="javascript"> ';
// echo 'Swal.fire({
//                 icon: "error",
//                 title: "ERROR",
//                 text: "' . $solicitud1 . '",
//                 showConfirmButton: false,
//                 timer: 2000,
//             }).then(function() {
//                 window.location = "./crear.php";
//             });';
// echo '</script>'; 