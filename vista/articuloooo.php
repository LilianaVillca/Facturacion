<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Artículos</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1>Gestión de Artículos</h1>
        <a href="crearArticulo.php" class="btn btn-primary mb-3">+ Añadir Artículo</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once("../controlador/productoA.php");

                include_once("../modelo/conexion.php");
                $modelo = new conexion();
                $articulos = $modelo->obtener_productos();

                foreach ($articulos as $articulo) {
                    echo "<tr>
                  <td>{$articulo['codigo']}</td>
                  <td>{$articulo['nombre']}</td>
                  <td>{$articulo['descripcion']}</td>
                  <td>\${$articulo['precio']}</td>
                  <td>
                    <a href='editarArticulo.php?id={$articulo['id']}' class='btn btn-warning btn-sm'>Editar</a>
                    <a href='../controlador/controladorArticulo.php?accion=eliminar&id={$articulo['id']}' class='btn btn-danger btn-sm'>Eliminar</a>
                  </td>
                </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>