<?php
//inclucion de librerias.
include("../../connection/url.php");
include("../../templates/hea.php");
include("../../connection/conexion.php");
include("../../ctrlArchivos/control/Archivero.php");
include("model/carpetas.php");

//instancia de un objeto.
$archivero = new Archivero();

// comprobacion de envio de valores por metodo post.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['idus'];

    $usuario = $_POST["usuario"];
    $password = $_POST["password"];
    $id_departamento = $_POST["departamento"];

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
            2timer: 2000,
        }).then(function() {
            window.location = "./crear.php";
        });';
        echo '</script>';

        // si no se repite el usuario, almacenar el usuario.
    } else {

        //encriptar contraseña
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // echo "empleado agarrado por las bolas: " . $id . " y su departamento es:" . $id_departamento;
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
                // registro en la base de datos
            } while ($regresar == true);
            $sql = 'INSERT INTO usuarios 
                        (usuarios.usuario, 
                        usuarios.paswword, 
                        usuarios.estadoUsuarios, 
                        usuarios.estatus, 
                        usuarios.token, 
                        usuarios.fotoPerfil, 
                        usuarios.iniciosSesion) 
                    VALUES (:usuario, :pass, :estado, :estatus, :token, :fotoPerfil, :inicios);';
            
            $sentencia = $con->prepare($sql);
            $uno = 1;
            $cero = 0;
            $foto = 'No existe';
            $sentencia->bindParam(':usuario', $usuario);
            $sentencia->bindParam(':pass', $hashedPassword);
            $sentencia->bindParam(':estado', $uno);
            $sentencia->bindParam(':estatus', $cero);
            $sentencia->bindParam(':token', $token);
            $sentencia->bindParam(':fotoPerfil', $foto);
            $sentencia->bindParam(':inicios', $cero);
            // Pasar directamente el valor de cadena en execute para :fotoPerfil
            $sentencia->execute();
            $respuesta = $sentencia->fetchColumn();

            if (!$respuesta) {
                $idUser = $con->lastInsertId();
                $stmt2 = $con->prepare("UPDATE empleados SET usuarioSistema = :sistema WHERE id_empleado = :empleado");
                $stmt2->bindParam(':sistema', $idUser);
                $stmt2->bindParam(':empleado', $id);
                $stmt2->execute();
                $actualizado = $stmt2->fetchColumn();
                echo '<script language="javascript"> ';
                echo 'Swal.fire({
                                        icon: "success",
                                        title: "USUARIO AGREGADO",
                                        text: "Usuario Agreegado al sistema Oxilive:\n' . $hashedPassword . '",
                                        showConfirmButton: false,
                                        timer: 3000,
                                    }).then(function() {
                                        window.location = "./index.php";
                                    });';

                echo '</script>';
            } else {
                echo '<script language="javascript"> ';
                echo 'Swal.fire({
                                        icon: "error",
                                        title: "error rico",
                                        text: "error en el registro de este wey",
                                        showConfirmButton: false,
                                        timer: 3000,
                                    }).then(function() {
                                        window.location = "./index.php";
                                    });';

                echo '</script>';
            }
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
