<?php
include_once '../modelo/conexion.php';

$modelo = new conexion();
$cliente = $modelo->obtenerClientePorDni($_POST['dni']);
// $producto = $modelo->obtenerProductoPorId($_POST['numeroProducto']);

if ($cliente !== null) {
    echo json_encode($cliente);
} else {
    echo json_encode(['error' => 'Cliente no encontrado']);
} 
// elseif ($producto !== null) {
//     echo json_encode($producto);
// } else {
//     echo json_encode(['error' => 'Producto no encontrado']);
// }

?>

