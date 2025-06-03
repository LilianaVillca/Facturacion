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

    <!-- Content Section -->
    <div class="w-100">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-light text-white">
        <div class="container-fluid">
          <span class="navbar-brand text-white">Encanto Natural</span>
        </div>
      </nav>

      <div class="content p-4">
        <form method="POST" action="../controlador/factura.php?accion=guardar" id="formuFactura">
          <div class="row justify-content-md-center">
            <div class="col-md-8 mb-3">
              <div class="card h-80 custom-card" style="width: 100%;">
                  <div class="card-body">
                      <h6 class="card-title text-center">Ingrese Cliente</h6><br>
                      
                        <div class="d-flex align-items-center gap-2">
                          <!-- Campo de entrada para el DNI -->
                          <input type="text" id="dni" name="dni" class="form-control border-label" placeholder="Escribir DNI" required>
                          <!-- Botón para buscar cliente -->
                           <button id="buscarClienteBtn" class="btn custom-btn">Buscar Cliente</button>
                           <!-- Enlace para crear cliente -->
                            <a href="#" class="btn custom-btn" onclick="abrirRecuadro()">Crear Cliente</a>
                        </div>
                        <!-- Contenedor para mostrar la información del cliente -->
                         <br>
                        <div id="clienteInfo" style="display: none; margin-top: 15px;">
                          <p><strong>Nombre:</strong> <span id="nombreCliente" name="nombreCliente"></span></p>
                          <p><strong>Apellido:</strong> <span id="apellidoCliente" name="apellidoCliente"></span></p>
                          <p><strong>Dirección:</strong> <span id="direcionCliente" name="direcionCliente"></span></p>
                          <p><strong>Teléfono:</strong> <span id="telefonoCliente" name="telefonoCliente"></span></p>
                        </div>                        
                        <br>
                  </div>
                 </div>
               </div>
             </div>
             <div class="col-md-12 mb-3">
             <div class="card h-100 custom-card" style="width: 100%;">
              <div class="card-body">
              <h6 class="card-title mb-4">Detalles de Comprobante</h6><br>
                <div class="row">
                 <div class="col-md-6 mb-3">
                    <div class="form-group">
                      <label for="tipoFactura">Tipo de Comprobante:</label>
                      <select class="form-control" id="tipoFactura" name="tipoFactura">
                        <option value="A">A</option>
                        <option value="B">B</option>
                      </select>
                    </div>
                 </div>
                 <div class="col-md-6 mb-3">
                    <div class="form-group">
                      <label for="formaPago">Forma de pago:</label>
                      <select class="form-control" id="formaPago" name="formaPago">
                        <option value="efectivo">Efectivo</option>
                        <option value="tarjeta">Tarjeta de crédito</option>
                        <option value="transferencia">Transferencia</option>
                      </select>
                    </div>
                  </div>
                 </div>
                 <hr>
                 <br>
                    <!-- Tabla con scroll horizontal -->
                    <div class="table-responsive mb-4">
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
                            <td><input class="fila" type="checkbox"></td>
                            <td><input type="number" name="codigoProducto[]" id="codigoProducto_1" class="form-control codigoProducto" autocomplete="off"></td>
                            <td><input type="text" name="nombreProducto[]" id="nombreProducto_1" class="form-control nombreProducto" autocomplete="off"></td>
                            <td><input type="number" name="cantidad[]" id="cantidad_1" class="form-control cantidad" autocomplete="off"></td>
                            <td><input type="number" name="precio[]" id="precio_1" class="form-control precio" autocomplete="off"></td>
                            <td><input type="number" name="total[]" id="total_1" class="form-control total" autocomplete="off"></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>

                    <!-- Botones para agregar/eliminar ítems -->
                    <div class="botones mb-4">
                      <button class="btn custom-btn" id="eliminarFila" type="button">- Eliminar</button>
                      <button class="btn custom-btn" id="addfila" type="button">+ Agregar</button>
                    </div>
                   <hr>
                    <!-- Resumen de la factura -->
                    <div class="row mb-4">
                      <div class="col-md-6 mb-3">
                        <label for="subtotal" class="form-label">Subtotal</label>
                        <input type="number" id="subTotal" name="subTotal" class="form-control" placeholder="$">
                      </div>
                      <div class="col-md-6 mb-3">
                        <label for="total" class="form-label">Total</label>
                        <input type="number" id="totalFinal" name="totalFinal" class="form-control" placeholder="$">
                      </div>

                      <div class="col-md-6 mb-3">
                        <label for="porcentajeImpuestos" class="form-label">Porcentaje Impuestos</label>
                        <input type="number" id="porcentajeImpuestos" name="porcentajeImpuestos" class="form-control" placeholder="%">
                      </div>

                      <div class="col-md-6 mb-3">
                        <label for="montoImpuestos" class="form-label">Monto Impuestos</label>
                        <input type="number" id="montoImpuestos" name="montoImpuestos" class="form-control" placeholder="$">
                      </div>
                    </div>
                        <!-- Campo de entrada para el DNI y botones de acciones -->
                        <!-- <input type="text" id="dni" name="dni" class="form-control border-label" required>
                        <button id="buscarClienteBtn" class="btn custom-btn btn-center">Buscar Cliente</button>
                        <a href="#" class="btn custom-btn btn-center" onclick="abrirRecuadro()">Crear Cliente</a> -->

                        <!-- Botón de Generar Factura (desactivado inicialmente) -->
                         <input type="submit" class="btn custom-btn" id="guardarFactura" value="Generar Factura" disabled>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
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
              <input type="text" id="celu" name="celu" class="form-control border-label" required>
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
    </div>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../factura.js"></script>
</body>

</html>