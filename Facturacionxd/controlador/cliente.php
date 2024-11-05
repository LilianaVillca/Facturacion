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

<?php
// require_once("../modelo/conexion.php");

// class ClienteController {
//     private $modelo;

//     public function __construct() {
//         $this->modelo = new Conexion();
//     }

//     public function buscarClientePorId() {
//         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//             // Obtener el ID del cliente desde el formulario
//             $idCliente = $_POST['idCliente'];

//             // Llamar a la función del modelo para buscar el cliente por su ID
//             $cliente = $this->modelo->obtenerClientePorId($idCliente);

//             // Verificar si se encontró el cliente
//             if ($cliente) {
//                 // Pasar el array de datos del cliente a la vista
//                 $this->mostrarVistaCliente($cliente);
//             } else {
//                 echo "Cliente no encontrado.";
//             }
//         }
//     }

//     private function mostrarVistaCliente($cliente) {
//         // Incluir la vista y pasarle los datos del cliente
//         include '../vista/craerFacturas.php';
//     }

    
// }

// // Instanciar el controlador y llamar al método para buscar el cliente
// $controller = new ClienteController();
// $controller->buscarClientePorId();







///////////////////////////////////////////////////// crear factura ///////////////////////////////////////////////////////////////////////////

?>

