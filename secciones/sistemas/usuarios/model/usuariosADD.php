<?php
//inclucion de librerias.
include("../../../../connection/url.php");
include("../../../../connection/conexion.php");
include("../../../../templates/hea.php");
include("../../../../ctrlArchivos/control/Archivero.php");
//instancia de un objeto.
$archivero = new Archivero();
// comprobacion de envio de valores por metodo post.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['idus'];
    $contenidoFoto = $_FILES['Foto_perfil']['tmp_name'];
    $usuario = $_POST["usuario"];
    $password = $_POST["password"];
    $id_departamento = $_POST["departamento"];

    // Verificar si el usuario ya existe
    $verificar_usuario = $con->prepare("SELECT count(*) FROM usuarios WHERE Usuario = :usuario");
    $verificar_usuario->bindParam(":usuario", $usuario);
    $verificar_usuario->execute();
    $existe_usuario = $verificar_usuario->fetch();
    // si se repite el usuario, denegar el registro del usuario.
    if ($existe_usuario[0] > 0) {
        echo "<h1>error rico: usuarios repetido :P</h1>";
        echo '<script>';
        echo 'Swal.fire({
            icon: "error",
            title: "ERROR",
            text: "El usuario ya existe",
            showConfirmButton: false,
            timer: 2000,
        }).then(function() {
            window.location = "../pages/crear.php?idus=' . $id . '";
        });';
        echo '</script>';
        // si no se repite el usuario, almacenar el usuario.
    } else {

        $carga = $con->prepare('SELECT * FROM empleados WHERE id_empleado = :id');
        $carga->bindParam(':id', $id);
        $carga->execute();
        $resultado = $carga->fetchAll(PDO::FETCH_ASSOC);

        foreach ($resultado as $fila);
        $ruta = '../../../Capital_humano/empleados/OXILIVE/' . $fila['curp'] . ' ' . $fila['nombres'] . ' ' . $fila['apellidos'];
        if ($_FILES['Foto_perfil']['error'] !== 4) {
            $Foto_perfilX = $_FILES['Foto_perfil']['name'];
        } else {
            $Foto_perfilX = "usuario.png";
            $ruta = $url_base . 'img/' . $Foto_perfilX;
        }
        //existencia de archivo en el formulario
        if (!empty($contenidoFoto)) {
            $respuesta = $archivero->guardarArchivo($Foto_perfilX, $contenidoFoto, $ruta);
            if ($respuesta === false) {
                echo "<h1>error rico: usuarios repetido :P</h1>";
                echo '<script>';
                echo 'Swal.fire({
                    icon: "error",
                    title: "ERROR",
                    text: "Error en el sistema: ' . $archivero->guardarArchivo($Foto_perfilX, $contenidoFoto, $ruta) . '",
                    showConfirmButton: false,
                    timer: 2000,
                }).then(function() {
                    window.location = "../pages/crear.php?idus=' . $id . '";
                });';
                echo '</script>';
            }
        }

        // encriptar contraseña
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        // //revision de token asignado... 
        do {
            $regresar = false;
            $token = bin2hex(random_bytes(32));
            // rebiocion de duplicado del token...
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
        $ruta = $url_base . 'secciones/Capital_humano/empleados/OXILIVE/' . $fila['curp'] . ' ' . $fila['nombres'] . ' ' . $fila['apellidos'] . '/' . $Foto_perfilX;
        $sentencia->bindParam(':usuario', $usuario);
        $sentencia->bindParam(':pass', $hashedPassword);
        $sentencia->bindParam(':estado', $uno);
        $sentencia->bindParam(':estatus', $cero);
        $sentencia->bindParam(':token', $token);
        $sentencia->bindParam(':fotoPerfil', $ruta);
        $sentencia->bindParam(':inicios', $cero);
        // Pasar directamente el valor de cadena en execute para :fotoPerfil
        $sentencia->execute();
        $respuesta = $sentencia->rowCount();

        //si no se actualizo 
        if (!$respuesta) {
            echo '<script language="javascript"> ';
            echo 'Swal.fire({
                        icon: "error",
                        title: "Error al guardar al usuario :(",
                        text: "error...",
                        showConfirmButton: false,
                        timer: 2000,
                    }).then(function() {
                        window.location = "../index.php";
                    });';
            echo '</script>';
            // si se actualizo
        } else {
            $idUser = $con->lastInsertId();
            $stmt2 = $con->prepare("UPDATE empleados
                                    SET departamento = :departamento, usuarioSistema = :usuarioSistema 
                                    WHERE id_empleado = :empleado");
            $stmt2->bindParam(':departamento', $id_departamento);
            $stmt2->bindParam(':empleado', $id);
            $stmt2->bindParam(':usuarioSistema', $idUser);
            $stmt2->execute();
            $actualizado = $stmt2->rowCount();

            if ($actualizado) {
                echo '<script language="javascript"> ';
                echo 'Swal.fire({
                        icon: "success",
                        title: "USUARIO AGREGADO",
                        text: "Usuario ' . $usuario . ' Agreegado al sistema Oxilive",
                        showConfirmButton: false,
                        timer: 3000,
                    }).then(function() {
                        window.location = "../index.php";
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
                        window.location = "../index.php";
                    });';

                echo '</script>';
            }
        }

        // if ($respuesta != true) {
        //     echo '<script>';
        //     echo 'Swal.fire({
        //             icon: "info",
        //             title: "ESPERA",
        //             text: "La ubicacion del la carpeta es incorrecta. Comunicate con sistemas\n" ' . $ruta . ',
        //             showConfirmButton: false,
        //             timer: 2000,
        //         }).then(function() {
        //         window.location = "./crear.php?idus=' . $id . '";
        //         });';
        //     echo '</script>';
        // } else {
        //     //encriptar contraseña
        //     $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        //     // echo "empleado agarrado por las bolas: " . $id . " y su departamento es:" . $id_departamento;
        //     // //revision de token asignado... 
        //     do {
        //         $regresar = false;
        //         $token = bin2hex(random_bytes(32));
        //         // rebiocion de duplicado del token...
        //         $checkToken = $con->prepare("SELECT token FROM usuarios");
        //         $checkToken->execute();
        //         $existToken = $checkToken->fetchAll(PDO::FETCH_ASSOC);
        //         foreach ($existToken as $tokenCheck) {
        //             if ($tokenCheck == $token) {
        //                 $regresar = true;
        //             } else {
        //                 $token = bin2hex(random_bytes(32));
        //                 $regresar = false;
        //             }
        //         }
        //         // registro en la base de datos
        //     } while ($regresar == true);

        //     $sql = 'INSERT INTO usuarios 
        //                 (usuarios.usuario, 
        //                 usuarios.paswword, 
        //                 usuarios.estadoUsuarios, 
        //                 usuarios.estatus, 
        //                 usuarios.token, 
        //                 usuarios.fotoPerfil, 
        //                 usuarios.iniciosSesion) 
        //         VALUES (:usuario, :pass, :estado, :estatus, :token, :fotoPerfil, :inicios);';

        //     $sentencia = $con->prepare($sql);
        //     $uno = 1;
        //     $cero = 0;
        //     $ruta .= $foto;
        //     $sentencia->bindParam(':usuario', $usuario);
        //     $sentencia->bindParam(':pass', $hashedPassword);
        //     $sentencia->bindParam(':estado', $uno);
        //     $sentencia->bindParam(':estatus', $cero);
        //     $sentencia->bindParam(':token', $token);
        //     $sentencia->bindParam(':fotoPerfil', $ruta);
        //     $sentencia->bindParam(':inicios', $cero);
        //     // Pasar directamente el valor de cadena en execute para :fotoPerfil
        //     $sentencia->execute();
        //     $respuesta = $sentencia->rowCount();

        //     //si no se actualizo 
        //     if (!$respuesta) {
        //         echo '<script language="javascript"> ';
        //         echo 'Swal.fire({
        //                 icon: "error",
        //                 title: "Error al guardar al usuario :(",
        //                 text: "error...",
        //                 showConfirmButton: false,
        //                 timer: 2000,
        //             }).then(function() {
        //                 window.location = "./index.php";
        //             });';
        //         echo '</script>';
        //         // si se actualizo
        //     } else {
        //         $idUser = $con->lastInsertId();
        //         echo $idUser;
        //         $stmt2 = $con->prepare("UPDATE empleados
        //                                 SET departamento = :departamento, usuarioSistema = :usuarioSistema 
        //                                 WHERE id_empleado = :empleado");
        //         $stmt2->bindParam(':departamento', $id_departamento);
        //         $stmt2->bindParam(':empleado', $id);
        //         $stmt2->bindParam(':usuarioSistema', $idUser);
        //         $stmt2->execute();
        //         $actualizado = $stmt2->rowCount();

        //         if ($actualizado) {
        //             echo '<script language="javascript"> ';
        //             echo 'Swal.fire({
        //                                                 icon: "success",
        //                                                 title: "USUARIO AGREGADO",
        //                                                 text: "Usuario ' . $usuario . ' Agreegado al sistema Oxilive",
        //                                                 showConfirmButton: false,
        //                                                 timer: 3000,
        //                                             }).then(function() {
        //                                                 window.location = "./index.php";
        //                                             });';

        //             echo '</script>';
        //         } else {
        //             echo '<script language="javascript"> ';
        //             echo 'Swal.fire({
        //                                                 icon: "error",
        //                                                 title: "error rico",
        //                                                 text: "error en el registro de este wey",
        //                                                 showConfirmButton: false,
        //                                                 timer: 3000,
        //                                             }).then(function() {
        //                                                 window.location = "./index.php";
        //                                             });';

        //             echo '</script>';
        //         }
        //     }
        // }
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
            window.location = "../pages/crear.php";
        });';
    echo '</script>';
}
