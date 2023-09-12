
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
$pdf = new PDF(); //hacemos una instancia de la clase
$pdf->AliasNbPages();
$pdf->AddPage(); //añade l apagina / en blanco
$pdf->SetX(15);


//Conexión a la base de datos

require '../../../connection/conexion.php';

//Consutal para añadir información al pdf
$sentencia = $con->prepare(" SELECT trabajador.*, puestos.Nombre_puestos 
FROM usuarios AS trabajador 
JOIN estado AS est ON trabajador.Estado = est.id_estado
JOIN puestos ON trabajador.id_departamentos = puestos.id_puestos
WHERE Nombre_puestos = 'Enfermeria' ");
//Tabla dentro del pdf con los datos a solicitar
$sentencia->execute();
$pdf->Ln(0.6);
$pdf->setX(15);
$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(18, 10, 'Usuario',1, 0, 'C', 0);
$pdf->Cell(70, 10, 'Nombre completo',1, 0, 'C', 0);
$pdf->Cell(33, 10, 'Dias laborados',1, 0, 'C', 0);
$pdf->Cell(30, 10, utf8_decode('Sueldo total'), 1, 0, 'C', 0);
$pdf->Cell(32, 10, utf8_decode('Tipo de guardia'), 1, 1, 'C', 0);

//Datos consultados
while ($userRow = $sentencia->fetch(PDO::FETCH_ASSOC)) {
    $pdf->SetFont('Arial', '', 12);
    $pdf->setX(15);
    $pdf->Cell(18, 10, utf8_decode($userRow['id_usuarios']) , 1, 0, 'C', 0);
    $pdf->Cell(70, 10, utf8_decode($userRow['Nombres']) . " " . utf8_decode($userRow['Apellidos']) , 1, 0, 'C', 0);
    $pdf->Cell(33, 10, utf8_decode($userRow['Nombre_puestos']) , 1, 0, 'C', 0);
    $pdf->Cell(30, 10, utf8_decode($userRow['codigo_postal']) , 1, 0, 'C', 0);
    $pdf->Cell(32, 10, $userRow['rfc'], 1, 1, 'C', 0);
}
$pdf->Output();
?>