
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
                    $_POST["celu"],
                    $_POST["correo"],
                    $_POST["tipoCliente"]
                )
            ) {
                // Obtener los datos del POST
                $nombre = $_POST["nombre"];
                $apellido = $_POST["apellido"];
                $dni = $_POST["dni"];
                $domicilio = $_POST["domicilio"];
                $celular = $_POST["celu"];
                $correo = $_POST["correo"];
                $tipoCliente = $_POST["tipoCliente"];

                var_dump($nombre, $apellido, $dni, $domicilio, $celular, $correo, $tipoCliente);

                // Llamar al modelo para crear el cliente
                $clienteCreado = $modelo->crearCliente($nombre, $apellido, $dni, $domicilio, $celular, $correo, $tipoCliente);

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
            if (isset($_GET["id"])) {
                $id = $_GET["id"];
                $clienteB = $modelo->obtenerClientePorId($id);
                if ($clienteB) {
                    $cliente_serializado = serialize($clienteB);
                    header("Location: ../vista/editarCliente.php?datoCliente=$cliente_serializado");
                    exit();
                }
                // header("Location: ../vista/clientes.php");
                exit();
            }
            break;
        case "guardarEditado":
            if (isset($_POST["id"], $_POST["nombre"], $_POST["apellido"], $_POST["dni"], $_POST["domicilio"], $_POST["celular"], $_POST["correo"], $_POST["tipoCliente"])) {
                // Obtener los datos del POST
                $id = $_POST["id"];
                $nombre = $_POST["nombre"];
                $apellido = $_POST["apellido"];
                $dni = $_POST["dni"];
                $domicilio = $_POST["domicilio"];
                $celular = $_POST["celular"];
                $correo = $_POST["correo"];
                $tipoCliente = $_POST["tipoCliente"];

                // Llamar al modelo para actualizar el cliente
                $clienteEditado = $modelo->actualizarCliente($nombre, $apellido, $dni, $domicilio, $celular, $correo, $tipoCliente, $id);

                // Redirigir o mostrar un mensaje según el resultado
                if ($clienteEditado) {
                    header("Location: ../vista/clientes.php");
                    exit();
                } else {
                    echo "Error al editar el cliente.";
                }
            } else {
                echo "Faltan parámetros para editar el cliente.";
            }
            break;

        case "eliminar":
            //  echo "<pre>";
            // print_r($_POST);
            // echo "</pre>";
            // exit();
            if (isset($_GET["id"])) {
                $id = $_GET["id"];
                $eliminado = $modelo->eliminar_cliente($id);
                if ($eliminado) {
                    header("Location: ../vista/clientes.php");
                }
                // header("Location: ../vista/clientes.php");
                exit();
            }
            break;
        case "crearUsuario":
            // echo "<pre>";
            // print_r($_POST);
            // echo "</pre>";
            
            if (
                isset(
                    $_POST["nombre"],
                    $_POST["usuario"],
                    $_POST["correo"],
                    $_POST["contrasena"],
                    $_POST["rol"]
                )
            ) {
                // Obtener los datos del POST
                $nombre = $_POST["nombre"];
                $usuario = $_POST["usuario"];
                $correo = $_POST["correo"];
                $contra = $_POST["contrasena"];
                $rol = $_POST["rol"];
                // Llamar al modelo para crear el cliente
                $usucreado = $modelo->crearUsu($nombre, $usuario, $correo, $contra, $rol);

                // Redirigir o mostrar un mensaje según el resultado
                if ($usucreado) {
                    header("Location: ../vista/ajustes.php");
                    exit();
                } else {
                    echo "Error al crear el cliente.";
                }
            } else {
                echo "Faltan parámetros para crear el cliente.";
            }
            break;
            case "eliminarUsuario":
                //  echo "<pre>";
                // print_r($_POST);
                // echo "</pre>";
                // exit();
                if (isset($_GET["id"])) {
                    $id = $_GET["id"];
                    $eliminado = $modelo->eliminar_usuario($id);
                    if ($eliminado) {
                        header("Location: ../vista/ajustes.php");
                    }
                    // header("Location: ../vista/clientes.php");
                    exit();
                }
                break;
        default:
            echo "Acción no válida.";
    }


        switch ($accion) {
            case "crearProducto":
                // echo "<pre>";
                // print_r($_POST);
                // echo "</pre>";
                // exit();
                // Validar que todos los campos requeridos estén presentes
                if (
                    isset(
                        $_POST["codigo_producto"],
                        $_POST["descripcion_producto"],
                        $_POST["precio_producto"],
                        $_POST["nombre_categoria"]
                    )
                ) {
                    // Obtener los datos del POST
                    $codigo = $_POST["codigo_producto"];
                    $descriocion = $_POST["descripcion_producto"];
                    $precio = $_POST["precio_producto"];
                    $categoria = $_POST["nombre_categoria"];
    
                    var_dump($codigo, $descripcion, $precio, $categoria);
    
                    // Llamar al modelo para crear el cliente
                    $productoCreado = $modelo->crearProducto($codigo, $descripcion, $precio, $categoria);
    
                    // Redirigir o mostrar un mensaje según el resultado
                    if ($productoCreado) {
                        header("Location: ../vista/productos.php"); //?status=success
                        exit();
                    } else {
                        echo "Error al crear el producto.";
                    }
                } else {
                    echo "Faltan parámetros para crear el producto.";
                }
                break;
}

}
?>



