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
    
    // Incluir el modelo correspondiente
    include_once("../modelo/conexion.php");

    $modelo = new Conexion();

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
        <a class="nav-link text-dark" href="#"><i class="fas fa-cog me-2"></i> Ajustes</a>
      </li>
    </ul>
    <hr>
    <div class="mt-auto">
      <a class="nav-link text-dark" href="#"><i class="fas fa-sign-out-alt me-2"></i> Cerrar sesión</a>
    </div>
  </div>


  <div class="content p-4">

    <div class="title-box">
        <h1>Gestión de Clientes</h1>
    </div>

    <a class="btn custom-btn btn-center" href="crearFactura.php"><b>+</b> Añadir cliente </a>

    <div class="card custom-card">
     <div class="card-body">
      <table class="table table-hover">
        <thead>
            <tr>
                <th>N° de Cliente</th>
                <th>Nombre del Cliente</th>
                <th>Apellido</th>
                <th>Cuil</th>
                <th>Domicilio</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($clientes as $cliente) {
                echo "<tr>";
                echo "<td>" . $cliente["id_cliente"] . "</td>";
                echo "<td>" . $cliente["nombre"] . "</td>";
                echo "<td>" . $cliente["apellido"] . "</td>";
                echo "<td>" . $cliente["cuil"] . "</td>";
                echo "<td>" . $cliente["domicilio"] . "</td>";
                echo "</tr>";
            }
            ?>

        </tbody>
    </table>
   </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>