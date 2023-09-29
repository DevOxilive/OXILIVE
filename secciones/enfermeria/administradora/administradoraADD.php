<?php
include("../../../connection/conexion.php");
include_once '../../../templates/hea.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //EN ESTA PARTE DEL CODIGO SE VERIFICA SI NO EXISTEN NINGUN DATO IGUAL A LA BASE DE DATOS
    $Nombre_administradora = (isset($_POST["Nombre_administradora"]) ? $_POST["Nombre_administradora"] : "");
    $cpt = (isset($_POST['cpt']) ? $_POST["cpt"] : "");
    $des = (isset($_POST['des1']) ? $_POST["des1"] : "");
    $unidad = (isset($_POST['unidad']) ? $_POST["unidad"] : "");

    $cpt2 = (isset($_POST['cpt2']) ? $_POST["cpt2"] : "");
    $des2 = (isset($_POST['des2']) ? $_POST["des2"] : "");
    $unidad2 = (isset($_POST['unidad2']) ? $_POST["unidad2"] : "");

    $cpt3 = (isset($_POST['cpt3']) ? $_POST["cpt3"] : "");
    $des3 = (isset($_POST['des3']) ? $_POST["des3"] : "");
    $unidad3 = (isset($_POST['unidad3']) ? $_POST["unidad3"] : "");

    $cpt4 = (isset($_POST['cpt4']) ? $_POST["cpt4"] : "");
    $des4 = (isset($_POST['des4']) ? $_POST["des4"] : "");
    $unidad4 = (isset($_POST['unidad4']) ? $_POST["unidad4"] : "");

    $cpt5 = (isset($_POST['cpt5']) ? $_POST["cpt5"] : "");
    $des5 = (isset($_POST['des5']) ? $_POST["des5"] : "");
    $unidad5 = (isset($_POST['unidad5']) ? $_POST["unidad5"] : "");

    $cpt6 = (isset($_POST['cpt6']) ? $_POST["cpt6"] : "");
    $des6 = (isset($_POST['des6']) ? $_POST["des6"] : "");
    $unidad6 = (isset($_POST['unidad6']) ? $_POST["unidad6"] : "");

    $consulta = $con->prepare("SELECT * FROM admi_enfer WHERE
    Nombre_admi = :Nombre_admi 
    AND cpt_admi = :cpt_admi  AND des1=:des1 AND unidad  =:unidad
    AND cpt2 = :cpt2 AND des2 = :des2 AND unidad2 = :unidad2 
    AND cpt3 = :cpt3 AND des3 = :des3 AND unidad3 = :unidad3 
    AND cpt4 = :cpt4 AND des4 = :des4 AND unidad4 = :unidad4 
    AND cpt5 = :cpt5 AND des5 = :des5 AND unidad5 = :unidad5 
    AND cpt6 = :cpt6 AND des6 = :des6 AND unidad6 = :unidad6 
");
$consulta->bindParam(":Nombre_admi", $Nombre_administradora);
$consulta->bindParam(":cpt_admi", $cpt);
$consulta->bindParam(":des1", $des);
$consulta->bindParam(":unidad", $unidad);
$consulta->bindParam(":cpt2", $cpt2);
$consulta->bindParam(":des2", $des2);
$consulta->bindParam(":unidad2", $unidad2);
$consulta->bindParam(":cpt3", $cpt3);
$consulta->bindParam(":des3", $des3);
$consulta->bindParam(":unidad3", $unidad3);
$consulta->bindParam(":cpt4", $cpt4);
$consulta->bindParam(":des4", $des4);
$consulta->bindParam(":unidad4", $unidad4);
$consulta->bindParam(":cpt5", $cpt5);
$consulta->bindParam(":des5", $des5);
$consulta->bindParam(":unidad5", $unidad5);
$consulta->bindParam(":cpt6", $cpt6);
$consulta->bindParam(":des6", $des6);
$consulta->bindParam(":unidad6", $unidad6);
$consulta->execute();

    $resul = $consulta->rowCount();
    if ($resul > 0) {
        echo '<script language="javascript"> ';
        echo 'Swal.fire({
                icon: "warning",
                title: "DUPLICADO",
                text: "El dato ingresado ya existe",
                showConfirmButton: false,
                timer: 2000,
            }).then(function() {
                window.location = "index.php";
                });';
        echo '</script>';
    } else {
        //AQUI INSERTA LO QUE LA ADMINISTRASORA SI NO EXISTE ESE NOMBRE DE ADMINISTRADORA.
        $sentencia = $con->prepare("INSERT INTO admi_enfer(id_admi_enfer, Nombre_admi, cpt_admi, des1, unidad, cpt2, des2, unidad2, cpt3, des3, unidad3, cpt4, des4, unidad4, cpt5, des5, unidad5, cpt6, des6, unidad6)
        VALUES (null, :Nombre_admi, :cpt, :des1, :unidad, :cpt2, :des2, :unidad2, :cpt3, :des3, :unidad3, :cpt4, :des4, :unidad4, :cpt5, :des5, :unidad5, :cpt6, :des6, :unidad6)");
        $sentencia->bindParam(":Nombre_admi", $Nombre_administradora);
        $sentencia->bindParam(":cpt", $cpt);
        $sentencia->bindParam(":des1", $des);
        $sentencia->bindParam(":unidad", $unidad);
        $sentencia->bindParam(":cpt2", $cpt2);
        $sentencia->bindParam(":des2", $des2);
        $sentencia->bindParam(":unidad2", $unidad2);
        $sentencia->bindParam(":cpt3", $cpt3);
        $sentencia->bindParam(":des3", $des3);
        $sentencia->bindParam(":unidad3", $unidad3);
        $sentencia->bindParam(":cpt4", $cpt4);
        $sentencia->bindParam(":des4", $des4);
        $sentencia->bindParam(":unidad4", $unidad4);
        $sentencia->bindParam(":cpt5", $cpt5);
        $sentencia->bindParam(":des5", $des5);
        $sentencia->bindParam(":unidad5", $unidad5);
        $sentencia->bindParam(":cpt6", $cpt6);
        $sentencia->bindParam(":des6", $des6);
        $sentencia->bindParam(":unidad6", $unidad6);


        $sentencia->execute();
        echo '<script language="javascript"> ';
        echo 'Swal.fire({
                icon: "success",
                title: "ADMINISTRADORA AGREGADA CON SUS CPTS",
                showConfirmButton: false,
                timer: 1500,
            }).then(function() {
                window.location = "index.php";
                });';
        echo '</script>';
    }
}
?>