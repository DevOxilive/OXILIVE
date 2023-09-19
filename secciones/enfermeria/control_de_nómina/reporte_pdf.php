
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

$sentencia = $con->prepare("SELECT COUNT(A.id_check) AS asistencias, A.id_check, CONCAT(S.Nombres, ' ', S.Apellidos) AS Nombre_completo, T.nombre_guardia AS Tipo_de_guardia,
    H.fecha AS Dias_laborados, SUM(T.sueldo) AS Sueldo_Total
    FROM usuarios S
    JOIN asistencias A ON S.id_usuarios = A.id_empleadoEnfermeria
    JOIN asignacion_horarios H ON S.id_usuarios = H.id_usuario
    JOIN puestos P ON S.id_departamentos = P.id_puestos
    JOIN tipos_guardias T ON T.id_tiposGuardias = H.id_tiposGuardias
    JOIN checkk C ON C.id_check = A.id_check
    JOIN empleados M ON M.Puesto = P.id_puestos
    JOIN estado E ON S.Estado = E.id_estado
    WHERE id_puestos = 6
    AND H.fecha BETWEEN :fecha1 AND :fecha2
    GROUP BY A.id_check, CONCAT(S.Nombres, ' ', S.Apellidos), T.nombre_guardia, H.fecha");

$sentencia->bindParam(':fecha1', $fecha1);
$sentencia->bindParam(':fecha2', $fecha2);
$sentencia->execute();

$pdf->Ln(0.6);
$pdf->setX(15);
$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(18, 10, 'Asistencias', 1, 0, 'C', 0);
$pdf->Cell(70, 10, 'Nombre completo', 1, 0, 'C', 0);
$pdf->Cell(33, 10, 'Tipo de guardia', 1, 0, 'C', 0);
$pdf->Cell(30, 10, 'Dias laborados', 1, 0, 'C', 0);
$pdf->Cell(32, 10, 'Sueldo Total', 1, 1, 'C', 0);

while ($userRow = $sentencia->fetch(PDO::FETCH_ASSOC)) {
    $pdf->SetFont('Arial', '', 12);
    $pdf->setX(15);
    $pdf->Cell(18, 10, utf8_decode($userRow['asistencias']), 1, 0, 'C', 0);
    $pdf->Cell(70, 10, utf8_decode($userRow['Nombre_completo']), 1, 0, 'C', 0);
    $pdf->Cell(33, 10, utf8_decode($userRow['Tipo_de_guardia']), 1, 0, 'C', 0);
    $pdf->Cell(30, 10, utf8_decode($userRow['Dias_laborados']), 1, 0, 'C', 0);
    $pdf->Cell(32, 10, utf8_decode($userRow['Sueldo_Total']), 1, 1, 'C', 0);
}

$pdf->Output();
?>
