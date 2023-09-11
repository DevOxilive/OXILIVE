<?php
include ("../../connection/conexion.php");
include_once '../../templates/hea.php';
if($_POST){

    //Recolectamos los datos del metodo POST
    $Nombredelpuestos=(isset($_POST["Nombredelpuestos"])?$_POST["Nombredelpuestos"]:"");

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
   window.location = "crear.php";
       });';
        echo '</script>';
    } else{
    //Preparamos la inserccion de los datos
    $sentencia=$con->prepare("INSERT INTO puestos(id_puestos,Nombre_puestos)
                VALUES (null, :Nombredelpuestos)");
    
    //Asigando los valores del metodo POST
    $sentencia->bindParam(":Nombredelpuestos",$Nombredelpuestos);
    $sentencia->execute();
    echo '<script language="javascript"> ';
        echo 'Swal.fire({
            icon: "success",
           title: "PUESTO AGREGADO",
           showConfirmButton: false,
           timer: 1500,
       }).then(function() {
   window.location = "index.php";
       });';
        echo '</script>';
    }
}
?>