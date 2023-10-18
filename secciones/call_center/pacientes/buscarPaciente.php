<?php
include("../../../connection/conexion.php");

if (isset($_POST['query'])) {
    $inpText = $_POST['query'];
    $sql = 'SELECT Apellidos, Nombres, id_pacientes FROM pacientes_oxigeno WHERE Apellidos LIKE :search OR Nombres LIKE :search';
    $stmt = $con->prepare($sql);
    $stmt->execute(['search' => '%' . $inpText . '%']);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($result) {
        foreach ($result as $filas) {

            echo '<a href="informacionPaciente.php?idPac=' . $filas['id_pacientes'] . '"class="list-group-item list-group-item-action border-1">' . $filas['Nombres'] . ' ' . $filas['Apellidos'] . '</a>';
        }
    } else {
        echo "Paciente no encontrado o no registrado";
    }
}
