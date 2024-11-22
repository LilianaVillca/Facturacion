<?php
include_once '../modelo/conexion.php';

$modelo = new conexion();

if (isset($_POST['numeroProducto'])) {
    $producto = $modelo->obtenerProductoPorId($_POST['numeroProducto']);

    if ($producto) {
        echo json_encode([
            'nombre' => $producto['descripcion_producto'], // Asegúrate de usar el campo correcto
            'precio' => $producto['precio_producto']       // Asegúrate de usar el campo correcto
        ]);
    } else {
        echo json_encode(['error' => 'Producto no encontrado']);
    }
} else {
    echo json_encode(['error' => 'Número de producto no proporcionado']);
}
?>