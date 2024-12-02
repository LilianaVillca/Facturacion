<?php
include_once("../modelo/conexion.php");
$modelo = new Conexion();


if (isset($_GET['accion'])) {
    $accion = $_GET['accion'];

    switch ($accion) {
        case 'crear':
            if (isset($_POST['codigo'], $_POST['nombre'], $_POST['descripcion'], $_POST['precio'])) {
                $codigo = $_POST['codigo'];
                $nombre = $_POST['nombre'];
                $descripcion = $_POST['descripcion'];
                $precio = $_POST['precio'];

                if ($modelo->crearProducto($codigo, $nombre, $descripcion, $precio)) {
                    header("Location: ../vista/articulos.php");
                } else {
                    echo "Error al crear el artículo.";
                }
            }
            break;

            case 'editar':
                if (isset($_POST['id_producto'])) {
                    $id = $_POST['id_producto'];
                    $producto2=$modelo->editarProducto($id);
    
                    if ($producto2) {
                        header("Location: ../vista/articulos2.php");
                    } else {
                        echo "Error al editar el artículo.";
                    }
                }
                break;
    

        case 'editar2':
            if (isset($_POST['id_producto'], $_POST['codigo'], $_POST['nombre'], $_POST['descripcion'], $_POST['precio'])) {
                $id = $_POST['id_producto'];
                $codigo = $_POST['codigo'];
                $nombre = $_POST['nombre'];
                $descripcion = $_POST['descripcion'];
                $precio = $_POST['precio'];

                if ($modelo->editarProducto($id, $codigo, $nombre, $descripcion, $precio)) {
                    header("Location: ../vista/articulos2.php");
                } else {
                    echo "Error al editar el artículo.";
                }
            }
            break;

        case 'eliminar':
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                if ($modelo->eliminarProducto($id)) {
                    header("Location: ../vista/articulos.php");
                } else {
                    echo "Error al eliminar el artículo.";
                }
            }
            break;

        default:
            echo "Acción no válida.";
    }
}
