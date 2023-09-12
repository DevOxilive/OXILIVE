<?php
include("../../../connection/conexion.php");
include_once '../../../templates/hea.php';

if (isset($_GET['txtID'])) {

    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";

    $sentencia = $con->prepare("SELECT * FROM pacientes_oxigeno WHERE id_pacientes=:id_pacientes");
    $sentencia->bindParam(":id_pacientes", $txtID);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);

    //Traer los datos en la DB
    $Nombres = $registro["Nombres"];
    $Apellidos = $registro["Apellidos"];
    $genero = $registro["Genero"];
    $Edad = $registro["Edad"];
    $calle = $registro["calle"];
    $responsable = $registro["responsable"];
    $rfc = $registro["rfc"];
    $estado_direccion = $registro["estado_direccion"];
    $municipio = $registro["municipio"];
    $cp = $registro["cp"];
    $num_in = $registro["num_in"];
    $num_ext = $registro["num_ext"];
    $colonia = $registro["colonia"];
    $Telefono = $registro["Telefono"];
    $Administradora = $registro["Administradora"];
    $Alcaldia = $registro["Alcaldia"];
    $Aseguradora = $registro["Aseguradora"];
    $banco = $registro["Banco"];
    $Nomina = $registro["No_nomina"];
    //$Credencial_front = $registro["Credencial_front"];
    //$Credencial_post = $registro["Credencial_post"];
    $Credencial_aseguradora = $registro["Credencial_aseguradora"];
    $Credencial_aseguradoras_post = $registro["Credencial_aseguradoras_post"];
    $comprobante = $registro["comprobante"];
    $referencias = $registro["referencias"];
}


