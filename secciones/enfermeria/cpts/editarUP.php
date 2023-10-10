<?php
include("../../../connection/conexion.php");
include_once '../../../templates/hea.php';

// Verifica si se proporciona un ID para editar
if (isset($_GET['txtID'])) {
    // Obtén los valores de la URL
    $txtID = $_GET['txtID']; // ID del registro a editar
    $setID = $_GET['setID']; // Identificador único del conjunto de campos

    // Obtener los datos del registro a editar
    $sentencia = $con->prepare("SELECT * FROM cpts_administradora WHERE id_cpt = :id_cpt");
    $sentencia->bindParam(":id_cpt", $txtID);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_ASSOC);

    if (!$registro) {
        // El registro no existe, puedes mostrar un mensaje de error o redirigir según tu necesidad.
        echo "El registro no existe.";
        exit;
    }

    // Asignar valores a las variables para el formulario de edición
    $cpt = $registro["cpt"];
    $descripcion = $registro["descripcion"];
    $unidad = $registro["unidad"];
    $administradora = $registro["admi"];
    // Mostrar el formulario de edición con los datos actuales
    // Aquí debes poner el formulario HTML con los campos prellenados con los valores actuales.
} else if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $txtID = isset($_POST["txtID"]) ? $_POST["txtID"] : '';
    $cpt = (isset($_POST["cpt"]) ? $_POST["cpt"] : []);
    $descripcion = (isset($_POST["descripcion"]) ? $_POST["descripcion"] : []);
    $unidad = (isset($_POST["unidad"]) ? $_POST["unidad"] : []);
    $administradora = (isset($_POST["administradora"]) ? $_POST["administradora"] : "");

    // Validación para asegurarse de que todos los campos estén llenos
    $camposVacios = false;

    foreach ($cpt as $key => $cptValue) {
        $cptValue = trim($cptValue);
        $descripcionValue = trim($descripcion[$key]);
        $unidadValue = trim($unidad[$key]);

        if (empty($cptValue) || empty($descripcionValue) || empty($unidadValue)) {
            $camposVacios = true;
            break;
        }
    }

    if ($camposVacios) {
        echo '<script language="javascript"> ';
        echo 'Swal.fire({
                icon: "error",
                title: "Campos requeridos",
                text: "Por favor, complete todos los campos CPT, Descripción y Unidad en cada conjunto.",
                confirmButtonColor: "#d33",
                confirmButtonText: "OK",
            });';
        echo '</script>';
    } else {
        try {
            $con->beginTransaction();

            $sentencia = $con->prepare("UPDATE cpts_administradora 
                                        SET cpt = :cpt, descripcion = :descripcion, unidad = :unidad, admi = :administradora
                                        WHERE id_cpt = :id_cpt");

            foreach ($cpt as $key => $cptValue) {
                $txtIDValue = isset($txtID[$key]) ? $txtID[$key] : '';
                $descripcionValue = isset($descripcion[$key]) ? $descripcion[$key] : '';
                $unidadValue = isset($unidad[$key]) ? $unidad[$key] : '';

                $registro = [
                    ":id_cpt" => $txtIDValue,
                    ":cpt" => $cptValue,
                    ":descripcion" => $descripcionValue,
                    ":unidad" => $unidadValue,
                    ":administradora" => $administradora
                ];

                if (!$sentencia->execute($registro)) {
                    throw new Exception("Error al actualizar CPT.");
                }
            }

            $con->commit();

            echo '<script language="javascript"> ';
            echo 'Swal.fire({
                    icon: "success",
                    title: "CPTS ACTUALIZADOS",
                    showConfirmButton: false,
                    timer: 1500,
                }).then(function() {
                    window.location = "index.php";
                    });';
            echo '</script>';
        } catch (Exception $e) {
            $con->rollBack();

            echo '<script language="javascript"> ';
            echo 'Swal.fire({
                    icon: "error",
                    title: "Error al actualizar CPTS",
                    text: "'.$e->getMessage().'",
                    confirmButtonColor: "#d33",
                    confirmButtonText: "OK",
                });';
            echo '</script>';
        }
    }
}
?>
