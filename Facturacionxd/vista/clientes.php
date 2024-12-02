<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Clientes</title>
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
  $clientes = $modelo->obtener_clientes();
  ?>

  <div class="d-flex">
    <!-- Sidebar -->
    <div id="sidebar" class="bg-light p-3">
      <div class="text-center mb-4">
        <img src="img/user1.png" class="rounded-circle" alt="Avatar">
        <p class="mt-2">Administrador <br> Luis</p>
      </div>
      <hr>
      <ul class="nav flex-column">
        <li class="nav-item mb-2">
          <a class="nav-link text-dark" href="admin.php"><i class="fas fa-th-large me-2"></i> Inicio</a>
        </li>
        <li class="nav-item mb-2">
          <a class="nav-link text-dark active" href="clientes.php"><i class="fas fa-user me-2"></i> Clientes</a>
        </li>
        <li class="nav-item mb-2">
          <a class="nav-link text-dark" href="articulos.php"><i class="fas fa-box me-2"></i> Articulos</a>
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

      <div class="content p-4 ">


        <div class="title-box">
          <h1>Gestión de Clientes</h1>
        </div>
        <a class="btn custom-btn btn-center mb-3 ms-3" onclick="abrirRecuadro()"><b>+</b> Añadir cliente </a>

        <!-- tabla clientes -->

        <div class="card custom-card ms-3">
          <div class="card-body">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col"> </th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Apellido</th>
                  <th scope="col">CUIT</th>
                  <th scope="col">Domicilio</th>
                  <th scope="col">Celular</th>
                  <th scope="col">Correo</th>
                  <th scope="col">Tipo Cliente</th>
                  <th scope="col"> </th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($clientes as $cliente) {
                  echo "<tr >";
                  // echo "<tr onclick=\"window.location.href='facturas.php'\">";
                  // echo "<th scope='row'><i class='fas fa-edit me-2'></i></th>";
                  echo "<th><a scope='row' href='../controlador/accionesCliente.php?accion=editar&id=" . $cliente["id_cliente"] . "'><i class='fas fa-edit me-2'></i></a></th>";
                  echo "<td>" . $cliente["nombre"] . "</td>";
                  echo "<td>" . $cliente["apellido"] . "</td>";
                  echo "<td>" . $cliente["dni"] . "</td>";
                  echo "<td>" . $cliente["domicilio"] . "</td>";
                  echo "<td>" . $cliente["celular"] . "</td>";
                  echo "<td>" . $cliente["correo"] . "</td>";
                  echo "<td>" . $cliente["tipo_cliente"] . "</td>";
                  // echo "<th scope='row'><i class='fas fa-trash me-2'></i></th>";
                  echo "<th><a scope='row' href='../controlador/accionesCliente.php?accion=eliminar&id=" . $cliente["id_cliente"] . "'><i class='fas fa-trash me-2'></i></a></th>";
                  echo "</tr>";
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
        <!-- FORMULARIO PARA CREAR CLIENTE-->
        <div class="recuadro" id="recuadro" class="card h-80 custom-card">
          <h2>Crear Nuevo Cliente</h2>
          <form method="POST" class="form" action="../controlador/accionesCliente.php?accion=crear">
            <!-- Agrega un contenedor para los mensajes de error -->
            <div class="form-group">
              <label for="nombre" class="form-label">Nombre/s:</label>
              <input type="text" id="nombre" name="nombre" class="form-control border-label" required>
            </div>
            <div class="form-group">
              <label for="apellido" class="form-label">Apellido/s:</label>
              <input type="text" id="apellido" name="apellido" class="form-control border-label" required>
            </div>
            <div class="form-group">
              <label for="dni" class="form-label">DNI:</label>
              <input type="number" id="dni" name="dni" class="form-control border-label" required>
            </div>
            <div class="form-group">
              <label for="domicilio" class="form-label">Domicilio:</label>
              <input type="text" id="domicilio" name="domicilio" class="form-control border-label" required>
            </div>
            <div class="form-group">
              <label for="celu" class="form-label">Numero de telefono:</label>
              <input type="text" id="celular" name="celular" class="form-control border-label" required>
            </div>
            <div class="form-group">
              <label for="correo" class="form-label">Correo electronico:</label>
              <input type="text" id="correo" name="correo" class="form-control border-label" required>
            </div>
            <div class="form-group">
              <label for="tipoCliente">Tipo Cliente:</label>
              <select class="form-control" id="tipoCliente" name="tipoCliente">
                <option value="responsable inscripto">Responsable Inscripto</option>
                <option value="consumidor final">Consumidor Final</option>
              </select>
            </div>
            <!-- <button type="submit" class="btn btn-primary" name="insertar">Crear Alumno</button> -->
            <button type="submit" class="btn custom-btn">Crear Cliente</button>
            <button type="button" class="btn custom-btn" onclick="cerrarRecuadro()">Cancelar</button>

          </form>
        </div>


      </div>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
      <script src="../factura.js"></script>

</body>

</html>