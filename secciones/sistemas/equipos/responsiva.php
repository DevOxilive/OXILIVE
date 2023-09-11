<?php
require('../../../fpdf/fpdf.php');
class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Logo
        $this->Image('../../../img/Logo.png', 15, 10, 60);
        // Arial bold 15
        $this->SetFont('Arial', 'B', 12);
        $this->Ln(4);
        // Movernos a la derecha
        $this->Cell(90);
        // Título
        $this->Cell(75, 20, 'RESPONSIVA DE BIENES Y VALORES', 0, 0, 'C');
        $this->Ln(10);
        $this->Cell(0, 20, 'Fecha', 0, 1, 'C');
        //Texto Explicativo
        // Salto de línea
        $this->Ln(5);
        $this->SetFont('Arial', '', 12);
        $this->Cell(0, 10, utf8_decode('Por medio de la presente se hace la entrega al usuario WW el equipo que acontinuacion se indica, mismo que utilizara para la elaboración de su trabajo, comprometiendose a resguardarlo y mantenerlo en buen estado, dandole exclusivamente uso laboral. '), 0, 0, 'J');
    }
    // Pie de página
    function Footer()
    {
        // Posición: a 4,0 cm del final
        $this->SetY(-40);
        // Arial italic 8
        $this->SetFont('Arial', '', 6);
        // Número de página
        $this->Ln();
        $this->MultiCell(190, 2.2, utf8_decode('OXILIVE S.A. de C.V., con domicilio en Villa de Guerrero número 227, colonia Las Fuentes, código postal 57600, municipio de Nezahualcóyotl, Estado de México, es responsable de recabar sus datos personales, del uso que se le dé a los mismos y de su protección. Su información personal será utilizada para proveer los servicios que ha solicitado, informarle sobre cambios en los mismos y evaluar la calidad del servicio que le brindamos. Para las finalidades antes mencionadas, requerimos obtener los siguientes datos personales: - domicilio, teléfono y/o correo electrónico¸ para brindarle la atención médica que requiera conforme a las políticas de la Empresa: a) Integrar su expediente clínico; b) El cumplimiento de los derechos y obligaciones adquiridos mediante el Contrato de la Prestación de Servicios Médicos; c) Compartir sus datos con sus médicos tratantes e interconsultantes, quienes son profesionistas independientes al establecimiento y quienes han asumido frente a Usted, la responsabilidad de su diagnóstico, pronóstico y tratamiento; d) Transferir sus datos, en su caso, a la aseguradora con quien tenga contratada una póliza de seguro de gastos médicos. Para consultar este aviso de privacidad de manera integral, podrá consultarlo en la Empresa o mediante la página web www.oxilive.com.mx. Fecha de actualización: marzo 2018. La información contenida en este correo electrónico es confidencial y está legalmente protegida. Está dirigido solamente a la dirección de correo señalada. El acceso a este correo electrónico por cualquier otra persona, No está autorizado. '), 0,0,'J');
        // Arial italic 8
    }
}
// Creación del objeto de la clase heredada
$pdf = new PDF(); //hacemos una instancia de la clase
$pdf->AliasNbPages();
$pdf->AddPage(); //añade l apagina / en blanco
$pdf->SetX(15);
require '../../../connection/conexion.php';
$txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
$sentencia = $con->prepare("SELECT * FROM equipo WHERE id_equipo=:id_equipo");
$sentencia->bindParam(":id_equipo", $txtID);
$sentencia->execute();
$equipo = $sentencia->fetch(PDO::FETCH_ASSOC);


$pdf->Output();
?>