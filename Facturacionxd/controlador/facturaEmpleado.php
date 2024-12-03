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
            // echo "<pre>";
            // print_r($_POST);
            // echo "</pre>";
            // exit();

            // Verificar que todos los campos requeridos estén presentes
            if (isset($_POST['dni'], $_POST['tipoFactura'], $_POST['formaPago'], $_POST['codigoProducto'], $_POST['nombreProducto'], $_POST['cantidad'], $_POST['precio'], $_POST['total'], $_POST['subTotal'], $_POST['totalFinal'], $_POST['porcentajeImpuestos'], $_POST['montoImpuestos'])) {

                // Recoger los datos del formulario
                $dni = $_POST['dni'];
                $tipoFactura = $_POST['tipoFactura'];
                $formaPago = $_POST['formaPago'];
                $codigoProducto = $_POST['codigoProducto']; // Array
                $nombreProducto = $_POST['nombreProducto']; // Array
                $cantidad = $_POST['cantidad']; // Array
                $precio = $_POST['precio']; // Array
                $total = $_POST['total']; // Array
                $subTotal = $_POST['subTotal'];
                $totalFinal = $_POST['totalFinal'];
                $porcentajeImpuestos = $_POST['porcentajeImpuestos'];
                $montoImpuestos = $_POST['montoImpuestos'];

                // Validar que los arrays tengan la misma longitud
                if (count($codigoProducto) !== count($cantidad) || count($cantidad) !== count($precio) || count($precio) !== count($total)) {
                    echo "Error: los detalles de los productos no coinciden en cantidad.";
                    exit();
                }
                // Verificar que el cliente exista
                $idCliente = $modelo->obtenerIdCliente($dni);

                // Obtener el ID del cliente con el DNI proporcionado
                $idCliente = $modelo->obtenerIdCliente($dni);

                // Guardar la factura en la base de datos
                $idFactura = $modelo->guardarFactura($idCliente, $tipoFactura, $subTotal, $porcentajeImpuestos, $montoImpuestos, $totalFinal);

                // Guardar los detalles de la factura
                foreach ($codigoProducto as $i => $codigo) {
                    $nombre = $nombreProducto[$i];
                    $cantidadProducto = $cantidad[$i];
                    $precioProducto = $precio[$i];
                    $totalProducto = $total[$i];

                    // Guardar cada producto en la tabla de detalles de factura
                    $idProducto = $modelo->obtenerIdProducto($codigo);
                    if (!$idProducto) {
                        echo "Error: el producto con código $codigo no existe.";
                        continue;
                    }


                    // Guardar el detalle de la factura
                    $modelo->guardarDetalleFactura($idFactura, $idProducto, $cantidadProducto, $precioProducto, $totalProducto, $formaPago);
                }

                // echo "Factura guardada exitosamente.";
                header("Location: ../vista/empleado.php"); //?mensaje=Factura guardada exitosamente
            } else {
                echo "Faltan campos obligatorios.";
                exit();
            }
            break;
    }
}
