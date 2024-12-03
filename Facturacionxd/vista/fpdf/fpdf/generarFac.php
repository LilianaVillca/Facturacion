<?php

// require('./fpdf.php');
// $factura_serializado = $_GET['datoFactura'];
// $factura = unserialize($factura_serializado);

// class PDF extends FPDF
// {
//     // Cabecera de página
//     function Header()
//     {
//         // LOGO empresa
//         $this->Image('logo_2.png', 10, 10, 20);

//         // Nombre Empresa
//         $this->SetFont('Arial', 'B', 19);
//         $this->SetXY(35, 10);
//         $this->SetTextColor(0, 0, 0);
//         $this->Cell(110, 10, utf8_decode('Encanto Natural'), 0, 1, 'C', 0);

//         // Información de la empresa
//         $this->SetFont('Arial', 'B', 10);
//         $this->SetXY(140, 10);
//         $this->Cell(96, 5, utf8_decode("Ubicación : Ubicación de la empresa"), 0, 1, '');
//         $this->SetX(140);
//         $this->Cell(59, 5, utf8_decode("Teléfono : Teléfono de la empresa"), 0, 1, '');
//         $this->SetX(140);
//         $this->Cell(85, 5, utf8_decode("Correo : Correo de la empresa"), 0, 1, '');
//         $this->SetX(140);
//         $this->Cell(85, 5, utf8_decode("Sucursal : Sucursal de la empresa"), 0, 1, '');
//         $this->SetX(140);
//         $this->Cell(85, 5, utf8_decode("Fecha : " . date("d/m/Y")), 0, 1, '');

//         $this->SetTextColor(101, 107, 100);
//         $this->Cell(50);
//         $this->SetFont('Arial', 'B', 15);
//         $this->Cell(100, 10, utf8_decode("Facturas"), 0, 1, 'C', 0);
//         $this->Ln(7);

//         $this->SetFillColor(101, 107, 100);
//         $this->SetTextColor(255, 255, 255);
//         $this->SetDrawColor(163, 163, 163);
//         $this->SetFont('Arial', 'B', 11);
//         $this->Cell(18, 10, utf8_decode('N° Factura'), 1, 0, 'C', 1);
//         $this->Cell(20, 10, utf8_decode('CANTIDAD'), 1, 0, 'C', 1);
//         $this->Cell(30, 10, utf8_decode('TIPO'), 1, 0, 'C', 1);
//         $this->Cell(25, 10, utf8_decode('%'), 1, 0, 'C', 1);
//         $this->Cell(70, 10, utf8_decode('PRECIO UNITARIO'), 1, 0, 'C', 1);
//         $this->Cell(25, 10, utf8_decode('TOTAL'), 1, 1, 'C', 1);
//     }


//     // Pie de página
//     function Footer()
//     {

//         // QR
//         $this->SetY(-28); // Ajusta la posición Y para que haya espacio suficiente para el QR y el texto
//         $this->Image('qr.png', 10, $this->GetY(), 20); // Ajusta la posición del QR dentro del pie de página

//         $this->SetY(-15);
//         $this->SetFont('Arial', 'I', 8);
//         $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C');

//         $this->SetY(-15);
//         $this->SetFont('Arial', 'I', 8);
//         $hoy = date('d/m/Y');
//         $this->Cell(355, 10, utf8_decode($hoy), 0, 0, 'C');
//     }
// }

// $pdf = new PDF();
// $pdf->AddPage();
// $pdf->AliasNbPages();

// $i = 0;
// $pdf->SetFont('Arial', '', 12);
// $pdf->SetDrawColor(163, 163, 163);

// $pdf->Cell(18, 10, utf8_decode($factura['id_factura']), 1, 0, 'C', 0);
// $pdf->Cell(20, 10, utf8_decode($factura['id_usuario']), 1, 0, 'C', 0);
// $pdf->Cell(30, 10, utf8_decode($factura['total_ante_impuesto']), 1, 0, 'C', 0);
// $pdf->Cell(25, 10, utf8_decode($factura['total_impuesto']), 1, 0, 'C', 0);
// $pdf->Cell(70, 10, utf8_decode($factura['total_despues_impuesto']), 1, 0, 'C', 0);
// $pdf->Cell(25, 10, utf8_decode($factura['monto_pagado']), 1, 1, 'C', 0);

