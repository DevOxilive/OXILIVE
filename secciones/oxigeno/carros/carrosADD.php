<?php 
include("../../../connection/conexion.php");
include_once '../../../templates/hea.php';
if($_POST){
   
    $Nombre_carro=(isset($_POST["Nombre_carro"])?$_POST["Nombre_carro"]:"");
    $Nombredelmodelo=(isset($_POST["Nombredelmodelo"])?$_POST["Nombredelmodelo"]:"");
    $Marca=(isset($_POST["Marca"])?$_POST["Marca"]:"");
    $Placas=(isset($_POST["Placas"])?$_POST["Placas"]:"");

    $consulta = $con->prepare("SELECT * FROM carros WHERE Nombre_carro = '$Nombre_carro' and modelo ='$Nombredelmodelo' and marca = '$Marca' and placa='$Placas' and estado = 1");
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
    $sentencia=$con->prepare("INSERT INTO 
                            `carros` (`id_carro`, `Nombre_carro`, `modelo`, `marca`, `placa`,  `estado`) 
                            VALUES (Null, :Nombre_carro ,:Nombredelmodelo, :Marca, :Placas,  1);");
    $sentencia->bindParam(":Nombre_carro",$Nombre_carro);
    $sentencia->bindParam(":Nombredelmodelo",$Nombredelmodelo);
    $sentencia->bindParam(":Marca",$Marca);
    $sentencia->bindParam(":Placas",$Placas);
    $sentencia->execute(); 
    echo '<script language="javascript"> ';
        echo 'Swal.fire({
                icon: "success",
                title: "CARRO AGREGADO",
                showConfirmButton: false,
                timer: 1500,
            }).then(function() {
                window.location = "index.php";
                });';
        echo '</script>';
    }
}   
?>