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

    $facturas = $modelo->obtener_facturas();
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
        <h1>Gestión de Facturación</h1>
        <p class="lead">Genera facturas de manera rápida y sencilla con todos los detalles necesarios, incluyendo la información del cliente, los productos o servicios, y los impuestos aplicables..</p>
    </div>

    <a class="btn btn-success btn-nueva" href="crearFactura.php"><b>+</b> Crear Factura </a>
    <table class="table table-bordered grocery-crud-table table-hover">
        <thead>
            <tr>
                <th>N° de Factura</th>
                <th>Fecha Creación</th>
                <th>Nombre del Cliente</th>
                <th>Total Facturado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($facturas as $factura) {
                echo "<tr>";
                echo "<td>" . $factura["id_factura"] . "</td>";
                echo "<td>" . $factura["fecha"] . "</td>";
                echo "<td>Juan</td>";
                // debemos de extraer los datos del usuario para mostrolarlos por aca
                // pero lo hacemos luego
                echo "<td>" . $factura["total_despues_impuesto"] . "</td>";
                echo "<td>";
                echo "<a href='../controlador/factura.php?accion=imprimir&id=" . $factura["id_factura"] . "' class='editar'>Imprimir</a>";
                echo "<a href='../controlador/factura.php?accion=editar&id=" . $factura["id_factura"] . "' class='editar'>Editar</a>";
                echo "</td>";
                echo "</tr>";
            }
            ?>

        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>