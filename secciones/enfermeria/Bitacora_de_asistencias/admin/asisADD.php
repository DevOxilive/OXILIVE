<?php
include("../../../../connection/conexion.php");

// Define y verifica las variables que se utilizarán
$fecha_asis = "fecha_asis"; 
$checkTime = "checkTime"; 
$Nombre_completo = "'Nombre completo'"; 
$Hora_entrada = "'Hora de entrada'"; 
$Hora_salida = "'Hora de salida'i"; 
$Nombre_estatus = "Nom_estatus"; 

if($fecha_asis != $checkTime){
    echo '<script language="javascript"> ';
    echo 'Swal.fire({
            icon: "warning",
            title: "No se puede agregar",
            text: "Las fechas no coinciden",
            showConfirmButton: false,
            timer: 2000,
        }).then(function() {
            window.location = "./asisADD.php";
            });';
    echo '</script>';
}
else {
  
    $fecha_asis = $_POST['fecha_asis'];
    $checkTime = $_POST['checkTime'];
    $Nombre_completo = $_POST['Nombre_completo'];
    $Hora_entrada = $_POST['Hora_de_entrada'];
    $Hora_salida = $_POST['Hora_de_salida'];
    $Nombre_estatus = $_POST['Nom_estatus'];

    // Verifica si las variables se asignaron correctamente antes de continuar
    if ($fecha_asis && $checkTime && $Nombre_completo && $Hora_entrada && $Hora_salida && $Nombre_estatus) {
        $consulta = $con->prepare("INSERT INTO 
            `registro_bitacora` (`id_Rbitacora`,`Nombre_completo`, `Registro_fecha`, `hora_entrada`, `hora_salida`, `Estatus_bita`) 
            VALUES (Null, :Nombre_completo , :fecha_asis, :hora_entrada, :hora_salida, :Estatus_bita);");
        $consulta->bindParam(":Nombre_completo", $Nombre_completo);
        $consulta->bindParam(":fecha_asis", $fecha_asis);
        $consulta->bindParam(":hora_entrada", $Hora_entrada);
        $consulta->bindParam(":hora_salida", $Hora_salida);
        $consulta->bindParam(":Estatus_bita", $Nombre_estatus);
        $consulta->execute(); 
        
        // Verifica si la inserción fue exitosa
        if ($consulta->rowCount() > 0) {
            echo '<script language="javascript"> ';
            echo 'Swal.fire({
                    icon: "success",
                    title: "Agregado Correctamente",
                    showConfirmButton: false,
                    timer: 1500,
                }).then(function() {
                    window.location = "./asisADD.php";
                    });';
            echo '</script>';
        } else {
            echo '<script language="javascript"> ';
            echo 'Swal.fire({
                    icon: "error",
                    title: "Error al agregar",
                    text: "Hubo un problema al agregar los datos",
                    showConfirmButton: false,
                    timer: 2000,
                }).then(function() {
                    window.location = "./asisADD.php";
                    });';
            echo '</script>';
        }
    } else {
        echo '<script language="javascript"> ';
        echo 'Swal.fire({
                icon: "error",
                title: "Error al agregar",
                text: "Faltan datos necesarios para la inserción",
                showConfirmButton: false,
                timer: 2000,
            }).then(function() {
                window.location = "./asisADD.php";
                });';
        echo '</script>';
    }
}
?>
