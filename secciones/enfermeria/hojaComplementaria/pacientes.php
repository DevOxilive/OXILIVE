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
        $this->SetFillColor(0, 88, 128);
        $this->Cell(105);
        $this->Cell(90, 3, '', 0, 0, 'R', 'true');
        $this->Ln(4);
        $this->SetFillColor(0, 175, 164);
        $this->Cell(150);
        $this->Cell(45, 3, '', 0, 0, 'R', 'true');
        $this->Ln(4);
        $this->SetFillColor(0, 88, 128);
        $this->Cell(172.5);
        $this->Cell(22.5, 3, '', 0, 0, 'R', 'true');
        $this->SetFont('Arial', '', 10);
        $this->Ln(4);
        // Movernos a la derecha
        $this->Cell(80);
        // Título
        $this->SetXY(145,35);
        $this->Cell(15, 8,'FECHA:   '.  date('d/m/Y'), 0,1,'L');
        $this->Line(162, 42, 180, 42);
        $this->SetFillColor(0, 88, 128);
        //Texto Explicativo
        $this->SetFont('helvetica', 'B', 18);
        $this->SetTextColor(0, 88, 128);
        $this->Cell(0, 8, utf8_decode('ORDEN DE RENTA'), 0, 'C');
        $this->Ln(0,5);
        $this->Cell(0, 8, utf8_decode('COMPLEMENTARIA ID'), 0, 'C');
        // Salto de línea
        $this->Ln(2);
        $this->SetFont('helvetica', 'B', 12);
        $this->SetTextColor(255, 255, 255);
        $this->SetFillColor(0, 175, 164);
        $this->Cell(60, 7, utf8_decode('DATOS PERSONALES'), 0, 0, 'C', 'true');
        $this->Ln(14);

    }
    // Pie de página
    function Footer()
    {
        // Posición: a 4,0 cm del final
        $this->SetY(-40);
        // Arial italic 8
        $this->SetFont('Arial', '', 6);
        // Número de página
        $this->Ln(8);
        $this->MultiCell(190, 2.2, utf8_decode('OXILIVE S.A. de C.V., con domicilio en Villa de Guerrero número 227, colonia Las Fuentes, código postal 57600, municipio de Nezahualcóyotl, Estado de México, es responsable de recabar sus datos personales, del uso que se le dé a los mismos y de su protección. Su información personal será utilizada para proveer los servicios que ha solicitado, informarle sobre cambios en los mismos y evaluar la calidad del servicio que le brindamos. Para las finalidades antes mencionadas, requerimos obtener los siguientes datos personales: - domicilio, teléfono y/o correo electrónico¸ para brindarle la atención médica que requiera conforme a las políticas de la Empresa: a) Integrar su expediente clínico; b) El cumplimiento de los derechos y obligaciones adquiridos mediante el Contrato de la Prestación de Servicios Médicos; c) Compartir sus datos con sus médicos tratantes e interconsultantes, quienes son profesionistas independientes al establecimiento y quienes han asumido frente a Usted, la responsabilidad de su diagnóstico, pronóstico y tratamiento; d) Transferir sus datos, en su caso, a la aseguradora con quien tenga contratada una póliza de seguro de gastos médicos. Para consultar este aviso de privacidad de manera integral, podrá consultarlo en la Empresa o mediante la página web www.oxilive.com.mx. Fecha de actualización: marzo 2018. La información contenida en este correo electrónico es confidencial y está legalmente protegida. Está dirigido solamente a la dirección de correo señalada. El acceso a este correo electrónico por cualquier otra persona, No está autorizado. '), 'J');
        // Arial italic 8
    }
}

