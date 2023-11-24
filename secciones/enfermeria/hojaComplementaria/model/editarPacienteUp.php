<?php
include("../../../../connection/conexion.php");
include("../../../../templates/hea.php");


if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
    $sentencia = $con->prepare("
    SELECT pa.*, col.id AS colonia_id, col.nombre AS colonia, m.nombre AS municipio, e.nombre AS estadoDir, codigo_postal,bc.id_bancos, bc.Nombre_banco, ad.Nombre_administradora
    FROM pacientes_call_center pa, colonias col, bancos bc, administradora ad, municipios m, estados e
    WHERE pa.colonia = col.id
    AND col.municipio = m.id
    AND m.estado = e.id
    AND pa.bancosAdmi = bc.id_bancos
    AND bc.admi = ad.id_administradora
    AND pa.id_pacientes = :id_pacientes
    ");
    $sentencia->bindParam(":id_pacientes", $txtID);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_ASSOC);
    $nombres = $registro["nombres"];
    $apellidos = $registro["apellidos"];
    $genero = $registro["genero"];
    $edad = $registro["edad"];
    $telUno = $registro["telefono"];
    $telDos = $registro["telefonoDos"];
    $codigo_postal = $registro["codigo_postal"];
    $coloniaId = $registro["colonia_id"];
    $colonia = $registro["colonia"];
    $municipio = $registro["municipio"];
    $estado = $registro["estadoDir"];
    $calle = $registro["calle"];
    $num_ext = $registro["num_ext"];
    $num_int = $registro["num_int"];
    $referencias = $registro["referencias"];
    $comprobante = $registro["comprobante"];
    $Credencial_front = $registro["Credencial_front"];
    $Credencial_post = $registro["Credencial_post"];
    $Credencial_aseguradora = $registro["Credencial_aseguradora"];
    $Credencial_aseguradoras_post = $registro["Credencial_aseguradoras_post"];
    $responsable = $registro["responsable"];
    $No_nomina = $registro["No_nomina"];
    $rfc = $registro["rfc"];
    $banco = $registro["id_bancos"];
    $admin = $registro["Nombre_administradora"];
}
if ($_POST) {
    $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
    $nombres = (isset($_POST["nombre"]) ? $_POST["nombre"] : "");
    $apellidos = (isset($_POST["apellidos"]) ? $_POST["apellidos"] : "");
    $rfc = (isset($_POST["rfc"]) ? $_POST["rfc"] : "");
    $genero = (isset($_POST["genero"]) ? $_POST["genero"] : "");
    $edad = (isset($_POST["edad"]) ? $_POST["edad"] : "");
    $telUno = (isset($_POST["telUno"]) ? $_POST["telUno"] : "");
    $telDos = (isset($_POST["telDos"]) ? $_POST["telDos"] : null);
    $codigo_postal = isset($_POST['codigo_postal']) ? $_POST['codigo_postal'] : "";
    $colonia = isset($_POST['colonia']) ? $_POST['colonia'] : "";
    $calle = isset($_POST['calle']) ? $_POST['calle'] : "";
    $num_ext = isset($_POST['numExt']) ? $_POST['numExt'] : "";
    $num_int = isset($_POST['numInt']) ? $_POST['numInt'] : NULL;
    $referencias = isset($_POST['referencias']) ? $_POST['referencias'] : NULL;
    // $comprobante = isset($_POST['comprobante']) ? $_POST['comprobante'] : "";
    // $Credencial_front = isset($_POST['Credencial_front']) ? $_POST['Credencial_front'] : "";
    // $Credencial_post = isset($_POST['Credencial_post']) ? $_POST['Credencial_post'] : "";
    // $Credencial_aseguradora = isset($_POST['Credencial_aseguradora']) ? $_POST['Credencial_aseguradora'] : "";
    // $Credencial_aseguradoras_post = isset($_POST['Credencial_aseguradoras_post']) ? $_POST['Credencial_aseguradoras_post'] : "";
    $responsable = isset($_POST['responsable']) ? $_POST['responsable'] : NULL;
    $No_nomina = isset($_POST['No_nomina']) ? $_POST['No_nomina'] : "";
    $rfc = isset($_POST['rfc']) ? $_POST['rfc'] : "";
    $banco = isset($_POST['banco']) ? $_POST['banco'] : "";

    $sentencia = $con->prepare("UPDATE pacientes_call_center 
    SET nombres = :nom, 
    apellidos = :ape,
    genero = :genero,
    edad = :edad, 
    telefono = :telUno, 
    telefonoDos = :telDos, 
    colonia = :colonia, 
    calle = :calle, 
    num_ext = :num_ext, 
    num_int = :num_int, 
    referencias = :referencia, 
    comprobante = IFNULL(:comprobante, comprobante),
        Credencial_front = IFNULL(:Credencial_front, Credencial_front),
        Credencial_post = IFNULL(:Credencial_post, Credencial_post),
        Credencial_aseguradora = IFNULL(:Credencial_aseguradora, Credencial_aseguradora),
        Credencial_aseguradoras_post = IFNULL(:Credencial_aseguradoras_post, Credencial_aseguradoras_post),
    responsable = :responsable, 
    No_nomina = :No_nomina, 
    rfc = :rfc, 
    bancosAdmi = :banco WHERE id_pacientes = :id_pacientes");

    $sentencia->bindParam(":id_pacientes", $txtID);
    $sentencia->bindParam(":nom", $nombres);
    $sentencia->bindParam(":ape", $apellidos);
    $sentencia->bindParam(":genero", $genero);
    $sentencia->bindParam(":edad", $edad);
    $sentencia->bindParam(":telUno", $telUno);
    $sentencia->bindParam(":telDos", $telDos);
    $sentencia->bindParam(":colonia", $colonia);
    $sentencia->bindParam(":calle", $calle);
    $sentencia->bindParam(":num_ext", $num_ext);
    $sentencia->bindParam(":num_int", $num_int);
    $sentencia->bindParam(":referencia", $referencias);
    $sentencia->bindParam(":comprobante", $comprobante);
    $sentencia->bindParam(":Credencial_front", $Credencial_front);
    $sentencia->bindParam(":Credencial_post", $Credencial_post);
    $sentencia->bindParam(":Credencial_aseguradora", $Credencial_aseguradora);
    $sentencia->bindParam(":Credencial_aseguradoras_post", $Credencial_aseguradoras_post);
    $sentencia->bindParam(":responsable", $responsable);
    $sentencia->bindParam(":No_nomina", $No_nomina);
    $sentencia->bindParam(":rfc", $rfc);
    $sentencia->bindParam(":banco", $banco);
    $sentencia->execute();
   
    $carpeta_usuario = "../directorio_INES/";

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
        "Credencial_front",
        "Credencial_post",
        "Credencial_aseguradora",
        "Credencial_aseguradoras_post",
        "comprobante",
    );
    
    foreach ($campos_archivos as $campo_archivo) {
        $nombre_archivo = (isset($_FILES[$campo_archivo]['name']) ? $_FILES[$campo_archivo]['name'] : "");
        $fecha_archivo = new DateTime();
        $nombre_archivo_original = (!empty($nombre_archivo) ? $fecha_archivo->getTimestamp() . "_" . $nombre_archivo : "");
    
        // Verifica si $tmp_archivo está definido y no está vacío
        if (isset($_FILES[$campo_archivo]['tmp_name']) && !empty($_FILES[$campo_archivo]['tmp_name'])) {
            $tmp_archivo = $_FILES[$campo_archivo]['tmp_name'];
    
    
            $archivo_guardado = guardarArchivo($tmp_archivo, $nombre_archivo_original, $carpeta_usuario);
    
         if (!empty($archivo_guardado)) {
            
            $sentencia = $con->prepare("SELECT $campo_archivo FROM `pacientes_call_center` WHERE id_pacientes=:id_pacientes");
            $sentencia->bindParam(":id_pacientes", $txtID);
            $sentencia->execute();
            $registro_recuperado = $sentencia->fetch(PDO::FETCH_ASSOC);
            if (isset($registro_recuperado[$campo_archivo])) {
                $ruta_archivo = $carpeta_usuario . "/" . $registro_recuperado[$campo_archivo];
                if (file_exists($ruta_archivo)) {
                    unlink($ruta_archivo);
                }
            }
            $sentencia = $con->prepare("UPDATE pacientes_call_center SET $campo_archivo=:archivo WHERE id_pacientes=:id_pacientes");
            $sentencia->bindParam(":archivo", $archivo_guardado);
            $sentencia->bindParam(":id_pacientes", $txtID);
            $sentencia->execute();
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
            window.location = "../index.php";
            });';
        echo '</script>';
    }

?>