<?php

// conexión a la base de datos
include("../../../connection/conexion.php");

// trae las librerías para el formato en excel
require_once("../../../vendor/autoload.php");

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

$fecha1 = $_GET['fecha1'];
$fecha2 = $_GET['fecha2'];

$consulta = "SELECT COUNT(A.id_check) AS asistencias, A.id_check, 
CONCAT(S.Nombres, ' ', S.Apellidos) AS 'Nombre completo', T.nombre_guardia AS 'Tipo de guardia', H.fecha AS 'Dias laborados', 
SUM(T.sueldo * A.id_check) AS 'Sueldo Total' 
FROM usuarios S 
JOIN asistencias A ON S.id_usuarios = A.id_empleadoEnfermeria 
JOIN asignacion_horarios H ON S.id_usuarios = H.id_usuario 
JOIN puestos P ON S.id_departamentos = P.id_puestos 
JOIN tipos_guardias T ON T.id_tiposGuardias = H.id_tiposGuardias 
JOIN checkk C ON C.id_check = A.id_check 
JOIN empleados M ON M.Puesto = P.id_puestos 
JOIN estado E ON S.Estado = E.id_estado 
WHERE id_puestos = 6
AND H.fecha >= :fecha1
AND H.fecha <= :fecha2 
GROUP BY A.id_check, CONCAT(S.Nombres, ' ', S.Apellidos), T.nombre_guardia, H.fecha";

$sentencia = $con->prepare($consulta);
$sentencia->bindParam(':fecha1', $fecha1);
$sentencia->bindParam(':fecha2', $fecha2);
$sentencia->execute();
$trabajador = $sentencia->fetchAll(PDO::FETCH_ASSOC);

// Se establecen los criterios del excel
$excel = new Spreadsheet();
$hojaActiva = $excel->getActiveSheet();
$hojaActiva->setTitle("Nomina");

// Establece estilos para la PRIMERA fila (encabezados)
$headerStyle = [
    'font' => [
        'bold' => true,
        'color' => ['rgb' => 'FFFFFF'],
        'size' => 15,
    ],
    'fill' => [
        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
        'startColor' => ['rgb' => '008080'],
    ],
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            'color' => ['rgb' => 'FFFFFF'],
        ],
    ],
];

$hojaActiva->getStyle('A1:E1')->applyFromArray($headerStyle);

// Llena la tabla con datos
$hojaActiva->setCellValue('A1', 'Asistencias');
$hojaActiva->setCellValue('B1', 'Nombre completo');
$hojaActiva->setCellValue('C1', 'Tipo de guardia');
$hojaActiva->setCellValue('D1', 'Dias laborados');
$hojaActiva->setCellValue('E1', 'Sueldo Total');

$fila = 2;
foreach ($trabajador as $row) {
    $hojaActiva->setCellValue('A' . $fila, $row['asistencias']);
    $hojaActiva->setCellValue('B' . $fila, $row['Nombre completo']);
    $hojaActiva->setCellValue('C' . $fila, $row['Tipo de guardia']);
    $hojaActiva->setCellValue('D' . $fila, $row['Dias laborados']);
    $hojaActiva->setCellValue('E' . $fila, $row['Sueldo Total']);
    $fila++;
}

// Columnas 'ANCHO DE COLUMNAS'
$hojaActiva->getColumnDimension('A')->setAutoSize(true);
$hojaActiva->getColumnDimension('B')->setAutoSize(true);
$hojaActiva->getColumnDimension('C')->setAutoSize(true);
$hojaActiva->getColumnDimension('D')->setAutoSize(true);
$hojaActiva->getColumnDimension('E')->setAutoSize(true);

// Determina la orientación del TEXTO
$hojaActiva->getStyle('A:E')->getAlignment()->setHorizontal('center');

// Es el formato que se le da a los números dentro de la tabla
$hojaActiva->getStyle('E2:E' . ($fila - 1))->getNumberFormat()->setFormatCode('$ #,##0');

// Aplica estilo a todas las celdas de datos
$dataStyle = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            'color' => ['rgb' => 'FFFFFF'],
        ],
    ],
];

$hojaActiva->getStyle('A2:E' . ($fila - 1))->applyFromArray($dataStyle);

// Aplica estilo dentro de las celdas
for ($i = 2; $i <= $fila; $i += 2) {
    $hojaActiva->getStyle('A' . $i . ':E' . $i)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('d3d3d3');
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="nomina.xlsx"');
header('Cache-Control: max-age=0');

$writer = IOFactory::createWriter($excel, 'Xlsx');
$writer->save('php://output');
?>
