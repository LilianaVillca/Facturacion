
<?php
include_once("../modelo/conexion.php");

$modelo = new Conexion();

if (isset($_GET["accion"])) {
    $accion = $_GET["accion"];

    switch ($accion) {
        case "crear":
            // echo "<pre>";
            // print_r($_POST);
            // echo "</pre>";
            // exit();
            // Validar que todos los campos requeridos estén presentes
            if (
                isset(
                    $_POST["nombre"],
                    $_POST["apellido"],
                    $_POST["dni"],
                    $_POST["domicilio"],
                    $_POST["correo"],
                    $_POST["tipoCliente"]
                )
            ) {
                // Obtener los datos del POST
                $nombre = $_POST["nombre"];
                $apellido = $_POST["apellido"];
                $dni = $_POST["dni"];
                $domicilio = $_POST["domicilio"];
                $correo = $_POST["correo"];
                $tipoCliente = $_POST["tipoCliente"];

                // Llamar al modelo para crear el cliente
                $clienteCreado = $modelo->crearCliente($nombre, $apellido, $dni, $domicilio, $correo, $tipoCliente);

                // Redirigir o mostrar un mensaje según el resultado
                if ($clienteCreado) {
                    header("Location: ../vista/clientes.php"); //?status=success
                    exit();
                } else {
                    echo "Error al crear el cliente.";
                }
            } else {
                echo "Faltan parámetros para crear el cliente.";
            }
            break;
        case "editar":
            if (
                isset(
                    $_POST["nombre"],
                    $_POST["apellido"],
                    $_POST["dni"],
                    $_POST["domicilio"],
                    $_POST["correo"],
                    $_POST["tipoCliente"]
                )
            ) {
                // Obtener los datos del POST
                $nombre = $_POST["nombre"];
                $apellido = $_POST["apellido"];
                $dni = $_POST["dni"];
                $domicilio = $_POST["domicilio"];
                $correo = $_POST["correo"];
                $tipoCliente = $_POST["tipoCliente"];

                // Llamar al modelo para crear el cliente
                $clienteEditado = $modelo->editarCliente($nombre, $apellido, $dni, $domicilio, $correo, $tipoCliente);

                // Redirigir o mostrar un mensaje según el resultado
                if ($clienteEditado) {
                    header("Location: ../vista/cliente.php"); //?status=success
                    exit();
                } else {
                    echo "Error al crear el cliente.";
                }
            } else {
                echo "Faltan parámetros para crear el cliente.";
            }
            
            break;

            case "eliminar":
                /// Lógica para elimar
            if (isset($_GET["id"])) {
                $id = $_GET["id"];
                $modelo->eliminar_cliente($id);
                // Redireccionar a la página de gestión de carreras
                header("Location: ../vista/cliente.php");
                exit();
            }
            break;
        default:
            echo "Acción no válida.";
    }
}


?>



