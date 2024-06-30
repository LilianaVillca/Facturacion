
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

        // Otros casos...
    }
}
?>