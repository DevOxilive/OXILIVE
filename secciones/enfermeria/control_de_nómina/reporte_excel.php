<?php

// conexión a la base de datos
include("../../../connection/conexion.php");

// trae las librerías para el formato en excel
require_once("../../../vendor/autoload.php");

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

$fecha1 = $_GET['fecha1'];
$fecha2 = $_GET['fecha2'];


$consulta = "SELECT A.id_empleadoEnfermeria, CONCAT(U.Nombres, ' ', U.Apellidos) AS NombreCompleto, T.nombreServicio, A.fechaAsis, R.hora_entrada, H.horarioEntrada,
(SELECT COUNT(id_Rbitacora) FROM registro_bitacora R2 WHERE R2.id_usuario = U.id_usuarios) AS numero_de_registros, T.sueldo
FROM asistencias A,  registro_bitacora R, tipos_servicios T, asignacion_horarios H, usuarios U
WHERE A.id_horario = H.id_asignacionHorarios
AND A.id_empleadoEnfermeria = U.id_usuarios
AND A.id_asistencias = R.id_checkIn
AND H.id_tipoServicio = T.id_tipoServicio
AND H.id_usuario = U.id_usuarios
AND A.fechaAsis = R.Registro_fecha
AND U.id_departamentos = 11
AND H.fecha >= :fecha1
AND H.fecha <= :fecha2;";

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
$hojaActiva->setCellValue('C1', 'Tipo de guardia');
$hojaActiva->setCellValue('D1', 'Retardos');
$hojaActiva->setCellValue('E1', 'Sueldo Total');

$fila = 2;


// Inicializar un array para almacenar la información única de cada usuario   
$usuariosUnicos = [];
                        
foreach ($trabajador as $trab) {
    // Si el usuario aún no está en el array, agregarlo
    if (!isset($usuariosUnicos[$trab['id_empleadoEnfermeria']])) {
        $hora_registrado = strtotime($trab['hora_entrada']);
        $horario_entrada = strtotime($trab['horarioEntrada']);

        // Calcular la diferencia en minutos entre la hora actual y el horario de entrada
        $diferencia_minutos = ($hora_registrado - $horario_entrada) / 60;

        // Validar el retardo y contar los retardos acumulados
        $retardos = 0;
        if ($diferencia_minutos > 15) {
            $retardos = floor($diferencia_minutos / 15);
        }

        // Deducción de sueldo por 3 retardos acumulados
        if ($retardos >= 3) {
            $sueldo_total = $trab['numero_de_registros'] * ($trab['sueldo'] - $trab['sueldo']);
        } else {
            $sueldo_total = $trab['numero_de_registros'] * $trab['sueldo'];
        }

        // Almacenar la información única del usuario en el array
        $usuariosUnicos[$trab['id_empleadoEnfermeria']] = [
            'numero_de_registros' => $trab['numero_de_registros'],
            'NombreCompleto' => $trab['NombreCompleto'],
            'nombreServicio' => $trab['nombreServicio'],
            'retardos' => $retardos,
            'sueldo_total' => $sueldo_total,
        ];
    }
}

// Mostrar los datos únicos en la tabla
foreach ($usuariosUnicos as $usuario) {
    $hojaActiva->setCellValue('A' . $fila, $usuario['numero_de_registros']);
    $hojaActiva->setCellValue('B' . $fila, $usuario['NombreCompleto']);
    $hojaActiva->setCellValue('C' . $fila, $usuario['nombreServicio']);
    $hojaActiva->setCellValue('D' . $fila, $usuario['retardos']);
    $hojaActiva->setCellValue('E' . $fila, $usuario['sueldo_total']);
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