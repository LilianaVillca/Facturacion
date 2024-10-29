<?php
include_once("../modelo/conexion.php");

$modelo = new Conexion();

if (isset($_GET["accion"])) {
    $accion = $_GET["accion"];

    switch ($accion) {
        case "imprimir":
            if (isset($_GET["id"])) {
                $id_factura = $_GET["id"];
                $factura = $modelo->obtener_factura($id_factura);
                if ($factura) {
                    $factura_serializado = serialize($factura);
                    header("Location: ../vista/fpdf/generarFactura.php?datoFactura=$factura_serializado");
                    exit();
                } else {
                    echo "Factura no encontrada";
                }
            } else {
                echo "Faltan parámetros";
            }
            break;
        case "guardar":
            if (isset($_POST['nombreCliente'], $_POST['direcionCliente'], $_POST['telefonoCliente'], $_POST['tipoFactura'], $_POST['formaPago'], $POST['codigoProducto'][$i], $POST['nombreProducto'][$i], $POST['cantidad'][$i], $POST['precio'][$i], $POST['total'][$i], $_POST['subTotal'], $_POST['totalFinal'], $_POST['porcentajeImpuestos'], $_POST['montoPagado'], $_POST['montoImpuestos'], $_POST['cambio'], $_POST['observacion'])) {
                $nombreCliente = $_POST['nombreCliente'];
                $direccionCliente = $_POST['direcionCliente'];
                $telefonoCliente = $_POST['telefonoCliente'];
                $tipoFactura = $_POST['tipoFactura'];
                $formaPago = $_POST['formaPago'];
                $codigoProducto = $_POST['codigoProducto'];
                $nombreProducto = $_POST['nombreProducto'];
                $cantidad = $_POST['cantidad'];
                $precio = $_POST['precio'];
                $total = $_POST['total'];
                $subTotal = $_POST['subTotal'];
                $totalFinal = $_POST['totalFinal'];
                $porcentajeImpuestos = $_POST['porcentajeImpuestos'];
                $montoPagado = $_POST['montoPagado'];
                $montoImpuestos = $_POST['montoImpuestos'];
                $cambio = $_POST['cambio'];
                $observacion = $_POST['observacion'];

                // Obtener el ID del cliente por nombre o CUIL/CUIT
                $idCliente = $modelo->obtenerIdCliente($nombreCliente);

                // Guardar la factura y obtener el ID de la factura recién creada
                $idFactura = $modelo->guardarFactura($idCliente, $subTotal, $montoImpuestos, $porcentajeImpuestos, $totalFinal, $montoPagado, $cambio, $observacion);

                // Guardar los detalles de cada producto en detalle_factura
                foreach ($codigoProducto as $i => $codigo) {
                    $idProducto = $modelo->obtenerIdProducto($codigo);
                    $modelo->guardarDetalleFactura($idFactura, $idProducto, $cantidad[$i], $precio[$i], $total[$i], $formaPago);
                }

                // Redirigir o mostrar mensaje de éxito
                header("Location: ../vista/factura.php?mensaje=Factura creada con éxito");
            }
            break;
            // Otros casos...
    }
}
