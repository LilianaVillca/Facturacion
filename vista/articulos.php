<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Encanto Natural</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- FontAwesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="styles.css">
</head>

<body>

  <?php
  include_once("../modelo/conexion.php");
  $modelo = new conexion();
  $productos = $modelo->obtener_productos();
  ?>

  <div class="d-flex">
    <!-- Sidebar -->
    <div id="sidebar" class="bg-light p-3">
    <div class="text-center mb-4">
        <img src="img/user1.png" class="rounded-circle" alt="Avatar">
        <p class="mt-2">Administrador <br><?php session_start();
                                          echo htmlspecialchars($_SESSION["nombre_usuario"]) ?> </p>
      </div>
      <hr>
      <ul class="nav flex-column">
        <li class="nav-item mb-2">
          <a class="nav-link text-dark" href="admin.php"><i class="fas fa-th-large me-2"></i> Inicio</a>
        </li>
        <li class="nav-item mb-2">
          <a class="nav-link text-dark" href="clientes.php"><i class="fas fa-user me-2"></i> Clientes</a>
        </li>
        <li class="nav-item mb-2">
          <a class="nav-link text-dark active" href="articulos.php"><i class="fas fa-box me-2"></i> Articulos</a>
        </li>
        <li class="nav-item mb-2">
          <a class="nav-link text-dark" href="facturas.php"><i class="fas fa-file-invoice me-2"></i> Facturas</a>
        </li>
        <li class="nav-item mb-2">
          <a class="nav-link text-dark" href="ajustes.php"><i class="fas fa-cog me-2"></i> Ajustes</a>
        </li>
      </ul>
      <hr>
      <div class="mt-auto">
        <a class="nav-link text-dark" href="../controlador/cerrarSession.php"><i class="fas fa-sign-out-alt me-2"></i> Cerrar sesión</a>
      </div>
    </div>

    <div class="w-100">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-light text-white">
        <div class="container-fluid">
          <span class="navbar-brand text-white">Encanto Natural</span>
        </div>
      </nav>

      <div class="content p-4">

        <div class="title-box">
          <h1>Gestión de Articulos</h1>
        </div>
        <a class="btn custom-btn btn-center mb-3 ms-3" onclick="abrirRecuadroo()"><b>+</b> Añadir producto </a>


        <div class="card custom-card ms-3">
          <div class="card-body">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col"> </th>
                  <th scope="col">Codigo del artículo</th>
                  <th scope="col">Descripción</th>
                  <th scope="col">Precio</th>
                  <th scope="col">Categoría</th>
                  <th scope="col"> </th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($productos as $producto) {
                  // echo "<tr onclick=\"window.location.href='facturas.php'\">";
                  //  echo "<th scope='row'><i class='fas fa-edit me-2'></i></th>";
                   echo "<th><a scope='row' href='../controlador/productoA.php?accion=editar&id=" . $producto["id_producto"] . "'><i class='fas fa-edit me-2'></i></a></th>";

                  // echo "<a href='../controlador/accionesCliente.php?accion=editar&id=" . $cliente["id_cliente"] . "' class='fas fa-edit me-2'>Editar</a>";
                  echo "<td>" . $producto["codigo_producto"] . "</td>";
                  echo "<td>" . $producto["descripcion_producto"] . "</td>";
                  echo "<td>$" . $producto["precio_producto"] . "</td>";
                  echo "<td>" . $producto["nombre_categoria"] . "</td>";
                  // echo "<a href='../controlador/accionesCliente.php?accion=eliminar&id=" . $cliente["id_cliente"] . "' class='fas fa-trash me-2'>Eliminar</a>";
                  echo "<th><a scope='row' href='../controlador/productoA.php?accion=eliminar&id=" . $producto["id_producto"] . "'><i class='fas fa-trash me-2'></i></a></th>";
                   
                  // echo "<th scope='row'><i class='fas fa-trash me-2'></i></th>";
                  echo "</tr>";
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
        <!-- FORMULARIO PARA CREAR CLIENTE-->
        <div id="recuadro" style="display: none; background: #f9f9f9; width: 400px; border: 1px solid #ccc; padding: 20px;">
          <h2>Crear Producto</h2>
          <form method="POST" class="form" action="../controlador/accionesCliente.php?accion=crearProducto">
            <!-- Agrega un contenedor para los mensajes de error -->
            <div class="form-group">
              <label for="codigo" class="form-label">Código del producto:</label>
              <input type="number" id="codigo_producto" name="codigo" class="form-control border-label" required>
            </div>
            <div class="form-group">
              <label for="descripcion" class="form-label">Descripción:</label>
              <input type="text" id="descripcion_producto" name="descripcion" class="form-control border-label" required>
            </div>
            <div class="form-group">
              <label for="precio" class="form-label">Precio:</label>
              <input type="number" id="precio_producto" name="precio" class="form-control border-label" required>
            </div>
            <div class="form-group">
              <label for="categoria" class="form-label">Categoría:</label>
              <input type="text" id="nombre_categoria" name="categoria" class="form-control border-label" required>
            </div>
            <!-- <button type="submit" class="btn btn-primary" name="insertar">Crear Alumno</button> -->
            <button type="submit" class="btn custom-btn">Crear Producto</button>
            <button type="button" class="btn custom-btn" onclick="cerrarRecuadro()">Cancelar</button>

          </form>
      </div>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>