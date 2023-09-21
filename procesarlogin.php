<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    include_once 'templates/hea.php';
    include_once 'connection/conexion.php';

    $vUsuario = $_POST["txtUsu"];
    $vPassword = $_POST["txtPass"];

    if (!empty($vUsuario) && !empty($vPassword)) {
        $consu = "SELECT * FROM usuarios WHERE BINARY Usuario = :vUsuario AND Estado = 1";
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
<<<<<<< HEAD
=======
            $_SESSION['estado'] = $datos['Estado'];
>>>>>>> 6d5dbd6d0de6675092181156e46e7ed9c17e6ff9

            switch ($datos["id_departamentos"]) {
                case '1':
                    echo "<script> 
                         Swal.fire({
                             icon: 'success',
                            title: 'BIENVENIDO',
                            showConfirmButton: false,
                            timer: 1500,
                        }).then(function() {
                    window.location = 'index.php';
                        });
                </script>";
                    break;
                case '2':
                    echo "<script> 
                         Swal.fire({
                             icon: 'success',
                            title: 'BIENVENIDO',
                            showConfirmButton: false,
                            timer: 1500,
                        }).then(function() {
                    window.location = 'secciones/Padministradora/index.php';
                        });
                </script>";
                    break;
                    case '3':
                        echo "<script> 
                             Swal.fire({
                                 icon: 'success',
                                title: 'BIENVENIDO',
                                showConfirmButton: false,
                                timer: 1500,
                            }).then(function() {
                        window.location = 'secciones/sistemas/index.php';
                            });
                    </script>";
                        break;
                    case '4':
                        echo "<script> 
                             Swal.fire({
                                 icon: 'success',
                                title: 'BIENVENIDO',
                                showConfirmButton: false,
                                timer: 1500,
                            }).then(function() {
                        window.location = 'secciones/oxigeno/index.php';
                            });
                    </script>";
                        break;
                    case '5':
                        echo "<script> 
                             Swal.fire({
                                 icon: 'success',
                                title: 'BIENVENIDO',
                                showConfirmButton: false,
                                timer: 1500,
                            }).then(function() {
                        window.location = 'secciones/call_center/index.php';
                            });
                    </script>";
                        break;
                    case '6':
                        echo "<script> 
                             Swal.fire({
                                 icon: 'success',
                                title: 'BIENVENIDO',
                                showConfirmButton: false,
                                timer: 1500,
                            }).then(function() {
                        window.location = 'secciones/enfermeria/user/index.php';
                            });
                    </script>";
                        break;
                    case '7':
                        echo "<script> 
                                 Swal.fire({
                                     icon: 'success',
                                    title: 'BIENVENIDO',
                                    showConfirmButton: false,
                                    timer: 1500,
                                }).then(function() {
                            window.location = 'secciones/Capital_humano/index.php';
                                });
                        </script>";
                        break;
                    case '8':
                        echo "<script> 
                             Swal.fire({
                                 icon: 'success',
                                title: 'BIENVENIDO',
                                showConfirmButton: false,
                                timer: 1500,
                            }).then(function() {
                        window.location = 'secciones/almacen/index.php';
                            });
                    </script>";
                        break;
                    case '9':
                        echo "<script> 
                            Swal.fire({
                                icon: 'success',
                                title: 'BIENVENIDO',
                                showConfirmButton: false,
                                timer: 1500,
                                backdrop: `
                                rgba(142,196,149,0.05)
                                  url('img/pchofer.gif')
                                  center top
                                  no-repeat
                                `
                              }).then(function() {
                            window.location = 'secciones/Pchofer/index.php';
                                });
                        </script>";
                        break;
                        case '10':
                            echo "<script> 
                                 Swal.fire({
                                     icon: 'success',
                                    title: 'BIENVENIDO',
                                    showConfirmButton: false,
                                    timer: 1500,
                                }).then(function() {
                            window.location = 'secciones/catalogo/index.php';
                                });
                        </script>";
                            break;
                default:
                    redirectTo('index.php');
                    break;
            }
        } else {
            echo "<script> 
                            Swal.fire({
                                icon: 'error',
                                title: 'CAMPOS INCORRECTOS',
                                text: 'Usuario y/o Contraseña incorrecto(s)',
                                showConfirmButton: false,
                                timer: 2000,
                            }).then(function() {
                                window.location = 'login.php';
                            });
                        </script>";
        }
    } else {
        showErrorAlert("Los campos no deben ir vacíos.");
    }
}

function redirectTo($location) {
    echo "<script>
        window.location = '$location';
    </script>";
}

function showErrorAlert($message) {
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '$message',
            showConfirmButton: false,
            timer: 2000,
        }).then(function() {
            window.location = 'login.php';
        });
    </script>";
}
?>