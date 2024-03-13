<?php
include("../../connection/conexion.php");
//ESTE APARTADO ES PARA GENERAR LA CONSULTA DE LA GRAFICA DE H,M
$genero = $con->prepare("SELECT e.id_empleado, g.genero AS tpoGenero
FROM empleados e , genero g
WHERE e.genero = g.id_genero");
$genero->execute();
$tpoGenero = $genero->fetchAll(PDO::FETCH_ASSOC);

// Inicializar los valores de $datosGenero antes del bucle foreach
$datosGenero = array(
    'FEMENINO' => 0,
    'MASCULINO' => 0
);

// Procesar los resultados de la consulta
foreach ($tpoGenero as $genero) {
    if ($genero['tpoGenero'] == 'FEMENINO') {
        $datosGenero['FEMENINO']++;
    } elseif ($genero['tpoGenero'] == 'MASCULINO') {
        $datosGenero['MASCULINO']++;
    }
}

//los pinto en JSON

echo json_encode($datosGenero);
?>