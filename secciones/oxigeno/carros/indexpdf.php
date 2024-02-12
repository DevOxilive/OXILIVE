<?php
require('../../../fpdf/fpdf.php');
class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Logo
        $this->Image('../../../img/Logo.png', 15, 8, 60);
        // Arial bold 15
        $this->SetFont('Arial', 'B', 20);
        // Movernos a la derecha
        $this->Cell(80);
        // Título
        $this->Cell(100, 15, 'OXILIVE', 0, 1, 'C');
        //Texto Explicativo
        $this->SetFont('Courier', '', 12);
        $this->MultiCell(260, 5, utf8_decode('Listado de TRANSPORTER'), 0, 'C');

        // Salto de línea
        $this->Ln(20);
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(60, 10, 'Nombre del carro', 1, 0, 'C', 0);
        $this->Cell(60, 10, 'Modelo', 1, 0, 'C', 0);
        $this->Cell(35, 10, 'Marca', 1, 0, 'C', 0);
        $this->Cell(35, 10, 'Placa', 1, 0, 'C', 0);
        $this->Cell(50, 10, 'Fecha', 1, 1, 'C', 0);
    }

    // Pie de página
    // function Footer()
    // {
    //     // Posición: a 1,5 cm del final
    //     $this->SetY(-20);
    //     // Arial italic 8
    //     $this->SetFont('Arial', 'I', 8);
    //     // Número de página
    //     $this->Cell(0, 10, utf8_decode('Página ' . $this->PageNo()) . ' de ' . '{nb}', 0, 0, 'R');
    // }
    function Footer()
    {
        // Posición: a 4,0 cm del final
        $this->SetY(-40);
        // Arial italic 8
        $this->SetFont('Arial', 'B', 7);
        // Número de página
        $this->Cell(80);
        $this->Cell(20, 10, utf8_decode('Aviso de Privacidad'), 0, 0);
        $this->Ln(8);
        $this->MultiCell(270, 2.2, utf8_decode('OXILIVE S.A. de C.V., con domicilio en Villa de Guerrero número 227, colonia Las Fuentes, código postal 57600, municipio de Nezahualcóyotl, Estado de México, es responsable de recabar sus datos personales, del uso que se le dé a los mismos y de su protección. Su información personal será utilizada para proveer los servicios que ha solicitado, informarle sobre cambios en los mismos y evaluar la calidad del servicio que le brindamos. Para las finalidades antes mencionadas, requerimos obtener los siguientes datos personales: - domicilio, teléfono y/o correo electrónico¸ para brindarle la atención médica que requiera conforme a las políticas de la Empresa: a) Integrar su expediente clínico; b) El cumplimiento de los derechos y obligaciones adquiridos mediante el Contrato de la Prestación de Servicios Médicos; c) Compartir sus datos con sus médicos tratantes e interconsultantes, quienes son profesionistas independientes al establecimiento y quienes han asumido frente a Usted, la responsabilidad de su diagnóstico, pronóstico y tratamiento; d) Transferir sus datos, en su caso, a la aseguradora con quien tenga contratada una póliza de seguro de gastos médicos. Para consultar este aviso de privacidad de manera integral, podrá consultarlo en la Empresa o mediante la página web www.oxilive.com.mx. Fecha de actualización: marzo 2018. La información contenida en este correo electrónico es confidencial y está legalmente protegida. Está dirigido solamente a la dirección de correo señalada. El acceso a este correo electrónico por cualquier otra persona, No está autorizado. '), 'J');
        // Arial italic 8
        $this->Ln(-3);
        $this->SetFont('Arial', 'B', 6);
        // Número de página
        $this->Cell(150);
        $this->Cell(20, 10, utf8_decode('Página ' . $this->PageNo()) . ' de ' . '{nb}', 0, 0, 'R');
    }
}

require '../../../connection/conexion.php';
$sentencia = $con->prepare("SELECT * FROM carros");
$sentencia->execute();

$pdf = new PDF('L', 'mm', 'A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);

while ($userRow = $sentencia->fetch(PDO::FETCH_ASSOC)) {
    $pdf->Cell(60, 10, $userRow['Nombre_carro'], 1, 0, 'C', 0);
    $pdf->Cell(60, 10, $userRow['modelo'], 1, 0, 'C', 0);
    $pdf->Cell(35, 10, $userRow['marca'], 1, 0, 'C', 0);
    $pdf->Cell(35, 10, $userRow['placa'], 1, 0, 'C', 0);
    $pdf->Cell(50, 10, $userRow['Fecha_registro'], 1, 1, 'C', 0);
    
}
$pdf->Output();
?>