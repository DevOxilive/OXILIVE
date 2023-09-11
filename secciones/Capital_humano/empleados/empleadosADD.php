<?php
include("../../../connection/conexion.php");
include_once '../../../templates/hea.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $Nombres = (isset($_POST["Nombres"]) ? $_POST["Nombres"] : "");
    $Apellidos = (isset($_POST["Apellidos"]) ? $_POST["Apellidos"] : "");
    $Edad = (isset($_POST["Edad"]) ? $_POST["Edad"] : "");
    $Fecha_nacimiento = (isset($_POST["Fecha_nacimiento"]) ? $_POST["Fecha_nacimiento"] : "");
    $Genero = (isset($_POST["Genero"]) ? $_POST["Genero"] : "");
    $Telefono = (isset($_POST["Telefono"]) ? $_POST["Telefono"] : "");
    $Seguro_social = (isset($_FILES["Seguro_social"]['name']) ? $_FILES["Seguro_social"]['name'] : "");
    $rfc = (isset($_POST["rfc"]) ? $_POST["rfc"] : "");
    $Acta_nacimiento = (isset($_FILES["Acta_nacimiento"]['name']) ? $_FILES["Acta_nacimiento"]['name'] : "");
    $Comprobante_domicilio = (isset($_FILES["Comprobante_domicilio"]['name']) ? $_FILES["Comprobante_domicilio"]['name'] : "");
    $Curp = (isset($_FILES["Curp"]['name']) ? $_FILES["Curp"]['name'] : "");
    $Titulo = (isset($_FILES["Titulo"]['name']) ? $_FILES["Titulo"]['name'] : "");
    $Cedula = (isset($_FILES["Cedula"]['name']) ? $_FILES["Cedula"]['name'] : "");
    $Carta_recomendacion1 = (isset($_FILES["Carta_recomendacion1"]['name']) ? $_FILES["Carta_recomendacion1"]['name'] : "");
    $Carta_recomendacion2 = (isset($_FILES["Carta_recomendacion2"]['name']) ? $_FILES["Carta_recomendacion2"]['name'] : "");
    $ine = (isset($_FILES["ine"]['name']) ? $_FILES["ine"]['name'] : "");
    $Banco = (isset($_POST["Banco"]) ? $_POST["Banco"] : "");
    $No_cuenta = (isset($_POST["No_cuenta"]) ? $_POST["No_cuenta"] : "");
    $Puesto = (isset($_POST["Puesto"]) ? $_POST["Puesto"] : "");
    
    $consulta = $con->prepare("SELECT * FROM empleados WHERE rfc = '$rfc' ");
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
        $sentencia = $con->prepare("INSERT INTO  `empleados` (`id_empleados`, `Nombres`, `Apellidos`, `Edad`, `Fecha_nacimiento`, `Genero`, `Telefono`, `Seguro_social`, `rfc`, `Acta_nacimiento`, `Comprobante_domicilio`, `Curp`, `Titulo`,`Cedula`,`Carta_recomendacion1`,`Carta_recomendacion2`,`ine`,`Banco`,`No_cuenta`,`Puesto`) 
        VALUES (Null, :Nombres, :Apellidos, :Edad, :Fecha_nacimiento, :Genero, :Telefono, :Seguro_social, :rfc, :Acta_nacimiento, :Comprobante_domicilio , :Curp , :Titulo, :Cedula, :Carta_recomendacion1, :Carta_recomendacion2, :ine, :Banco, :No_cuenta, :Puesto);");
        $sentencia->bindParam(":Nombres", $Nombres);
        $sentencia->bindParam(":Apellidos",$Apellidos);
        $sentencia->bindParam(":Edad", $Edad);
        $sentencia->bindParam(":Fecha_nacimiento", $Fecha_nacimiento);
        $sentencia->bindParam(":Genero", $Genero);
        $sentencia->bindParam(":Telefono", $Telefono);
        $sentencia->bindParam(":rfc", $rfc);


        $fecha_Seguro_social = new DateTime();
        $nombre_Seguro_social_orginal = ($fecha_Seguro_social != '') ? $fecha_Seguro_social->getTimestamp()."_".$_FILES["Seguro_social"]['name']:"";
        $tmp_Seguro_social = $_FILES["Seguro_social"]['tmp_name'];

        $fecha_Acta_nacimiento = new DateTime();
        $nombre_Acta_nacimiento_orginal = ($fecha_Acta_nacimiento != '') ? $fecha_Acta_nacimiento->getTimestamp()."_".$_FILES["Acta_nacimiento"]['name']:"";
        $tmp_Acta_nacimiento = $_FILES["Acta_nacimiento"]['tmp_name'];

        $fecha_Comprobante_domicilio = new DateTime();
        $nombre_Comprobante_domicilio_orginal = ($fecha_Comprobante_domicilio != '') ? $fecha_Comprobante_domicilio->getTimestamp()."_".$_FILES["Comprobante_domicilio"]['name']:"";
        $tmp_Comprobante_domicilio = $_FILES["Comprobante_domicilio"]['tmp_name'];

        $fecha_Curp = new DateTime();
        $nombre_Curp_orginal = ($fecha_Curp != '') ? $fecha_Curp->getTimestamp()."_".$_FILES["Curp"]['name']:"";
        $tmp_Curp = $_FILES["Curp"]['tmp_name'];

        $fecha_Titulo = new DateTime();
        $nombre_Titulo_orginal = ($fecha_Titulo != '') ? $fecha_Titulo->getTimestamp()."_".$_FILES["Titulo"]['name']:"";
        $tmp_Titulo = $_FILES["Titulo"]['tmp_name'];

        $fecha_Cedula = new DateTime();
        $nombre_Cedula_orginal = ($fecha_Cedula != '') ? $fecha_Cedula->getTimestamp()."_".$_FILES["Cedula"]['name']:"";
        $tmp_Cedula = $_FILES["Cedula"]['tmp_name'];

        $fecha_Carta_recomendacion1 = new DateTime();
        $nombre_Carta_recomendacion1_orginal = ($fecha_Carta_recomendacion1 != '') ? $fecha_Carta_recomendacion1->getTimestamp()."_".$_FILES["Carta_recomendacion1"]['name']:"";
        $tmp_Carta_recomendacion1 = $_FILES["Carta_recomendacion1"]['tmp_name'];

        $fecha_Carta_recomendacion2 = new DateTime();
        $nombre_Carta_recomendacion2_orginal = ($fecha_Carta_recomendacion2 != '') ? $fecha_Carta_recomendacion2->getTimestamp()."_".$_FILES["Carta_recomendacion2"]['name']:"";
        $tmp_Carta_recomendacion2 = $_FILES["Carta_recomendacion2"]['tmp_name'];

        $fecha_ine = new DateTime();
        $nombre_ine_orginal = ($fecha_ine != '') ? $fecha_ine->getTimestamp()."_".$_FILES["ine"]['name']:"";
        $tmp_ine = $_FILES["ine"]['tmp_name'];

        $sentencia->bindParam(":Banco", $Banco);
        $sentencia->bindParam(":No_cuenta", $No_cuenta);
        $sentencia->bindParam(":Puesto", $Puesto);
    
        
        if ($tmp_Seguro_social != '' && $tmp_Acta_nacimiento != '' && $tmp_Comprobante_domicilio != '' && $tmp_Curp != '' && $tmp_Titulo != '' && $tmp_Cedula != '' && $tmp_Carta_recomendacion1 != '' && $tmp_Carta_recomendacion2 != '' && $tmp_ine != '') {
            $carpeta_usuario = "../../Capital_humano/empleados/EMPLEADOS/".$Apellidos."_".$Nombres;
            if (!is_dir($carpeta_usuario)) {
                mkdir($carpeta_usuario);
            }
    
            move_uploaded_file($tmp_Seguro_social, $carpeta_usuario."/".$nombre_Seguro_social_orginal);
            move_uploaded_file($tmp_Acta_nacimiento, $carpeta_usuario."/".$nombre_Acta_nacimiento_orginal);
            move_uploaded_file($tmp_Comprobante_domicilio, $carpeta_usuario."/".$nombre_Comprobante_domicilio_orginal);
            move_uploaded_file($tmp_Curp, $carpeta_usuario."/".$nombre_Curp_orginal);
            move_uploaded_file($tmp_Titulo, $carpeta_usuario."/".$nombre_Titulo_orginal);
            move_uploaded_file($tmp_Cedula, $carpeta_usuario."/".$nombre_Cedula_orginal);
            move_uploaded_file($tmp_Carta_recomendacion1, $carpeta_usuario."/".$nombre_Carta_recomendacion1_orginal);
            move_uploaded_file($tmp_Carta_recomendacion2, $carpeta_usuario."/".$nombre_Carta_recomendacion2_orginal);
            move_uploaded_file($tmp_ine, $carpeta_usuario."/".$nombre_ine_orginal);
        }
        $sentencia->bindParam(":Seguro_social", $nombre_Seguro_social_orginal);
        $sentencia->bindParam(":Acta_nacimiento", $nombre_Acta_nacimiento_orginal);
        $sentencia->bindParam(":Comprobante_domicilio", $nombre_Comprobante_domicilio_orginal);
        $sentencia->bindParam(":Curp", $nombre_Curp_orginal);
        $sentencia->bindParam(":Titulo", $nombre_Titulo_orginal);
        $sentencia->bindParam(":Cedula", $nombre_Cedula_orginal);
        $sentencia->bindParam(":Carta_recomendacion1", $nombre_Carta_recomendacion1_orginal);
        $sentencia->bindParam(":Carta_recomendacion2", $nombre_Carta_recomendacion2_orginal);
        $sentencia->bindParam(":ine", $nombre_ine_orginal);
        $sentencia->execute();
        echo '<script language="javascript"> ';
        echo 'Swal.fire({
                icon: "success",
                title: "EMPLEADO AGREGADO",
                showConfirmButton: false,
                timer: 1500,
            }).then(function() {
                window.location = "index.php";
                });';
        echo '</script>';
    }
}
?>