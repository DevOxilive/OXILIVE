<?php

// conexión a la base de datos
include("../../../connection/conexion.php");
// trae las librerías para el formato en excel
require_once("../../../vendor/autoload.php");


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

$fecha1 = $_GET['fecha1'];
$fecha2 = $_GET['fecha2'];


$consulta = "
SELECT 
    u.id_usuarios, 
    COUNT(sis.statusHorario) AS numero_de_Asistencias,
    CONCAT(u.Nombres, ' ', u.Apellidos) AS NombreCompleto,
    SUM(t.sueldo) AS sueldo_total,
    COUNT(CASE WHEN TIMEDIFF(a.checkTime, sis.horarioEntrada) > '00:15:00' THEN 1 END) AS retardos
FROM 
    asignacion_horarios sis
    INNER JOIN usuarios u ON sis.id_usuario = u.id_usuarios
    INNER JOIN tipos_servicios t ON sis.id_tipoServicio = t.id_tipoServicio
    LEFT JOIN asistencias a ON a.id_empleadoEnfermeria = u.id_usuarios AND a.id_horario = sis.id_asignacionHorarios AND a.id_check = 1
WHERE 
    sis.statusHorario = 3
    AND MONTH(sis.fecha) = MONTH(CURRENT_DATE)
    AND YEAR(sis.fecha) = YEAR(CURRENT_DATE)
    AND sis.fecha >= :fecha1
    AND sis.fecha <= :fecha2
GROUP BY 
    u.id_usuarios, u.Nombres, u.Apellidos
";

$sentencia = $con->prepare($consulta);
$sentencia->bindParam(':fecha1', $fecha1);
$sentencia->bindParam(':fecha2', $fecha2);
$sentencia->execute();
$trabajador = $sentencia->fetchAll(PDO::FETCH_ASSOC);

// Se establecen los criterios del excel
$excel = new Spreadsheet();
$hojaActiva = $excel->getActiveSheet();
$hojaActiva->setTitle("Nominas Enfermeria");

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
$hojaActiva->setCellValue('A1', 'Asistencia');
$hojaActiva->setCellValue('B1', 'Nombre completo');
$hojaActiva->setCellValue('C1', 'Retardos');
$hojaActiva->setCellValue('D1', 'decuento');
$hojaActiva->setCellValue('E1', 'Sueldo Total');

$fila = 2;


// Mostrar los datos únicos en la tabla
foreach ($trabajador as $usuario) {
    $hojaActiva->setCellValue('A' . $fila, $usuario['numero_de_Asistencias']);
    $hojaActiva->setCellValue('B' . $fila, $usuario['NombreCompleto']);
    $hojaActiva->setCellValue('C' . $fila, $usuario['retardos']);
    $descuento = ($usuario['retardos'] > 0) ? $usuario['sueldo_total'] / $usuario['retardos'] : 0;
    $hojaActiva->setCellValue('D' . $fila, isset($descuento) ? number_format($descuento, 2) : 0);
    $hojaActiva->setCellValue('E' . $fila, number_format($usuario['sueldo_total'] - $descuento, 2));
    $fila++;
}

// Columnas 'ANCHO DE COLUMNAS' // setAuroSize es para que las columnas acomoden automaticamente
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

$nombre_archivo = 'nominas_' . str_replace('-', '', $fecha1) . '_a_' . str_replace('-', '', $fecha2) . '.xlsx';

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $nombre_archivo . '"');
header('Cache-Control: max-age=0');

$writer = IOFactory::createWriter($excel, 'Xlsx');
$writer->save('php://output');

?>