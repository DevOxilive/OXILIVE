<?php
include("../../../../connection/conexion.php");
include_once '../../../../templates/hea.php';
if ($_POST) {
    $codigo = (isset($_POST["codigo"]) ? $_POST["codigo"] : []);
    $descripcion = (isset($_POST["descripcion"]) ? $_POST["descripcion"] : []);
    $unidad = (isset($_POST["unidad"]) ? $_POST["unidad"] : []);
    $administradora = (isset($_POST["administradora"]) ? $_POST["administradora"] : "");


    
    function insertacodigo($codigo, $descripcion,$unidad ,$administradora, $con){
        $sentencia = $con->prepare("INSERT INTO codigo_administradora(id_codigo, codigo,descripcion,unidad ,admi) VALUES (null, :codigo, :descripcion,:unidad ,:admi)");

        // Inicializa un array de errores dentro de la función
        $errores = [];

        foreach ($codigo as $key => $codigoValue) {
            // Verifica si el índice existe en $descripcion y obtén el valor correspondiente
            $descripcionValue = isset($descripcion[$key]) ? $descripcion[$key] : '';
            $unidadValue = isset($unidad[$key]) ? $unidad[$key] : '';

            // Crea un arreglo asociativo con ambos valores
            $registro = [
                ":codigo" => $codigoValue,
                ":descripcion" => $descripcionValue,
                ":unidad" => $unidadValue,
                ":admi" => $administradora
            ];

            // Ejecuta la inserción y verifica si hubo errores
            if (!$sentencia->execute($registro)) {
                $errores[] = $key;
            }
        }

        // Devuelve el array de errores
        return $errores;
    }

    // Llama a la función insertaCódigos y almacena los errores resultantes
    $errores = insertacodigo($codigo, $descripcion,$unidad ,$administradora, $con);

    // Comprueba si hubo errores en la inserción
    if (empty($errores)) {
        echo '<script language="javascript"> ';
        echo 'Swal.fire({
                icon: "success",
                title: "CÓDIGO DE SERVICIO AGREGADO",
                showConfirmButton: false,
                timer: 1500,
            }).then(function() {
                window.location = "index.php";
                });';
        echo '</script>';
    } else {
        // Si hubo errores, puedes manejarlos aquí
        echo '<script language="javascript"> ';
        echo 'Swal.fire({
                icon: "error",
                title: "Error al agregar Código",
                text: "Hubo errores en la inserción",
                confirmButtonColor: "#d33",
                confirmButtonText: "OK",
            });';
        echo '</script>';
    }
}


?>
