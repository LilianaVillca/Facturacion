<?php
include_once '../modelo/conexion.php';

$modelo = new conexion();
$cliente = $modelo->obtenerClientePorDni($_POST['dni']);

if ($cliente !== null) {
    echo json_encode($cliente);
} else {
    echo json_encode(['error' => 'Cliente no encontrado']);
} 

?>
