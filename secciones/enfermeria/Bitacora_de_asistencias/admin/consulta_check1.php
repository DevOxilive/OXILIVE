<?php
// Iniciar la sesión
session_start();

//Consulta prueba para los informes
include("../../../../connection/conexion.php");

$estado = $_SESSION['estado'];
if($estado == 1){
    $check="SELECT * FROM asistencias
            WHERE id_check = '5'
            AND id_empleadoEnfermeria = :iduser 
            ORDER BY fechaAsis, checkTime DESC
            LIMIT 1;";
} else if ($estado == 5) {
    $check="SELECT * FROM asistencias 
            WHERE id_check = '1' 
            AND id_empleadoEnfermeria = :iduser 
            ORDER BY fechaAsis, checkTime DESC
            LIMIT 1;";
}
else{
    
}
$idUser = $_SESSION['idus'];
$sentencia = $con->prepare($check);
$sentencia->bindParam(':iduser', $idUser);
$sentencia->execute();
$concheck = $sentencia->fetchAll(PDO::FETCH_ASSOC);

// Recorremos los resultados de la consulta y realizamos inserciones en la tabla registro_bitacora
if($estado==5){
    foreach ($concheck as $row) {
        $fecha = $row['fechaAsis'];
        $checkTime = $row['checkTime'];
        $id_check = $row['id_asistencias'];

        // Realizar la inserción en registro_bitacora aquí
        $sentenciaInsert = $con->prepare("INSERT INTO registro_bitacora 
        (id_Rbitacora, id_usuario, Registro_fecha, hora_entrada, id_checkIn) 
        VALUES (NULL, :idUser, :fechaAsis, :checkTime, :id_check)");
    
        $sentenciaInsert->bindParam(':idUser', $idUser);
        $sentenciaInsert->bindParam(':fechaAsis', $fecha);
        $sentenciaInsert->bindParam(':checkTime', $checkTime);
        $sentenciaInsert->bindParam(':id_check', $id_check);
        $sentenciaInsert->execute();
    }
} else if($estado == 1){

    $check = "SELECT id_Rbitacora 
    FROM registro_bitacora
    WHERE id_usuario = :iduser 
    ORDER BY Registro_fecha DESC
    LIMIT 1;";
    
    $idUser = $_SESSION['idus'];
    $sentencia = $con->prepare($check);
    $sentencia->bindParam(':iduser', $idUser);
    $sentencia->execute();
    $concheck = $sentencia->fetchAll(PDO::FETCH_ASSOC);

    foreach ($concheck as $row) {
    $id_bitacora = $row['id_Rbitacora'];

    // Realizar la inserción en registro_bitacora aquí
    $sentenciaUpdate = $con->prepare("UPDATE registro_bitacora 
    SET hora_salida = :checkTime, id_checkOut: :id_check 
    WHERE id_Rbitacora = :idBit");

     $sentenciaUpdate->bindParam(':checkTime', $checkTime);
     $sentenciaUpdate->bindParam(':id_check', $id_check);
     $sentenciaUpdate->bindParam(':idBit', $id_bitacora);
     $sentenciaUpdate->execute();
    }
}
?>