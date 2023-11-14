<?php
include("../../../../connection/conexion.php");
include_once '../../../../templates/hea.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //EN ESTA PARTE DEL CODIGO SE VERIFICA SI NO EXISTEN NINGUN DATO IGUAL A LA BASE DE DATOS
    $Nombre_administradora = (isset($_POST["Nombre_administradora"]) ? $_POST["Nombre_administradora"] : "");
    $consulta = $con->prepare("SELECT * FROM administradora WHERE Nombre_administradora = '$Nombre_administradora' ");
    $consulta->execute();
    $resul = $consulta->rowCount();
    if ($resul > 0) {
        echo '<script language="javascript"> ';
        echo 'Swal.fire({
                icon: "warning",
                title: "DUPLICADO",
                text: "La administradora ya existe",
                showConfirmButton: false,
                timer: 2000,
            }).then(function() {
                window.location = "index.php";
                });';
        echo '</script>';
    } else {
        //AQUI INSERTA LO QUE LA ADMINISTRASORA SI NO EXISTE ESE NOMBRE DE ADMINISTRADORA.
        $sentencia = $con->prepare("INSERT INTO administradora(id_administradora,Nombre_administradora)
                VALUES (null, :Nombre_administradora)");
        $sentencia->bindParam(":Nombre_administradora", $Nombre_administradora);
        $sentencia->execute();
        echo '<script language="javascript"> ';
        echo 'Swal.fire({
                icon: "success",
                title: "ADMINISTRADORA AGREGADA",
                showConfirmButton: false,
                timer: 1500,
            }).then(function() {
                window.location = "index.php";
                });';
        echo '</script>';
    }
}
?>