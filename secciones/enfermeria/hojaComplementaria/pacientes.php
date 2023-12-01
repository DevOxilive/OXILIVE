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

        $this->SetTextColor(0, 0, 0);
        $this->SetFillColor(0, 175, 164);
        $this->Cell(46, 10, utf8_decode('Nombre del paciente:'), 0, 0, 'C');
        $this->Ln(0);

        $this->SetTextColor(0, 0, 0);
        $this->SetFillColor(0, 175, 164);
        $this->Cell(260, 10, utf8_decode('RFC:'), 0, 0, 'C');
        $this->Ln(10);

        $this->SetTextColor(0, 0, 0);
        $this->SetFillColor(0, 175, 164);
        $this->Cell(14, 10, utf8_decode('Calle:'), 0, 0, 'C');
        $this->Ln(10);

        $this->SetTextColor(0, 0, 0);
        $this->SetFillColor(0, 175, 164);
        $this->Cell(20, 10, utf8_decode('Colonia:'), 0, 0, 'C');
        $this->Ln(0);

        $this->SetTextColor(0, 0, 0);
        $this->SetFillColor(0, 175, 164);
        $this->Cell(290, 10, utf8_decode('CPT:'), 0, 0, 'C');
        $this->Ln(10);

        $this->SetTextColor(0, 0, 0);
        $this->SetFillColor(0, 175, 164);
        $this->Cell(23, 10, utf8_decode('Municipio:'), 0, 0, 'C');
        $this->Ln(0);

        $this->SetTextColor(0, 0, 0);
        $this->SetFillColor(0, 175, 164);
        $this->Cell(155, 10, utf8_decode('Estado:'), 0, 0, 'C');
        $this->Ln(10);

        $this->SetTextColor(0, 0, 0);
        $this->SetFillColor(0, 175, 164);
        $this->Cell(53, 10, utf8_decode('Nombre del Responsable:'), 0, 0, 'C');
        $this->Ln(10);

        $this->SetTextColor(0, 0, 0);
        $this->SetFillColor(0, 175, 164);
        $this->Cell(33, 10, utf8_decode('Administradora:'), 0, 0, 'C');
        $this->Ln(10);

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

