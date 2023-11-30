
<?php
require('../../../fpdf/fpdf.php');
class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Logo
        $this->Image('../../../img/Logo.png', 15, 15, 60);
        // Arial bold 15
        $this->SetFont('Arial', 'B', 20);
        // Movernos a la derecha
        $this->Cell(80);
        // Título
        $this->Cell(100, 15, 'OXILIVE', 0, 1, 'C');
        //Texto Explicativo
        $this->SetFont('Times', '', 18);
        $this->MultiCell(260, 5, utf8_decode('REPORTE DE NÓMINA'), 0, 'C');
        
        // Salto de línea
        $this->Ln(25);
    }
    // Pie de página
    function Footer()
    {
        // Posición: a 4,0 cm del final
        $this->SetY(-40);
        // Arial italic 8
        $this->SetFont('Arial', 'B', 6);
        // Número de página
        $this->Cell(80);
        $this->Cell(20, 10, utf8_decode('Aviso de Privacidad'), 0, 0);
        $this->Ln(8);
        $this->MultiCell(190, 2.2, utf8_decode('OXILIVE S.A. de C.V., con domicilio en Villa de Guerrero número 227, colonia Las Fuentes, código postal 57600, municipio de Nezahualcóyotl, Estado de México, es responsable de recabar sus datos personales, del uso que se le dé a los mismos y de su protección. Su información personal será utilizada para proveer los servicios que ha solicitado, informarle sobre cambios en los mismos y evaluar la calidad del servicio que le brindamos. Para las finalidades antes mencionadas, requerimos obtener los siguientes datos personales: - domicilio, teléfono y/o correo electrónico¸ para brindarle la atención médica que requiera conforme a las políticas de la Empresa: a) Integrar su expediente clínico; b) El cumplimiento de los derechos y obligaciones adquiridos mediante el Contrato de la Prestación de Servicios Médicos; c) Compartir sus datos con sus médicos tratantes e interconsultantes, quienes son profesionistas independientes al establecimiento y quienes han asumido frente a Usted, la responsabilidad de su diagnóstico, pronóstico y tratamiento; d) Transferir sus datos, en su caso, a la aseguradora con quien tenga contratada una póliza de seguro de gastos médicos. Para consultar este aviso de privacidad de manera integral, podrá consultarlo en la Empresa o mediante la página web www.oxilive.com.mx. Fecha de actualización: marzo 2018. La información contenida en este correo electrónico es confidencial y está legalmente protegida. Está dirigido solamente a la dirección de correo señalada. El acceso a este correo electrónico por cualquier otra persona, No está autorizado. '), 'J');
          
      

        // Arial italic 8
        $this->Ln(-3);
        $this->SetFont('Arial', 'B', 6);
        // Número de página
        $this->Cell(150);
        $this->Cell(20, 10, utf8_decode('Página ' . $this->PageNo()) . ' de ' . '{nb}', 0, 0, 'R');
    }
}
// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetX(15);

// Conexión a la base de datos
require '../../../connection/conexion.php';

$fecha1 = $_GET['fecha1'];
$fecha2 = $_GET['fecha2'];

// Consulta para añadir información al PDF

$sentencia = $con->prepare("SELECT 
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
u.id_usuarios, u.Nombres, u.Apellidos");

$sentencia->bindParam(':fecha1', $fecha1);
$sentencia->bindParam(':fecha2', $fecha2);
$sentencia->execute();
$trabajador = $sentencia->fetchAll(PDO::FETCH_ASSOC);

$pdf->Ln(0.6);
$pdf->setX(15);
$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(25, 10, 'Asistencias', 1, 0, 'C', 0);
$pdf->Cell(60, 10, 'Nombre completo', 1, 0, 'C', 0);
$pdf->Cell(33, 10, 'Tipo de guardia', 1, 0, 'C', 0);
$pdf->Cell(30, 10, 'Dias laborados', 1, 0, 'C', 0);
$pdf->Cell(32, 10, 'Sueldo Total', 1, 1, 'C', 0);

foreach ($trabajador as $userRow) {
    $pdf->SetFont('Arial', '', 12);
    $pdf->setX(15);
    $pdf->Cell(25, 10, utf8_decode($userRow['numero_de_Asistencias']), 1, 0, 'C', 0);
    $pdf->Cell(60, 10, utf8_decode($userRow['NombreCompleto']), 1, 0, 'C', 0);
    $pdf->Cell(33, 10, utf8_decode($userRow['retardos']), 1, 0, 'C', 0);
    $descuento = ($userRow['retardos'] > 0) ? $userRow['sueldo_total'] / $userRow['retardos'] : 0;
    $pdf->Cell(30, 10, utf8_decode(isset($descuento) ? number_format($descuento, 2) : 0), 1, 0, 'C', 0);
    $pdf->Cell(32, 10, utf8_decode(number_format($userRow['sueldo_total'] - $descuento, 2)), 1, 1, 'C', 0);
}



$pdf->Output();
?>
