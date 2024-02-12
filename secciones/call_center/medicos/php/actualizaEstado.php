<?php
session_start();
include '../../../../connection/conexion.php';

if ($_SERVER['REQUEST_METHOD']) {
    $valorServicio = $_POST['caso'];
    $idservicio = $_POST['sv'];
    $stmt = $con->prepare("SELECT * FROM asignacion_servicio WHERE num_medico = $valorServicio AND id_sv = $idservicio");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $key => $value) {
        if ($value['estado'] == 1) {
            $valorServicio = $_POST['caso'];
            echo "<script language='javascript'> ";
            echo 'Swal.fire({
                icon: "success",
                title: "INCIDENCIA INICIADA CORRECTAMENTE.🚑",
                showConfirmButton: false,
                timer: 2000,
            }).then(function() {
                window.location = "index.php";
                });';
            echo "</script>";

            $stmt = $con->prepare("UPDATE asignacion_servicio SET estado = 2 WHERE num_medico = $valorServicio AND id_sv = $idservicio");
            $stmt->execute();
        } else if ($value['estado'] == 2) {
            $valorServicio = $_POST['caso'];
            echo "<script language='javascript'> ";
            echo 'Swal.fire({
                icon: "success",
                title: "INCIDENCIA FINALIZADA.😎👍",
                showConfirmButton: false,
                timer: 2000,
            }).then(function() {
                window.location = "index.php";
                });';
            echo "</script>"; 
            $stmt = $con->prepare("UPDATE asignacion_servicio SET estado = 3 WHERE num_medico = $valorServicio AND id_sv = $idservicio");
            $stmt->execute();
        }
    }

} else {

}