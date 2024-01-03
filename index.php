<!-- esto se hizo en una plantila -->
<?php
session_start();
//AQUI SE INDICA QUE SI EL PUESTO ES A ADMINISTRADOR PERTENECE A ESTA VISTA INICIO-
switch ($_SESSION['puesto']) {
    case 1:
        include("templates/header.php");
        include("connection/conexion.php");
?>
        <main name="main" id="main">
            <div class="card">
                <div class="card-body" style="text-align:center; padding-top: 4rem;">
                    <img src="img/404.png" alt="Not Found" height="auto" width="460">

                    <h3 style="text-align: center;">Lo siento, por el momento no existe esta página. Seguimos trabajando para mostrarte lo mejor.</h3>
                </div>
            </div>
        </main>
<?php
        include("templates/footer.php");
        break;
    case 2:
        header('Location: secciones/Padministradora/index.php');
        break;
    case 3:
        header('Location: secciones/sistemas/index.php');
        break;
    case 4:
        header('Location: secciones/oxigeno/index.php');
        break;
    case 5:
        header('Location: secciones/call_center/index.php');
        break;
    case 6:
        header('Location: secciones/enfermeria/user/index.php');
        break;
    case 7:
        header('Location: secciones/Capital_humano/index.php');
        break;
    case 8:
        header('Location: secciones/almacen/index.php');
        break;
    case 9:
        header('Location: secciones/Pchofer/index.php');
        break;
    case 10:
        header('Location: secciones/enfermeria/index.php');
        break;
    case 11:
        header('Location: secciones/enfermeria/user/index.php');
        break;
    case 12:
        header('Location: secciones/call_center/index.php');
        break;
    default:
        header('Location: login.php');
        break;
}
?>