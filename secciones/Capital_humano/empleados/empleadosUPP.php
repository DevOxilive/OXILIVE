<?php
include("../../../connection/conexion.php");
include("../../../templates/hea.php");

if (isset($_GET['txtID'])) {

    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";

    $sentencia = $con->prepare("SELECT * FROM empleados WHERE id_empleados=:id_empleados");
    $sentencia->bindParam(":id_empleados", $txtID);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);

    //Traer los datos en la DB
    $Nombres = $registro["Nombres"];
    $Apellidos = $registro["Apellidos"];
    $Edad = $registro["Edad"];
    $Fecha_nacimiento = $registro["Fecha_nacimiento"];
    $Genero = $registro["Genero"];
    $Telefono = $registro["Telefono"];
    $Seguro_social = $registro["Seguro_social"];
    $rfc = $registro["rfc"];
    $Acta_nacimiento = $registro["Acta_nacimiento"];
    $Comprobante_domicilio = $registro["Comprobante_domicilio"];
    $Curp = $registro["Curp"];
    $Titulo = $registro["Titulo"];
    $Cedula = $registro["Cedula"];
    $Carta_recomendacion1 = $registro["Carta_recomendacion1"];
    $Carta_recomendacion2 = $registro["Carta_recomendacion2"];
    $ine = $registro["ine"];
    $Banco = $registro["Banco"];
    $No_cuenta = $registro["No_cuenta"];
    $Puesto = $registro["Puesto"];
}


if ($_POST) {

    $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
    $Nombres = (isset($_POST["Nombres"]) ? $_POST["Nombres"] : "");
    $Apellidos = (isset($_POST["Apellidos"]) ? $_POST["Apellidos"] : "");
    $Edad = (isset($_POST["Edad"]) ? $_POST["Edad"] : "");
    $Fecha_nacimiento = (isset($_POST["Fecha_nacimiento"]) ? $_POST["Fecha_nacimiento"] : "");
    $Genero = (isset($_POST["Genero"]) ? $_POST["Genero"] : "");
    $Telefono = (isset($_POST["Telefono"]) ? $_POST["Telefono"] : "");
    $rfc = (isset($_POST["rfc"]) ? $_POST["rfc"] : "");
    $Banco = (isset($_POST["Banco"]) ? $_POST["Banco"] : "");
    $No_cuenta = (isset($_POST["No_cuenta"]) ? $_POST["No_cuenta"] : "");
    $Puesto = (isset($_POST["Puesto"]) ? $_POST["Puesto"] : "");

    $sentencia = $con->prepare("UPDATE empleados
                            SET Nombres=:Nombres, Apellidos=:Apellidos, Edad=:Edad, Fecha_nacimiento=:Fecha_nacimiento, Genero=:Genero, Telefono= :Telefono, rfc=:rfc, Banco=:Banco, No_cuenta=:No_cuenta, Puesto=:Puesto
                            WHERE id_empleados=:id_empleados");

    $sentencia->bindParam(":Nombres", $Nombres);
    $sentencia->bindParam(":Apellidos", $Apellidos);
    $sentencia->bindParam(":Edad", $Edad);
    $sentencia->bindParam(":Fecha_nacimiento", $Fecha_nacimiento);
    $sentencia->bindParam(":Genero", $Genero);
    $sentencia->bindParam(":Telefono", $Telefono);
    $sentencia->bindParam(":rfc", $rfc);
    $sentencia->bindParam(":Banco", $Banco);
    $sentencia->bindParam(":No_cuenta", $No_cuenta);
    $sentencia->bindParam(":Puesto", $Puesto);
    $sentencia->bindParam(":id_empleados", $txtID);
    $sentencia->execute();


    $carpeta_usuario = "../../Capital_humano/empleados/EMPLEADOS/".$Apellidos."_".$Nombres;

    function guardarArchivo($tmp_file, $nombre_original, $carpeta_usuario) {
        if (!empty($nombre_original) && $tmp_file != '') {
            if (!file_exists($carpeta_usuario)) {
                mkdir($carpeta_usuario, 0777, true);
            }
            $ruta_destino = $carpeta_usuario . "/" . $nombre_original;
            if (move_uploaded_file($tmp_file, $ruta_destino)) {
                return $nombre_original;
            }
        }
        return "";
    }
    
    $campos_archivos = array(
        "Seguro_social",
        "Acta_nacimiento",
        "Comprobante_domicilio",
        "Curp",
        "Titulo",
        "Cedula",
        "Carta_recomendacion1",
        "Carta_recomendacion2",
        "ine",
    );
    
    foreach ($campos_archivos as $campo_archivo) {
        $nombre_archivo = (isset($_FILES[$campo_archivo]['name']) ? $_FILES[$campo_archivo]['name'] : "");
        $fecha_archivo = new DateTime();
        $nombre_archivo_original = (!empty($nombre_archivo) ? $fecha_archivo->getTimestamp() . "_" . $nombre_archivo : "");
        $tmp_archivo = $_FILES[$campo_archivo]['tmp_name'];
    
        $archivo_guardado = guardarArchivo($tmp_archivo, $nombre_archivo_original, $carpeta_usuario);
    
        if (!empty($archivo_guardado)) {
            $sentencia = $con->prepare("SELECT $campo_archivo FROM `empleados` WHERE id_empleados=:id_empleados");
            $sentencia->bindParam(":id_empleados", $txtID);
            $sentencia->execute();
            $registro_recuperado = $sentencia->fetch(PDO::FETCH_ASSOC);
    
            if (isset($registro_recuperado[$campo_archivo])) {
                $ruta_archivo = $carpeta_usuario . "/" . $registro_recuperado[$campo_archivo];
                if (file_exists($ruta_archivo)) {
                    unlink($ruta_archivo);
                }
            }
    
            $sentencia = $con->prepare("UPDATE empleados SET $campo_archivo=:archivo WHERE id_empleados=:id_empleados");
            $sentencia->bindParam(":archivo", $archivo_guardado);
            $sentencia->bindParam(":id_empleados", $txtID);
            $sentencia->execute();
        }
    }
    echo '<script language="javascript"> ';
    echo 'Swal.fire({
            icon: "success",
            title: "DATOS MODIFICADOS ",
            showConfirmButton: false,
            timer: 1500,
        }).then(function() {
            window.location = "index.php";
            });';
    echo '</script>';
}
?>