$pdf = new PDF(); //hacemos una instancia de la clase
$pdf->AliasNbPages();
$pdf->AddPage(); //añade l apagina / en blanco
require '../../../connection/conexion.php';
$txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
$sentencia = $con->prepare("
SELECT po.*, a.Nombre_administradora, aseg.Nombre_aseguradora
             FROM pacientes_oxigeno AS po
             LEFT JOIN administradora AS a ON po.Administradora = a.id_administradora
             LEFT JOIN aseguradoras AS aseg ON po.Aseguradora = aseg.id_aseguradora
             WHERE po.id_pacientes = :id_pacientes");
$sentencia->bindParam(":id_pacientes", $txtID);
$sentencia->execute();

$pdf->Ln(0.6);
$pdf->SetFont('Arial', '', 13);
$cuadro_ancho = 200;
$cuadro_alto = 120;

while ($userRow = $sentencia->fetch(PDO::FETCH_ASSOC)) {
    $carpeta_usuario = "./PAPELETA/" . $userRow['Apellidos'] . " " . $userRow['Nombres'];
    // Define las rutas de las imágenes dentro del bucle
    //$nombre_Credencial_front_orginal = $userRow['Credencial_front'];
    //$nombre_Credencial_post_orginal = $userRow['Credencial_post'];
    $nombre_Credencial_aseguradora_orginal = $userRow['Credencial_aseguradora'];
    $nombre_Credencial_aseguradoras_post_orginal = $userRow['Credencial_aseguradoras_post'];

    //$rutaCredencialFront = $carpeta_usuario . "/" . $nombre_Credencial_front_orginal;
    //$rutaCredencialPost = $carpeta_usuario . "/" . $nombre_Credencial_post_orginal;
    $rutaCredencialAseguradora = $carpeta_usuario . "/" . $nombre_Credencial_aseguradora_orginal;
    $rutaCredencialAseguradorasPost = $carpeta_usuario . "/" . $nombre_Credencial_aseguradoras_post_orginal;
    
    // Coloca las dos imágenes superiores con el tamaño deseado
    //$pdf->Image($rutaCredencialFront, 20, 140, 80, 50);
    //$pdf->Image($rutaCredencialPost, 110, 140, 80, 50);

    // Coloca las dos imágenes inferiores con el tamaño deseado
    $pdf->Image($rutaCredencialAseguradora, 20, 200, 80, 50);
    $pdf->Image($rutaCredencialAseguradorasPost, 110, 200, 80, 50);

$pdf->SetXY(20,75);
$pdf->Cell(90, 10, 'Nombre del Paciente:    '.utf8_decode($userRow['Nombres']) . '  ' .utf8_decode($userRow['Apellidos']) ,0, 0, 'R', 0);
$pdf->Line(120, 82,55, 82); $pdf->Line(185, 82,150, 82);
$pdf->Cell(30);
$pdf->Cell(40, 10, 'RFC: ' .utf8_decode($userRow['rfc']),0, 0, 'C', 0);
$pdf->Ln();
$pdf->SetXY(8,85);
$pdf->Cell(55, 10, 'Calle:    '.utf8_decode($userRow['calle']),0, 0, 'R', 0);
// $pdf->Line(100, 82,55, 82); $pdf->Line(170, 82,142, 82);
$pdf->Cell(20);
$pdf->Cell(50, 10, utf8_decode('Núm.Ext: ') .utf8_decode($userRow['num_ext']),0, 0, 'C', 0);
$pdf->Cell(70, 10, utf8_decode('Núm.Int: ') .utf8_decode($userRow['num_in']),0, 0, 'C', 0);
// $pdf->Cell(35, 10, utf8_decode('Núm. Nomina'), 1, 1, 'C', 0);
$pdf->Ln();
$pdf->SetXY(8,95);
$pdf->Cell(55, 10, 'Colonia:    '.utf8_decode($userRow['colonia']),0, 0, 'R', 0);
// $pdf->Line(100, 82,55, 82); $pdf->Line(170, 82,142, 82);
$pdf->Cell(20);
$pdf->Cell(50, 10, utf8_decode('CP: ') .utf8_decode($userRow['cp']),0, 0, 'C', 0);
$pdf->Cell(70, 10, utf8_decode('Alcaldia: ') .utf8_decode($userRow['Alcaldia']),0, 0, 'C', 0);
// $pdf->Cell(35, 10, utf8_decode('Núm. Nomina'), 1, 1, 'C', 0);
$pdf->Ln();
$pdf->SetXY(20,105);
$pdf->Cell(55, 10, 'Municipio:    '.utf8_decode($userRow['municipio']),0, 0, 'R', 0);
// $pdf->Line(100, 82,55, 82); $pdf->Line(170, 82,142, 82);
$pdf->Cell(20);
$pdf->Cell(35, 10, utf8_decode('Estado: ') .utf8_decode($userRow['estado_direccion']),0, 0, 'C', 0);
$pdf->Cell(85, 10, utf8_decode('Tel. de casa: ') .utf8_decode($userRow['Telefono']),0, 0, 'C', 0);
// $pdf->Cell(35, 10, utf8_decode('Núm. Nomina'), 1, 1, 'C', 0);
$pdf->Ln();
$pdf->SetXY(20,115);
$pdf->Cell(55, 10, 'Nombre del Responsable:    '.utf8_decode($userRow['responsable']),0, 0, 'R', 0);
// $pdf->Line(100, 82,55, 82); $pdf->Line(170, 82,142, 82);
$pdf->Ln();
$pdf->SetXY(8,125);
$pdf->Cell(55, 10, 'Aseguradora:    '.utf8_decode($userRow['Nombre_aseguradora']),0, 0, 'R', 0);
// $pdf->Line(100, 82,55, 82); $pdf->Line(170, 82,142, 82);
$pdf->Cell(20);
$pdf->Cell(25, 10, utf8_decode('N° de contrato: ') .utf8_decode($userRow['Nombre_administradora']),0, 0, 'C', 0);
$pdf->Cell(105, 10, utf8_decode('N° de empleado: ') .utf8_decode($userRow['No_nomina']),0, 0, 'C', 0);
// $pdf->Cell(35, 10, utf8_decode('Núm. Nomina'), 1, 1, 'C', 0);
}
$pdf->Ln();


$pdf->Output();
?>