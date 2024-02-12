<?php
require('../../../fpdf/fpdf.php');

class ReporteFecha extends FPDF {
    function Header() {
        $this->Image('../../../img/Logo.png', 10, 10, 30);

        $this->SetFont('Arial', 'B', 18);
        $this->Cell(0, 15, 'Reporte de Rutas para el dia  ' . $_GET['fecha'], 0, 1, 'C');

        $this->SetDrawColor(0, 102, 204); 
        $this->SetLineWidth(1); 
        $this->Line(10, 35, 200, 35);
        $this->Ln(20);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Pagina '.$this->PageNo().'/{nb}', 0, 0, 'C');
    }

    function generarReporteFecha() {
        include ("../../../connection/conexion.php");
        $this->AddPage('L', 'Letter');
        $fecha = $_GET['fecha'];
        $this->SetFont('Arial', 'B', 8);
        $this->SetFillColor(230, 230, 230); 
        $this->SetTextColor(0);
        $this->SetDrawColor(0); 
        $this->SetLineWidth(.3); 
        $header = array('ID', 'Paciente', 'Direccion', 'Alcaldia', 'Telefono', 'Aseguradora','T','R','P','A','C','B', 'A', 'P','P','V','M','C','R','R','R','NOTAS');
        $w = array(5, 45, 55, 21, 21, 22, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 30,); 

        $sentenciaCarros = $con->prepare("SELECT id_carro, Nombre_carro FROM carros");
        $sentenciaCarros->execute();
        $carros = $sentenciaCarros->fetchAll(PDO::FETCH_ASSOC);

        foreach ($carros as $carro) {
            $sentenciaRutas = $con->prepare("SELECT COUNT(*) as num_rutas FROM ruta_diaria_oxigeno WHERE Fecha_agenda = :fecha AND Carro = :id_carro");
            $sentenciaRutas->bindParam(':fecha', $fecha);
            $sentenciaRutas->bindParam(':id_carro', $carro['id_carro']);
            $sentenciaRutas->execute();
            $result = $sentenciaRutas->fetch(PDO::FETCH_ASSOC);
            $num_rutas = $result['num_rutas'];
        
            if ($num_rutas > 0) {
                $this->Cell(0, 10, 'Rutas para el Carro: ' . $carro['Nombre_carro'], 0, 1, 'C', true);
                $this->Ln(5);
        
                for ($i = 0; $i < count($header); $i++) {
                    $this->Cell($w[$i], 10, $header[$i], 1, 0, 'C', true);
                }
                $this->Ln();
        
                $sentenciaRutas = $con->prepare("SELECT id_ruta, Paciente, Direccion, Alcaldia, Telefono, Aseguradora, Tanque, Regulador, Portatil, Aspirador, Cpac, Bipac, Agua, Puntas_n, Puntas_neon, Vaso_borb, Mascarilla, Canula, Recoleccion_tanque, Recoleccion_aspi, Recoleccion_concentrador, Nota FROM ruta_diaria_oxigeno WHERE Fecha_agenda = :fecha AND Carro = :id_carro");
                $sentenciaRutas->bindParam(':fecha', $fecha);
                $sentenciaRutas->bindParam(':id_carro', $carro['id_carro']);
                $sentenciaRutas->execute();
                $rutas = $sentenciaRutas->fetchAll(PDO::FETCH_ASSOC);
        
                $this->SetFont('Arial', '', 8.5);
                $fill = false; 
                foreach ($rutas as $ruta) {
                    $this->Cell($w[0], 10, $ruta['id_ruta'], 'LR', 0, 'C', $fill);
                    $this->Cell($w[1], 10, $ruta['Paciente'], 'LR', 0, 'L', $fill);
                    $this->Cell($w[2], 10, $ruta['Direccion'], 'LR', 0, 'L', $fill);
                    $this->Cell($w[3], 10, $ruta['Alcaldia'], 'LR', 0, 'L', $fill);
                    $this->Cell($w[4], 10, $ruta['Telefono'], 'LR', 0, 'L', $fill);
                    $this->Cell($w[5], 10, $ruta['Aseguradora'], 'LR', 0, 'C', $fill);
                    $this->Cell($w[6], 10, $ruta['Tanque'], 'LR', 0, 'C', $fill);
                    $this->Cell($w[7], 10, $ruta['Regulador'], 'LR', 0, 'C', $fill);
                    $this->Cell($w[8], 10, $ruta['Portatil'], 'LR', 0, 'C', $fill);
                    $this->Cell($w[9], 10, $ruta['Aspirador'], 'LR', 0, 'C', $fill);
                    $this->Cell($w[10], 10, $ruta['Cpac'], 'LR', 0, 'C', $fill);
                    $this->Cell($w[11], 10, $ruta['Bipac'], 'LR', 0, 'C', $fill);
                    $this->Cell($w[12], 10, $ruta['Agua'], 'LR', 0, 'C', $fill);
                    $this->Cell($w[13], 10, $ruta['Puntas_n'], 'LR', 0, 'C', $fill);
                    $this->Cell($w[14], 10, $ruta['Puntas_neon'], 'LR', 0, 'C', $fill);
                    $this->Cell($w[15], 10, $ruta['Vaso_borb'], 'LR', 0, 'C', $fill);
                    $this->Cell($w[16], 10, $ruta['Mascarilla'], 'LR', 0, 'C', $fill);
                    $this->Cell($w[17], 10, $ruta['Canula'], 'LR', 0, 'C', $fill);
                    $this->Cell($w[18], 10, $ruta['Recoleccion_tanque'], 'LR', 0, 'C', $fill);
                    $this->Cell($w[19], 10, $ruta['Recoleccion_aspi'], 'LR', 0, 'C', $fill);
                    $this->Cell($w[20], 10, $ruta['Recoleccion_concentrador'], 'LR', 0, 'C', $fill);
                    $this->Cell($w[21], 10, $ruta['Nota'], 'LR', 0, 'C', $fill);
                    $this->Ln();
                    $fill = !$fill; 
                }
                $this->Cell(array_sum($w), 0, '', 'T');
                $this->Ln(10);
            }
        }

        $this->Output();
    }
}

$pdf = new ReporteFecha();
$pdf->AliasNbPages();
$pdf->generarReporteFecha();
?>