if ($_POST) {

    $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
    $Nombres = (isset($_POST["Nombres"]) ? $_POST["Nombres"] : "");
    $Apellidos = (isset($_POST["Apellidos"]) ? $_POST["Apellidos"] : "");
    $genero = (isset($_POST["genero"]) ? $_POST["genero"] : "");
    $Edad = (isset($_POST["Edad"]) ? $_POST["Edad"] : "");
    $Alcaldia = (isset($_POST["Alcaldia"]) ? $_POST["Alcaldia"] : "");
    $Telefono = (isset($_POST["Telefono"]) ? $_POST["Telefono"] : "");
    $Administradora = (isset($_POST["Administradora"]) ? $_POST["Administradora"] : "");
    $Aseguradora = (isset($_POST["Aseguradora"]) ? $_POST["Aseguradora"] : "");
    $banco = (isset($_POST["banco"]) ? $_POST["banco"] : "");
    $Nomina = (isset($_POST["Nomina"]) ? $_POST["Nomina"] : "");
    $referencias = (isset($_POST["referencias"]) ? $_POST["referencias"] : "");
    $calle = (isset($_POST["calle"]) ? $_POST["calle"] : "");
    $num_in = (isset($_POST["num_in"]) ? $_POST["num_in"] : "");
    $num_ext = (isset($_POST["num_ext"]) ? $_POST["num_ext"] : "");
    $colonia = (isset($_POST["colonia"]) ? $_POST["colonia"] : "");
    $cp = (isset($_POST["cp"]) ? $_POST["cp"] : "");
    $municipio = (isset($_POST["municipio"]) ? $_POST["municipio"] : "");
    $estado_direccion = (isset($_POST["estado_direccion"]) ? $_POST["estado_direccion"] : "");
    $rfc = (isset($_POST["rfc"]) ? $_POST["rfc"] : "");
    $responsable = (isset($_POST["responsable"]) ? $_POST["responsable"] : "");


    $sentencia = $con->prepare("UPDATE pacientes_oxigeno
                            SET Nombres=:Nombres, Apellidos=:Apellidos,calle=:calle,num_in=:num_in,num_ext=:num_ext,colonia=:colonia,cp=:cp,municipio=:municipio,estado_direccion=:estado_direccion,rfc=:rfc,responsable=:responsable ,Genero=:genero, Edad=:Edad, Alcaldia=:Alcaldia, Telefono=:Telefono, Administradora=:Administradora, Aseguradora=:Aseguradora, Banco=:banco, No_nomina=:Nomina, referencias=:referencias
                            WHERE id_pacientes=:id_pacientes");

    $sentencia->bindParam(":Nombres", $Nombres);
    $sentencia->bindParam(":Apellidos", $Apellidos);
    $sentencia->bindParam(":genero", $genero);
    $sentencia->bindParam(":Edad", $Edad);
    $sentencia->bindParam(":Alcaldia", $Alcaldia);
    $sentencia->bindParam(":Telefono", $Telefono);
    $sentencia->bindParam(":Administradora", $Administradora);
    $sentencia->bindParam(":Aseguradora", $Aseguradora);
    $sentencia->bindParam(":banco", $banco);
    $sentencia->bindParam(":Nomina", $Nomina);
    $sentencia->bindParam(":referencias", $referencias);
    $sentencia->bindParam(":calle", $calle);
    $sentencia->bindParam(":num_in", $num_in);
    $sentencia->bindParam(":num_ext", $num_ext);
    $sentencia->bindParam(":colonia", $colonia);
    $sentencia->bindParam(":cp", $cp);
    $sentencia->bindParam(":municipio", $municipio);
    $sentencia->bindParam(":estado_direccion", $estado_direccion);
    $sentencia->bindParam(":rfc", $rfc);
    $sentencia->bindParam(":responsable", $responsable);
    $sentencia->bindParam(":id_pacientes", $txtID);
    $sentencia->execute();

    $carpeta_usuario = "./PAPELETA/" . $Apellidos . " " . $Nombres;
    $otra_ruta = "../../Padministradora/pacientes/PAPELETA/" . $Apellidos . " " . $Nombres; 
    
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
        //"Credencial_front",
        //"Credencial_post",
        "Credencial_aseguradora",
        "Credencial_aseguradoras_post",
        "comprobante",
    );
    
    foreach ($campos_archivos as $campo_archivo) {
        $nombre_archivo = (isset($_FILES[$campo_archivo]['name']) ? $_FILES[$campo_archivo]['name'] : "");
        $fecha_archivo = new DateTime();
        $nombre_archivo_original = (!empty($nombre_archivo) ? $fecha_archivo->getTimestamp() . "_" . $nombre_archivo : "");
        $tmp_archivo = $_FILES[$campo_archivo]['tmp_name'];
    
        $archivo_guardado = guardarArchivo($tmp_archivo, $nombre_archivo_original, $carpeta_usuario);
    
        if (!empty($archivo_guardado)) {
            $sentencia = $con->prepare("SELECT $campo_archivo FROM `pacientes_oxigeno` WHERE id_pacientes=:id_pacientes");
            $sentencia->bindParam(":id_pacientes", $txtID);
            $sentencia->execute();
            $registro_recuperado = $sentencia->fetch(PDO::FETCH_ASSOC);
    
            if (isset($registro_recuperado[$campo_archivo])) {
                $ruta_archivo = $carpeta_usuario . "/" . $registro_recuperado[$campo_archivo];
                if (file_exists($ruta_archivo)) {
                    unlink($ruta_archivo);
                }
            }
    
            $sentencia = $con->prepare("UPDATE pacientes_oxigeno SET $campo_archivo=:archivo WHERE id_pacientes=:id_pacientes");
            $sentencia->bindParam(":archivo", $archivo_guardado);
            $sentencia->bindParam(":id_pacientes", $txtID);
            $sentencia->execute();
    
            $ruta_destino_otra = $otra_ruta . "../../enfermeria/hojaComplementaria/PAPELETA/" . $nombre_archivo_original;
            if (!empty($archivo_guardado)) {
                if (file_exists($ruta_destino_otra)) {
                    unlink($ruta_destino_otra);
                }
                copy($carpeta_usuario . "/" . $nombre_archivo_original, $ruta_destino_otra);
            }
        }
    }
    

    echo '<script language="javascript"> ';
    echo 'Swal.fire({
        icon: "success",
        title: "DATOS MODIFICADOS",
        showConfirmButton: false,
        timer: 1500,
    }).then(function() {
        window.location = "index.php";
        });';
    echo '</script>';
}