// $pdf->Output('Factura.pdf', 'I');




require('./fpdf.php');
$factura_serializado = $_GET['datoFactura'];
$factura = unserialize($factura_serializado);

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Logo de la empresa
        $this->Image('logo_2.png', 10, 10, 20);

        // Nombre de la empresa
        $this->SetFont('Arial', 'B', 19);
        $this->SetXY(35, 10);
        $this->SetTextColor(0, 0, 0);
        $this->Cell(110, 10, utf8_decode('Encanto Natural'), 0, 1, 'C');

        // Información de la empresa
        $this->SetFont('Arial', 'B', 10);
        $this->SetXY(140, 10);
        $this->Cell(96, 5, utf8_decode("Ubicación: Ubicación de la empresa"), 0, 1);
        $this->SetX(140);
        $this->Cell(59, 5, utf8_decode("Teléfono: Teléfono de la empresa"), 0, 1);
        $this->SetX(140);
        $this->Cell(85, 5, utf8_decode("Correo: Correo de la empresa"), 0, 1);
        $this->SetX(140);
        $this->Cell(85, 5, utf8_decode("Fecha: " . $factura['fecha']), 0, 1);

        // Título de la factura
        $this->SetTextColor(101, 107, 100);
        $this->Cell(50);
        $this->SetFont('Arial', 'B', 15);
        $this->Cell(100, 10, utf8_decode("Factura No: " . $factura['id_factura']), 0, 1, 'C');
        $this->Ln(7);

        // Datos del cliente
        $this->SetFont('Arial', 'B', 12);
        $this->SetTextColor(0, 0, 0);
        $this->Cell(0, 10, utf8_decode("Cliente: " . $factura['nombre_cliente']), 0, 1);
        $this->Ln(7);

        // Encabezado de la tabla de detalles
        $this->SetFillColor(101, 107, 100);
        $this->SetTextColor(255, 255, 255);
        $this->SetDrawColor(163, 163, 163);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(30, 10, utf8_decode('Descripción'), 1, 0, 'C', 1);
        $this->Cell(30, 10, utf8_decode('Cantidad'), 1, 0, 'C', 1);
        $this->Cell(30, 10, utf8_decode('Precio Unitario'), 1, 0, 'C', 1);
        $this->Cell(30, 10, utf8_decode('Total'), 1, 1, 'C', 1);
    }

    // Pie de página
    function Footer()
    {
        $this->SetY(-28);
        $this->Image('qr.png', 10, $this->GetY(), 20);
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C');
        $this->SetY(-15);
        $this->Cell(0, 10, utf8_decode("Fecha de emisión: " . date('d/m/Y')), 0, 0, 'R');
    }
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->AliasNbPages();
$pdf->SetFont('Arial', '', 12);
$pdf->SetDrawColor(163, 163, 163);

// Añadir los detalles de la factura (ejemplo estático, modifícalo según tus necesidades)
$pdf->Cell(30, 10, utf8_decode("Producto X"), 1, 0, 'C');
$pdf->Cell(30, 10, '1', 1, 0, 'C');
$pdf->Cell(30, 10, '100.00', 1, 0, 'C');
$pdf->Cell(30, 10, '100.00', 1, 1, 'C');

// Detalles finales
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, utf8_decode("Total antes de impuesto: $" . $factura['total_ante_impuesto']), 0, 1);
$pdf->Cell(0, 10, utf8_decode("Total impuesto: $" . $factura['total_impuesto']), 0, 1);
$pdf->Cell(0, 10, utf8_decode("Total después de impuesto: $" . $factura['total_despues_impuesto']), 0, 1);
$pdf->Cell(0, 10, utf8_decode("Monto pagado: $" . $factura['monto_pagado']), 0, 1);

$pdf->Output('Factura.pdf', 'I');
