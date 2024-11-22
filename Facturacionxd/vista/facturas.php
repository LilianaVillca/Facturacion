<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Encanto Natural</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="styles.css">
</head>

<body>

  <?php
  include_once("../modelo/conexion.php");
  $modelo = new Conexion();
  $facturas = $modelo->obtener_facturas();
  ?>
  <?php if (isset($_GET['mensaje'])): ?>
    <script>
      alert("<?= htmlspecialchars($_GET['mensaje']) ?>");
    </script>
  <?php endif; ?>


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
          <a class="nav-link text-dark" href="clientes.php"><i class="fas fa-user me-2"></i> Clientes</a>
        </li>
        <li class="nav-item mb-2">
          <a class="nav-link text-dark" href="articulos.php"><i class="fas fa-box me-2"></i> Articulos</a>
        </li>
        <li class="nav-item mb-2">
          <a class="nav-link text-dark active" href="facturas.php"><i class="fas fa-file-invoice me-2"></i> Facturas</a>
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

      <!-- Main Content -->
      <div class="content p-4">
        <div class="d-flex justify-content-between mb-3">
          <h3>Lista de comprobante</h3>
          <a href="crearFactura.php" class="fbtn custom-btn btn-center">+ crear</a>
        </div>

        <table class="table table-bordered grocery-crud-table table-hover">
          <thead>
            <tr>
              <th>N° de comprobante</th>
              <th>Tipo comprobante</th>
              <th>Fecha creación</th>
              <th>Hora creación</th>
              <th>Cliente</th>
              <th>Facturado</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($facturas as $factura) : ?>
              <tr>
                <td><?php echo $factura["id_factura"]; ?></td>
                <td><?php echo $factura["tipoFactura"]; ?></td>
                <td><?php echo $factura["fecha"]; ?></td>
                <td><?php echo $factura["hora"]; ?></td>
                <td><?php echo $factura["nombre_cliente"]; ?></td>
                <td>$<?php echo $factura["total"]; ?></td>
                <td>
                  <a href="../controlador/notaCredito.php?accion=anular&id=<?php echo $factura['id_factura']; ?>" class="btn btn-danger btn-sm me-2">
                    <i class="fas fa-ban"></i>
                  </a>
                  <a href="../controlador/factura.php?accion=imprimir&id=<?php echo $factura['id_factura']; ?>" class="btn btn-primary btn-sm">
                    <i class="fas fa-print"></i>
                  </a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>


  </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>