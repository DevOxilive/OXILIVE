<?php
include("../../../connection/conexion.php");
include_once '../../../templates/hea.php';

if ($_POST) {

    $Nombres = (isset($_POST["Nombres"]) ? $_POST["Nombres"] : "");
    $Apellidos = (isset($_POST["Apellidos"]) ? $_POST["Apellidos"] : "");
    $Genero = (isset($_POST["Genero"]) ? $_POST["Genero"] : "");
    $Edad = (isset($_POST["Edad"]) ? $_POST["Edad"] : "");
    $calle = (isset($_POST["calle"]) ? $_POST["calle"] : "");
    $num_in = (isset($_POST["num_in"]) ? $_POST["num_in"] : "");
    $num_ext = (isset($_POST["num_ext"]) ? $_POST["num_ext"] : "");
    $colonia = (isset($_POST["colonia"]) ? $_POST["colonia"] : "");
    $cp = (isset($_POST["cp"]) ? $_POST["cp"] : "");
    $municipio = (isset($_POST["municipio"]) ? $_POST["municipio"] : "");
    $estado_direccion = (isset($_POST["estado_direccion"]) ? $_POST["estado_direccion"] : "");
    $rfc = (isset($_POST["rfc"]) ? $_POST["rfc"] : "");
    $responsable = (isset($_POST["responsable"]) ? $_POST["responsable"] : "");
    $Alcaldia = (isset($_POST["Alcaldia"]) ? $_POST["Alcaldia"] : "");
    $Telefono = (isset($_POST["Telefono"]) ? $_POST["Telefono"] : "");
    $Administradora = (isset($_POST["Administradora"]) ? $_POST["Administradora"] : "");
    $Aseguradora = (isset($_POST["Aseguradora"]) ? $_POST["Aseguradora"] : "");
    $Banco = (isset($_POST["Banco"]) ? $_POST["Banco"] : "");
    $No_nomina = (isset($_POST["No_nomina"]) ? $_POST["No_nomina"] : "");
    $Credencial_front = (isset($_FILES["Credencial_front"]['name']) ? $_FILES["Credencial_front"]['name'] : "");
    $Credencial_post = (isset($_FILES["Credencial_post"]['name']) ? $_FILES["Credencial_post"]['name'] : "");
    $Credencial_aseguradora = (isset($_FILES["Credencial_aseguradora"]['name']) ? $_FILES["Credencial_aseguradora"]['name'] : "");
    $Credencial_aseguradoras_post = (isset($_FILES["Credencial_aseguradoras_post"]['name']) ? $_FILES["Credencial_aseguradoras_post"]['name'] : "");
    $comprobante = (isset($_FILES["comprobante"]['name']) ? $_FILES["comprobante"]['name'] : "");
    $referencias = (isset($_POST["referencias"]) ? $_POST["referencias"] : "");

    $sentencia = $con->prepare("INSERT INTO `pacientes_oxigeno` (`id_pacientes`, `Nombres`, `Apellidos`, `calle`,`num_in`,`num_ext`,`colonia`,`cp`,`municipio`,`estado_direccion`,`rfc`,`responsable`,`Genero`, `Edad`, `Alcaldia`, `Telefono`, `Administradora`, `Aseguradora`, `Banco`, `No_nomina`, `Credencial_front`, `Credencial_post`,  `Credencial_aseguradora`, `Credencial_aseguradoras_post`, `comprobante`, `referencias`,`estado`)
    VALUES (Null, :Nombres, :Apellidos, :calle,:num_in,:num_ext,:colonia,:cp,:municipio,:estado_direccion,:rfc,:responsable, :Genero, :Edad,:Alcaldia, :Telefono, :Administradora, :Aseguradora, :Banco, :No_nomina, :Credencial_front, :Credencial_post, :Credencial_aseguradora, :Credencial_aseguradoras_post, :comprobante, :referencias,1);");


    $sentencia->bindParam(":Nombres", $Nombres);
    $sentencia->bindParam(":Apellidos", $Apellidos);
    $sentencia->bindParam(":Genero", $Genero);
    $sentencia->bindParam(":Edad", $Edad);
    $sentencia->bindParam(":Alcaldia", $Alcaldia);
    $sentencia->bindParam(":Telefono", $Telefono);
    $sentencia->bindParam(":Administradora", $Administradora);
    $sentencia->bindParam(":Aseguradora", $Aseguradora);
    $sentencia->bindParam(":Banco", $Banco);
    $sentencia->bindParam(":No_nomina", $No_nomina);
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

        $extensiones_permitidas = array("jpg", "png","jpeg"); // Extensiones permitidas
    
        // Verificar la extensión de las imágenes antes de copiarlas
        $extension_Credencial_front = strtolower(pathinfo($Credencial_front, PATHINFO_EXTENSION));
        $extension_Credencial_post = strtolower(pathinfo($Credencial_post, PATHINFO_EXTENSION));
        $extension_Credencial_aseguradora = strtolower(pathinfo($Credencial_aseguradora, PATHINFO_EXTENSION));
        $extension_Credencial_aseguradoras_post = strtolower(pathinfo($Credencial_aseguradoras_post, PATHINFO_EXTENSION));
    
        //No condicionadas fueron removidas de crear.php

        if (!in_array($extension_Credencial_front, $extensiones_permitidas) ||
            !in_array($extension_Credencial_post, $extensiones_permitidas) ||
            !in_array($extension_Credencial_aseguradora, $extensiones_permitidas) ||
            !in_array($extension_Credencial_aseguradoras_post, $extensiones_permitidas)) {
            // Si alguna de las extensiones no es válida, muestra un mensaje de error con SweetAlert
            echo '<script language="javascript"> ';
            echo 'Swal.fire({
                icon: "error",
                title: "Error",
                text: "Solo se permiten archivos JPG para las imágenes",
                showConfirmButton: true,
            }).then(function() {
                window.location = "./crear.php";
            });';
            echo '</script>';
        } else {

   $fecha_Credencial_front = new DateTime();
    $nombre_Credencial_front_orginal = ($fecha_Credencial_front != '') ? $fecha_Credencial_front->getTimestamp() . "_" . $_FILES["Credencial_front"]['name'] : "";
    $tmp_Credencial_front = $_FILES["Credencial_front"]['tmp_name'];

    $fecha_Credencial_post = new DateTime();
    $nombre_Credencial_post_orginal = ($fecha_Credencial_post != '') ? $fecha_Credencial_post->getTimestamp() . "_" . $_FILES["Credencial_post"]['name'] : "";
    $tmp_Credencial_post = $_FILES["Credencial_post"]['tmp_name'];

    $fecha_Credencial_aseguradora = new DateTime();
    $nombre_Credencial_aseguradora_orginal = ($fecha_Credencial_aseguradora != '') ? $fecha_Credencial_aseguradora->getTimestamp() . "_" . $_FILES["Credencial_aseguradora"]['name'] : "";
    $tmp_Credencial_aseguradora = $_FILES["Credencial_aseguradora"]['tmp_name'];

    $fecha_Credencial_aseguradoras_post = new DateTime();
    $nombre_Credencial_aseguradoras_post_orginal = ($fecha_Credencial_aseguradoras_post != '') ? $fecha_Credencial_aseguradoras_post->getTimestamp() . "_" . $_FILES["Credencial_aseguradoras_post"]['name'] : "";
    $tmp_Credencial_aseguradoras_post = $_FILES["Credencial_aseguradoras_post"]['tmp_name'];

    $comprobante = new DateTime();
    $nombre_comprobante_orginal = ($comprobante != '') ? $comprobante->getTimestamp() . "_" . $_FILES["comprobante"]['name'] : "";
    $tmp_comprobante = $_FILES["comprobante"]['tmp_name'];

    $carpeta_usuario = "./PAPELETA/" . $Apellidos . " " . $Nombres;
    if (!is_dir($carpeta_usuario)) {
        mkdir($carpeta_usuario);
        copy($tmp_Credencial_front, $carpeta_usuario . "/" . $nombre_Credencial_front_orginal);
        copy($tmp_Credencial_post, $carpeta_usuario . "/" . $nombre_Credencial_post_orginal);
        copy($tmp_Credencial_aseguradora, $carpeta_usuario . "/" . $nombre_Credencial_aseguradora_orginal);
        copy($tmp_Credencial_aseguradoras_post, $carpeta_usuario . "/" . $nombre_Credencial_aseguradoras_post_orginal);
        copy($tmp_comprobante, $carpeta_usuario . "/" . $nombre_comprobante_orginal);
    }

    $otra_carpeta_usuario = "./PAPELETA" . $Apellidos . " " . $Nombres;
   if (!is_dir($otra_carpeta_usuario)) {
        mkdir($otra_carpeta_usuario);

        copy($tmp_Credencial_front, $otra_carpeta_usuario . "/" . $nombre_Credencial_front_orginal);
        copy($tmp_Credencial_post, $otra_carpeta_usuario . "/" . $nombre_Credencial_post_orginal);
        copy($tmp_Credencial_aseguradora, $otra_carpeta_usuario . "/" . $nombre_Credencial_aseguradora_orginal);
        copy($tmp_Credencial_aseguradoras_post, $otra_carpeta_usuario . "/" . $nombre_Credencial_aseguradoras_post_orginal);
        copy($tmp_comprobante, $otra_carpeta_usuario . "/" . $nombre_comprobante_orginal);
    }

    $sentencia->bindParam(":Credencial_front", $nombre_Credencial_front_orginal);
    $sentencia->bindParam(":Credencial_post", $nombre_Credencial_post_orginal);
    $sentencia->bindParam(":Credencial_aseguradora", $nombre_Credencial_aseguradora_orginal);
    $sentencia->bindParam(":Credencial_aseguradoras_post", $nombre_Credencial_aseguradoras_post_orginal);
    $sentencia->bindParam(":comprobante", $nombre_comprobante_orginal);

    $verificarRFC = $con->prepare("SELECT COUNT(*) FROM pacientes_oxigeno WHERE rfc = :rfc");
    $verificarRFC->bindParam(":rfc", $rfc);
    $verificarRFC->execute();
    $rfcExiste = $verificarRFC->fetchColumn();

    if ($rfcExiste) {
        echo '<script language="javascript"> ';
        echo 'Swal.fire({
                    icon: "warning",
                    title: "RFC DUPLICADO",
                    text: "El RFC ya existe",
                    showConfirmButton: false,
                    timer: 2000,
                }).then(function() {
                    window.location = "./crear.php";
                });';
        echo '</script>';
    } else {
        $sentencia->execute();
        echo '<script language="javascript"> ';
        echo 'Swal.fire({
                icon: "success",
                title: "PACIENTE AGREGADO",
                showConfirmButton: false,
                timer: 1500,
            }).then(function() {
                window.location = "index.php";
                });';
        echo '</script>';
    }
}
}