$pdf = new PDF(); 
$pdf->AliasNbPages();
$pdf->AddPage();
require '../../../connection/conexion.php';
$txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
$sentencia = $con->prepare("
SELECT pa.*,CONCAT (pa.nombres,' ', pa.apellidos ) AS paciente, col.id AS colonia_id, col.nombre AS colonia, m.nombre AS municipio, e.nombre AS estadoDir, codigo_postal,bc.id_bancos, bc.Nombre_banco, ad.Nombre_administradora
    FROM pacientes_call_center pa, colonias col, bancos bc, administradora ad, municipios m, estados e
    WHERE pa.colonia = col.id
    AND col.municipio = m.id
    AND m.estado = e.id
    AND pa.bancosAdmi = bc.id_bancos
    AND bc.admi = ad.id_administradora
    AND pa.id_pacientes = :id_pacientes");
$sentencia->bindParam(":id_pacientes", $txtID);
$sentencia->execute();
$pdf->Ln(0.6);
$pdf->SetFont('Arial', '', 13);
$cuadro_ancho = 200;
$cuadro_alto = 120;

while ($user = $sentencia->fetch(PDO::FETCH_ASSOC)) {
    $carpeta_usuario = "./directorio_INES";
    // dentro del ciclo defino la ruta
    $nombre_Credencial_front_orginal = $user['Credencial_front'];
    $nombre_Credencial_post_orginal = $user['Credencial_post'];
    $nombre_Credencial_aseguradora_orginal = $user['Credencial_aseguradora'];
    $nombre_Credencial_aseguradoras_post_orginal = $user['Credencial_aseguradoras_post'];
    $rutaCredencialFront = $carpeta_usuario . "/" . $nombre_Credencial_front_orginal;
    $rutaCredencialPost = $carpeta_usuario . "/" . $nombre_Credencial_post_orginal;
    $rutaCredencialAseguradora = $carpeta_usuario . "/" . $nombre_Credencial_aseguradora_orginal;
    $rutaCredencialAseguradorasPost = $carpeta_usuario . "/" . $nombre_Credencial_aseguradoras_post_orginal;
    
    //Este es mi tamañao de las imagenes
    $pdf->Image($rutaCredencialFront, 20, 140, 80, 40);
    $pdf->Image($rutaCredencialPost, 110, 140, 80, 40);
    // Coloca las dos imágenes inferiores con el tamaño deseado
    $pdf->Image($rutaCredencialAseguradora, 20, 187, 80, 40);
    $pdf->Image($rutaCredencialAseguradorasPost, 110, 187, 80, 40);
// Obtén la longitud del nombre del paciente y usa ese valor para ajustar las posiciones de las líneas y celdas
$longitudNombrePaciente = strlen($user['paciente']);
$ajusteXPaciente = 52 + $longitudNombrePaciente * 1.5; // Puedes ajustar el factor multiplicativo según sea necesario

$longitudNombreResponsable = strlen($user['responsable']);
$ajusteXResponsable = 10 + $longitudNombreResponsable * 1.5; // Puedes ajustar el factor multiplicativo según sea necesario

$pdf->SetXY(31, 75);
$pdf->Cell($ajusteXPaciente, 10, '' . utf8_decode($user['paciente']), 0, 0, 'R', 0);
$pdf->Line(30 + $ajusteXPaciente, 82, 55, 82);
$pdf->Cell(20);
$pdf->Ln();
$pdf->Cell(306, 10, '' . utf8_decode($user['rfc']), 0, 0, 'C', 0);
$pdf->Line(146, 82, 183, 82);
$pdf->Ln();
$pdf->SetXY(23, 75);
$pdf->Cell(35, 30, '' . utf8_decode($user['calle']), 0, 0, 'U', 0);
$pdf->Line(23, 92, 130, 92);
$pdf->SetXY(120, 75);
$pdf->Cell(50, 30, utf8_decode('Núm.Ext: ') . utf8_decode($user['num_ext']), 0, 0, 'C', 0);
$pdf->Line(153, 92, 168, 92);
$pdf->SetXY(145, 75);
$pdf->Cell(70, 30, utf8_decode('Núm.Int: ') . utf8_decode($user['num_int']), 0, 0, 'C', 0);
$pdf->Line(188, 92, 200, 92);
$pdf->Ln();
$pdf->SetXY(45, 95);
$pdf->Cell(43, 10, '' . utf8_decode($user['colonia']), 0, 0, 'R', 0);
$pdf->Line(27, 102, 120, 102);
$pdf->Cell(20);
$pdf->Cell(120, 10, utf8_decode('') . utf8_decode($user['codigo_postal']), 0, 0, 'C', 0);
$pdf->Line(160, 102, 177, 102);
$pdf->Ln();
$pdf->SetXY(12, 105);
$pdf->Cell(65, 10, '' . utf8_decode($user['municipio']), 0, 0, 'R', 0);
$pdf->Line(31, 112, 75, 112);
$pdf->Cell(20);
$pdf->Cell(35, 10, utf8_decode('') . utf8_decode($user['estadoDir']), 0, 0, 'C', 0);
$pdf->Line(93, 112, 136, 112);
$pdf->Cell(85, 10, utf8_decode('Tel. de casa: ') . utf8_decode($user['telefono']), 0, 0, 'C', 0);
$pdf->Line(175, 112, 202, 112);
$pdf->Ln();
$pdf->SetXY(75, 115);
$pdf->Cell($ajusteXResponsable, 10, '' . utf8_decode($user['responsable']), 0, 0, 'R', 0);
$pdf->Line(5 + $ajusteXResponsable, 122, 200, 122);
$pdf->SetXY(15, 75);
$pdf->Cell(55, 110, '' . utf8_decode($user['Nombre_administradora']), 0, 0, 'R', 0);
$pdf->Line(43, 132, 83, 132);
$pdf->SetXY(93, 75);
$pdf->Cell(25, 110, utf8_decode('N° de contrato: ') . utf8_decode(''), 0, 0, 'C', 0);
$pdf->Line(120, 132, 143, 132);
$pdf->SetXY(160, 75);
$pdf->Cell(25, 110, utf8_decode('N° de empleado: ') . utf8_decode($user['No_nomina']), 0, 0, 'C', 0);
$pdf->Line(180, 132, 200, 132);
}
$pdf->Ln();

$pdf->Output();
?>