<?php 
include("../../../connection/conexion.php");
$servicio = $con->prepare("SELECT * FROM asignacion_servicio LIMIT 1");
$servicio->execute();
$ltServicio = $servicio->fetchAll(PDO::FETCH_ASSOC); 

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // Obtiene los parámetros
//     $servicioId = $_POST["servicioId"];
//     $nuevoEstado = $_POST["nuevoEstado"];
//     // Actualiza el estado del servicio en la base de datos
//     $sql = "UPDATE asignacion_servicio SET estado = $nuevoEstado WHERE id_sv = $servicioId";
//     if ($conn->query($sql) === TRUE) {
//         echo "success";
//     } else {
//         echo "error: " . $conn->error;
//     }
// }
?>