<?php
include("../../../templates/hea.php");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $correo = $_POST['correo'];
    $pass = $_POST['pass'];
    $tel1 = $_POST['telefonoUno'];
    $tel2 = $_POST['telefonoDos'];
    $fotoNueva = $_FILES['Foto_perfil']['name'];

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
            $mensaje .= "$correo<br>";
        }
        if (!empty($pass)) {
            $mensaje .= "$pass<br>";
        }
        if (!empty($tel1)) {
            $mensaje .= "$tel1<br>";
        }
        if (!empty($tel2)) {
            $mensaje .= "$tel2<br>";
        }
        if (!empty($fotoNueva)) {
            $mensaje .= "$fotoNueva<br>";
        }
        echo $mensaje;
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
