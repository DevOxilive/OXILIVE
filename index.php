<!-- esto se hizo en una plantila -->
<?php
session_start();

switch ($_SESSION['puesto']) {
        //Administrador
    case 1:
        include("templates/header.php");
        include("connection/conexion.php");
        include("templates/404.php");
        $notificacion = new Notificacion("", "");
        echo $notificacion->notificar();
        include("templates/footer.php");
        break;
        //Administradora POR REVISAR
    case 2:
        header('Location: secciones/Padministradora/index.php');
        break;
        //Sistemas
    case 3:
        header('Location: secciones/sistemas/index.php');
        break;
        //Oxígeno
    case 4:
        header('Location: secciones/oxigeno/index.php');
        break;
        //Call Center
    case 5:
        header('Location: secciones/call_center/index.php');
        break;
        //Enfermeria
    case 6:
        header('Location: secciones/enfermeria/index.php');
        break;
        //Capital Humano
    case 7:
        header('Location: secciones/Capital_humano/index.php');
        break;
        //Almacen
    case 8:
        header('Location: secciones/almacen/index.php');
        break;
        //Chofer
    case 9:
        header('Location: secciones/Pchofer/index.php');
        break;
        //Cliente POR REVISAR
    case 10:
        header('Location: secciones/enfermeria/index.php');
        break;
        //Enfermero
    case 11:
        header('Location: secciones/enfermeria/user/index.php');
        break;
        //Médico
    case 12:
        header('Location: secciones/call_center/user/index.php');
        break;
    default:
        header('Location: login.php');
        break;
}
?>