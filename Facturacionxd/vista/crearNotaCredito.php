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
  <!-- Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>
<?php
if (isset($_GET["factura"],$_GET['detalleFactura'])) {
  $factura_serializado = $_GET["factura"];
  $factura = unserialize($factura_serializado);
  $detalleFactura_serializado = $_GET["detalleFactura"];
  $detalles = unserialize($detalleFactura_serializado);
} else {
  echo "Error: No se recibieron datos del usuario.";
}
?>

<body>

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
          <a class="nav-link text-dark active" href="admin.php"><i class="fas fa-th-large me-2"></i> Inicio</a>
        </li>
        <li class="nav-item mb-2">
          <a class="nav-link text-dark" href="clientes.php"><i class="fas fa-user me-2"></i> Clientes</a>
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

    <!-- Content Section -->
    <div class="w-100">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-light text-white">
        <div class="container-fluid">
          <span class="navbar-brand text-white">Encanto Natural</span>
        </div>
      </nav>

      <div class="content p-4">
        <form method="POST" action="../controlador/notaCredito.php?accion=guardaranulacion" id="formuNotaCredito">
          <div class="row justify-content-md-center">
            <div class="col-md-8 mb-3">
              <div class="card h-80 custom-card" style="width: 100%;">
                <div class="card-body">
                  <h6 class="card-title">Numero de Comprobante</h6><br>
                  <div class="text-center">
                    <input type="text" name="nFactura" class="form-control" value="<?php echo $factura['id_factura']; ?>" readonly>
                  </div>
                </div>
                <div class="card-body">
                  <h6 class="card-title">cliente</h6><br>
                  <div class="text-center">
                    <input type="text" name="cliente" class="form-control" value="<?php echo $factura['nombre_cliente']; ?>" readonly>
                    <input type="hidden" name="id_cliente" value="<?php echo $factura['id_cliente']; ?>">
                  </div>
                </div>
                <div class="card h-100 custom-card" style="width: 100%;">
                  <div class="card-body">
                    <h6 class="card-title">Detalles de Comprobante</h6><br>
                    <div class="form-group">
                      <label for="tipoFactura">Tipo de Comprobante:</label>
                      <input type="text" name="tipoFactura" class="form-control" value="<?php echo $factura['tipoFactura']; ?>" readonly>
                    </div>
                    <div class="form-group">
                      <label for="formaPago">Forma de pago:</label>
                      <input type="text" name="formaPago" class="form-control" value="<?php echo $detalles['forma_pago']; ?>" readonly>
                    </div>
                    <!-- Tabla con scroll horizontal -->
                    <div class="table-responsive">
                      <table class="table table-bordered" id="tablaFacturas">
                        <thead>
                          <tr>
                            <th width="2%"></th>
                            <th width="15%">N° Ítem</th>
                            <th width="38%">Nombre Ítem</th>
                            <th width="15%">Cantidad</th>
                            <th width="15%">Precio</th>
                            <th width="15%">Total</th>
                          </tr>
                        </thead>
                        <tbody id="tbodyFacturas">
                            <tr>
                              <td></td>
                              <td><span><?php echo $detalles['id_producto']; ?></span> <input type="hidden" name="id_producto[]" value="<?php echo $detalles['id_producto']; ?>"></td>
                              <td><span><?php echo $detalles['descripcion_producto']; ?></span><input type="hidden" name="descripcion_producto[]" value="<?php echo $detalles['descripcion_producto']; ?>"></td>
                              <td><span><?php echo $detalles['cantidad_producto']; ?></span><input type="hidden" name="cantidad_producto[]" value="<?php echo $detalles['cantidad_producto']; ?>"></td>
                              <td><span><?php echo $detalles['precio_producto']; ?></span><input type="hidden" name="precio_producto[]" value="<?php echo $detalles['precio_producto']; ?>"></td>
                              <td><span><?php echo $detalles['total_producto']; ?></span><input type="hidden" name="total_producto[]" value="<?php echo $detalles['total_producto']; ?>"></td>
                            </tr>
                        </tbody>
                      </table>

                    </div>
                    <!-- Resumen de la factura -->
                    <div class="row">
                      <div class="col-md-6 mb-3">
                        <label for="subtotal" class="form-label">Subtotal</label>
                        <input   id="subTotal" name="subTotal" value="<?php echo $factura['subtotal']; ?>" class="form-control" placeholder="$">
                      </div>
                      <div class="col-md-6 mb-3">
                        <label for="total" class="form-label">Total</label>
                        <input  id="totalFinal" name="totalFinal" value="<?php echo $factura['total']; ?>" class="form-control" placeholder="$">
                      </div>

                      <div class="col-md-6 mb-3">
                        <label for="porcentajeImpuestos" class="form-label">Porcentaje Impuestos</label>
                        <input id="porcentajeImpuestos" name="porcentajeImpuestos"value="<?php echo $factura['porcentajeImpuesto']; ?>" class="form-control" placeholder="%">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 mb-3">
                        <label for="montoImpuestos" class="form-label">Monto Impuestos</label>
                        <input  id="montoImpuestos" name="montoImpuestos" value="<?php echo $factura['montoImpuesto']; ?>" class="form-control" placeholder="$">
                      </div>
                    </div>
                    <label for="motivo">Motivo de la Nota de Crédito:</label>
                    <textarea id="motivo" name="motivo" required></textarea>

                    <input type="submit" class="btn custom-btn" id="anular" value="Crear Nota de Crédito">
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>


  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>