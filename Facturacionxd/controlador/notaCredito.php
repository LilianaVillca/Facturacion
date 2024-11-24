<?php
include_once("../modelo/conexion.php");

$modelo = new Conexion();

if (isset($_GET["accion"])) {
    $accion = $_GET["accion"];

    switch ($accion) {
        case "anular":
            if (isset($_GET["id"])) {
                $id_factura = $_GET["id"];
                $factura = $modelo->obtener_factura($id_factura);
                $detalleFactura = $modelo->obtener_detalle_factura($id_factura);
                if ($factura) {
                    $factura_serializado = serialize($factura);
                    $detalleFactura_serializado = serialize($detalleFactura);
                    header("Location: ../vista/crearNotaCredito.php?factura=$factura_serializado&detalleFactura=$detalleFactura_serializado");
                    exit();
                } else {
                    echo "Factura no encontrada";
                }
            } else {
                echo "Faltan parámetros";
            }
            break;
        case "guardaranulacion":
            // echo "<pre>";
            // print_r($_POST);
            // echo "</pre>";
            // exit();
            $cliente = $_POST['id_cliente'];
            $idFactura = $_POST['nFactura'];
            $tipoFactura = $_POST['tipoFactura'];
            $formaPago = $_POST['formaPago'];
            $motivo = $_POST['motivo'];
            $idProductoArray = $_POST['id_producto'];
            $descripcionArray = $_POST['descripcion_producto'];
            $cantidadArray = $_POST['cantidad_producto'];
            $precioArray = $_POST['precio_producto'];
            $totalArray = $_POST['total_producto'];
            $subTotal = $_POST['subTotal'];
            $totalFinal = $_POST['totalFinal'];
            $porcentajeImpuestos = $_POST['porcentajeImpuestos'];
            $montoImpuestos = $_POST['montoImpuestos'];

            $idNotaCredito = $modelo->guardarNotaCredito($cliente, $motivo, $subTotal, $porcentajeImpuestos, $montoImpuestos, $totalFinal, $idFactura, $tipoFactura);

            foreach ($idProductoArray as $index => $idProducto) {
                $descripcion = $descripcionArray[$index];
                $cantidad = $cantidadArray[$index];
                $precio = $precioArray[$index];
                $total = $totalArray[$index];

                $modelo->guardarDetalleNotaCredito($idNotaCredito, $idProducto, $descripcion, $cantidad, $precio, $total, $formaPago );
            }

            header("Location: ../vista/facturas.php"); // ahora lo que tendria que hacer es enviar mensajes si es que quiero xd
            break;
    }
}
