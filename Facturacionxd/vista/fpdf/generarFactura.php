<?php

require('./fpdf.php');
$factura_serializado = $_GET['datoFactura'];
$factura = unserialize($factura_serializado);

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // LOGO empresa
        $this->Image('logo_2.png', 10, 10, 20);

        // Nombre Empresa
        $this->SetFont('Arial', 'B', 19);
        $this->SetXY(35, 10);
        $this->SetTextColor(0, 0, 0);
        $this->Cell(110, 10, utf8_decode('Encanto Natural'), 0, 1, 'C', 0);

        // Información de la empresa
        $this->SetFont('Arial', 'B', 10);
        $this->SetXY(140, 10);
        $this->Cell(96, 5, utf8_decode("Ubicación : Ubicación de la empresa"), 0, 1, '');
        $this->SetX(140);
        $this->Cell(59, 5, utf8_decode("Teléfono : Teléfono de la empresa"), 0, 1, '');
        $this->SetX(140);
        $this->Cell(85, 5, utf8_decode("Correo : Correo de la empresa"), 0, 1, '');
        $this->SetX(140);
        $this->Cell(85, 5, utf8_decode("Sucursal : Sucursal de la empresa"), 0, 1, '');
        $this->SetX(140);
        $this->Cell(85, 5, utf8_decode("Fecha : " . date("d/m/Y")), 0, 1, '');

        $this->SetTextColor(101, 107, 100);
        $this->Cell(50);
        $this->SetFont('Arial', 'B', 15);
        $this->Cell(100, 10, utf8_decode("Comprobantes"), 0, 1, 'C', 0);
        $this->Ln(7);

        $this->SetFillColor(101, 107, 100);
        $this->SetTextColor(255, 255, 255);
        $this->SetDrawColor(163, 163, 163);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(31, 10, utf8_decode('N° comprobante'), 1, 0, 'C', 1);
        $this->Cell(35, 10, utf8_decode('Tipo comprobante'), 1, 0, 'C', 1);
        $this->Cell(29, 10, utf8_decode('Fecha creacíon'), 1, 0, 'C', 1);
        $this->Cell(27, 10, utf8_decode('Hora creación'), 1, 0, 'C', 1);
        $this->Cell(14, 10, utf8_decode('Cliente'), 1, 0, 'C', 1);
        $this->Cell(20, 10, utf8_decode('Facturado'), 1, 1, 'C', 1);
    }


    // Pie de página
    function Footer()
    {

        // QR
        $this->SetY(-28); // Ajusta la posición Y para que haya espacio suficiente para el QR y el texto
        $this->Image('qr.png', 10, $this->GetY(), 20); // Ajusta la posición del QR dentro del pie de página

        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C');

        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $hoy = date('d/m/Y');
        $this->Cell(355, 10, utf8_decode($hoy), 0, 0, 'C');
    }
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->AliasNbPages();

$i = 0;
$pdf->SetFont('Arial', '', 12);
$pdf->SetDrawColor(163, 163, 163);

$pdf->Cell(31, 10, utf8_decode($factura['id_factura']), 1, 0, 'C', 0);
$pdf->Cell(35, 10, utf8_decode($factura['tipoFactura']), 1, 0, 'C', 0);
$pdf->Cell(29, 10, utf8_decode($factura['fecha']), 1, 0, 'C', 0);
$pdf->Cell(27, 10, utf8_decode($factura['hora']), 1, 0, 'C', 0);
$pdf->Cell(14, 10, utf8_decode($factura['nombre_cliente']), 1, 0, 'C', 0);
$pdf->Cell(20, 10, utf8_decode($factura['total']), 1, 1, 'C', 0);

$pdf->Output('Factura.pdf', 'I');
