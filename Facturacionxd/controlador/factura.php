<?php
include_once("../modelo/conexion.php");

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener datos del formulario
$nombre = $_POST['nombre'];
$cuil = $_POST['cuil'];
$domicilio = $_POST['domicilio'];
$tipo_factura = $_POST['tipoFactura'];
$forma_pago = $_POST['formaPago'];
$subTotal = $_POST['subTotal'];
$taxRate = $_POST['taxRate'];
$taxAmount = $_POST['taxAmount'];
$totalAftertax = $_POST['totalAftertax'];
$amountPaid = $_POST['amountPaid'];
$amountDue = $_POST['amountDue'];
$notes = $_POST['notes'];
$userId = $_POST['userId'];

// Insertar datos en la tabla facturas
$sql_factura = "INSERT INTO facturas (nombre_cliente, cuil_cuit, domicilio, tipo_factura, forma_pago, subtotal, porcentaje_impuestos, monto_impuestos, total, monto_pagado, cambio, observaciones, user_id)
VALUES ('$nombre', '$cuil', '$domicilio', '$tipo_factura', '$forma_pago', '$subTotal', '$taxRate', '$taxAmount', '$totalAftertax', '$amountPaid', '$amountDue', '$notes', '$userId')";

if ($conn->query($sql_factura) === TRUE) {
    $factura_id = $conn->insert_id; // Obtener el ID de la factura insertada
    
    // Insertar detalles de la factura
    $productCodes = $_POST['productCode'];
    $productNames = $_POST['productName'];
    $quantities = $_POST['quantity'];
    $prices = $_POST['price'];
    $totals = $_POST['total'];
    
    for ($i = 0; $i < count($productCodes); $i++) {
        $productCode = $productCodes[$i];
        $productName = $productNames[$i];
        $quantity = $quantities[$i];
        $price = $prices[$i];
        $total = $totals[$i];
        
        $sql_detalle = "INSERT INTO detalle_facturas (factura_id, no_item, nombre_item, cantidad, precio, total)
                        VALUES ('$factura_id', '$productCode', '$productName', '$quantity', '$price', '$total')";
        $conn->query($sql_detalle);
    }
    
    echo "Factura guardada exitosamente.";
} else {
    echo "Error: " . $sql_factura . "<br>" . $conn->error;
}

$conn->close();
?>
