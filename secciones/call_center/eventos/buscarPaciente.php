<?php
include("../../../connection/conexion.php");

if (isset($_POST['query'])) {
    $inpText = $_POST['query'];
    $sql = 'SELECT apellidos, nombres, id_pacientes FROM pacientes_call_center WHERE apellidos LIKE :search OR nombres LIKE :search';
    $stmt = $con->prepare($sql);
    $stmt->execute(['search' => '%' . $inpText . '%']);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($result) {
        foreach ($result as $filas) {

            echo '<a href="informacionPaciente.php?idPac=' . $filas['id_pacientes'] . '"class="list-group-item list-group-item-action border-1">' . $filas['nombres'] . ' ' . $filas['apellidos'] . '</a>';
        }
    } else {
        echo "Paciente no encontrado o no registrado";
    }
}
