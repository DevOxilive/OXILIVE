<?php
// Iniciar la sesión
session_start();

//Consulta prueba para los informes
include("../../../../connection/conexion.php");

$estado = $_SESSION['estado'];
$idUser = $_SESSION['idus'];

if ($estado == 1) {
    $check = "SELECT * FROM asistencias
            WHERE id_check = '5'
            AND id_empleadoEnfermeria = :iduser 
            ORDER BY fechaAsis, checkTime DESC
            LIMIT 1;";
} elseif ($estado == 5) {
    $check = "SELECT * FROM asistencias 
            WHERE id_check = '1' 
            AND id_empleadoEnfermeria = :iduser 
            ORDER BY fechaAsis, checkTime DESC
            LIMIT 1;";
} else {
    // Define lo que deseas hacer en caso de otro valor de $estado
}

$sentencia = $con->prepare($check);
$sentencia->bindParam(':iduser', $idUser);
$sentencia->execute();
$concheck = $sentencia->fetchAll(PDO::FETCH_ASSOC);

// Recorremos los resultados de la consulta y realizamos inserciones o actualizaciones en la tabla registro_bitacora
foreach ($concheck as $row) {
    $fecha = $row['fechaAsis'];
    $checkTime = $row['checkTime'];

    if ($estado == 5) {
        // Realizar la inserción en registro_bitacora aquí
        $sentenciaInsert = $con->prepare("INSERT INTO registro_bitacora 
        (id_Rbitacora, id_usuario, Registro_fecha, hora_entrada, id_checkIn) 
        VALUES (NULL, :idUser, :fechaAsis, :checkTime, :id_check)");

        $sentenciaInsert->bindParam(':idUser', $idUser);
        $sentenciaInsert->bindParam(':fechaAsis', $fecha);
        $sentenciaInsert->bindParam(':checkTime', $checkTime);
        $sentenciaInsert->bindParam(':id_check', $row['id_asistencias']);
        $sentenciaInsert->execute();
    } elseif ($estado == 1) {
        // Realizar la actualización en registro_bitacora aquí
        $sentenciaUpdate = $con->prepare("UPDATE registro_bitacora 
        SET hora_salida = :checkTime, id_checkOut = :id_check 
        WHERE id_usuario = :idUser");

        $sentenciaUpdate->bindParam(':checkTime', $checkTime);
        $sentenciaUpdate->bindParam(':id_check', $row['id_asistencias']);
        $sentenciaUpdate->bindParam(':idUser', $idUser);
        $sentenciaUpdate->execute();
    }
}

?>

<?php
// Iniciar la sesión
session_start();

// Consulta prueba para los informes
include("../../../../connection/conexion.php");

$estado = $_SESSION['estado'];
$idUser = $_SESSION['idus'];

if ($estado == 1) {
    // Obtener el registro más reciente con id_check = 5
    $check = "SELECT * FROM asistencias
              WHERE id_check = '5'
              AND id_empleadoEnfermeria = :iduser 
              ORDER BY fechaAsis DESC, checkTime DESC
              LIMIT 1;";
} elseif ($estado == 5) {
    // Obtener el registro más reciente con id_check = 1
    $check = "SELECT * FROM asistencias 
              WHERE id_check = '1' 
              AND id_empleadoEnfermeria = :iduser 
              ORDER BY fechaAsis DESC, checkTime DESC
              LIMIT 1;";
} else {
    // Manejar el caso en que el estado no sea 1 ni 5
    echo "Estado no válido.";
    exit;
}

$sentencia = $con->prepare($check);
$sentencia->bindParam(':iduser', $idUser);
$sentencia->execute();
$concheck = $sentencia->fetchAll(PDO::FETCH_ASSOC);

// Recorremos los resultados de la consulta y realizamos inserciones o actualizaciones en la tabla registro_bitacora
foreach ($concheck as $row) {
    $fecha = $row['fechaAsis'];
    $checkTime = $row['checkTime'];
    $id_check = $row['id_asistencias'];

    if ($estado == 5) {
        // Realizar la inserción en registro_bitacora
        $sentenciaInsert = $con->prepare("INSERT INTO registro_bitacora 
        (id_Rbitacora, id_usuario, Registro_fecha, hora_entrada, id_checkIn) 
        VALUES (NULL, :idUser, :fechaAsis, :checkTime, :id_check)");
    } elseif ($estado == 1) {
        // Realizar la actualización en registro_bitacora
        $sentenciaInsert = $con->prepare("UPDATE registro_bitacora 
        SET hora_salida = :checkTime, id_checkOut = :id_check 
        WHERE id_usuario = :idUser");
    }

    $sentenciaInsert->bindParam(':idUser', $idUser);
    $sentenciaInsert->bindParam(':fechaAsis', $fecha);
    $sentenciaInsert->bindParam(':checkTime', $checkTime);
    $sentenciaInsert->bindParam(':id_check', $id_check);
    $sentenciaInsert->execute();
}

?>
