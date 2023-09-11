<?php
include("../../../connection/conexion.php");
include_once '../../../templates/hea.php';

if (isset($_GET['txtID'])) {

    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";

    $sentencia = $con->prepare("SELECT * FROM equipo WHERE id_equipo=:id_equipo");
    $sentencia->bindParam(":id_equipo", $txtID);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);


    $nombre = $registro["nombre"];
    $tipo_equipo = $registro["tipo_equipo"];
    $entrego = $registro["entrego"];
    $recibio = $registro["recibio"];
    $no_serie = $registro["no_serie"];
    $IMEI = $registro["IMEI"];
    $autorizo = $registro["autorizo"];
    $observaciones = $registro["observaciones"];

}


if ($_POST) {

    //Recolectamos los datos del metodo POST
    $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
    $Nombredelpuestos = (isset($_POST["Nombre_puestos"]) ? $_POST["Nombre_puestos"] : "");

    $consulta = $con->prepare("SELECT * FROM puestos WHERE Nombre_puestos = '$Nombredelpuestos' ");
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
        $sentencia = $con->prepare("UPDATE puestos 
    SET Nombre_puestos=:Nombre_puestos
                WHERE id_puestos=:id_puestos");

        //Asigando los valores del metodo POST
        $sentencia->bindParam(":Nombre_puestos", $Nombredelpuestos);
        $sentencia->bindParam(":id_puestos", $txtID);
        $sentencia->execute();
        echo '<script language="javascript"> ';
        echo 'Swal.fire({
          icon: "success",
          title: "DATOS GUARDADOS",
          text: "LOS DATOS SE GUARDARON CORRECTAMENTE",
          showConfirmButton: false,
          timer: 2000,
        }).then(function() {
          window.location = "index.php";
          });';
        echo '</script>';
    }

    //Preparamos la inserccion de los datos

}

?>