<?php
include('../../../connection/conexion.php');

// Verifica si se recibió correctamente el valor del grado
if(isset($_POST['grado'])) {
    $gradoSeleccionado = $_POST['grado'];
    $sentencia = $con->prepare("SELECT id_puestos, gradoPuesto, Nombre_puestos FROM puestos WHERE gradoPuesto = :grado");
    $sentencia->execute(array(':grado' => $gradoSeleccionado));
    $listadoEm = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    foreach ($listadoEm as $puesto) {
        echo "<option value='{$puesto['id_puestos']}'>{$puesto['Nombre_puestos']}</option>";
    }
} else {
    echo "<option value=''>No se recibió el grado seleccionado</option>";
}
?>
