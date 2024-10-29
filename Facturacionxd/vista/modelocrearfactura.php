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

  <style>
    /* ESTILOS PARA EL FORMULARIO */
    .recuadro {
      display: none;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background-color: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
      z-index: 9999;
    }

    .container {
      margin-top: 50px;
    }

    .form-group {
      margin-bottom: 20px;
    }
  </style>
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
          <a class="nav-link text-dark" href="#"><i class="fas fa-cog me-2"></i> Ajustes</a>
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
        <div class="row justify-content-md-center">
          <div class="col-md-3 mb-3">
            <div class="card h-80 custom-card" style="width: 100%;">
              <div class="card-body">
                <h6 class="card-title">cliente</h6><br>
                <!-- <div class="text-center">
                  <form method="POST">
                    <div class="form-group">
                      <label for="idCliente" class="form-label">ID del Cliente:</label> 
                      <button type="submit" class="btn btn-primary">Buscar Cliente</button>
                      <input type="text" id="dni" name="dni" class="form-control border-label" required>
                    </div>
                    <div id="clienteInfo" style="display: none; margin-top: 15px;">
                      <p><strong>Nombre:</strong> <span id="nombreCliente"></span></p>
                      <p><strong>direcion:</strong> <span id="direcionCliente"></span></p>
                      <p><strong>Teléfono:</strong> <span id="telefonoCliente"></span></p>
                    </div>
                     <button type="submit" class="btn custom-btn">Buscar Cliente</button> 
                  </form>
                  <a href="#" class="btn custom-btn" onclick="abrirRecuadro()">Crear Cliente</a>
                </div> -->
                <div class="text-center">
                  <!-- Campo de entrada para el DNI y botones de acciones -->
                  <input type="text" id="dni" name="dni" class="form-control border-label" required>
                  <button id="buscarClienteBtn" class="btn custom-btn btn-center">Buscar Cliente</button>
                  <a href="#" class="btn custom-btn btn-center" onclick="abrirRecuadro()">Crear Cliente</a>

                  <!-- Contenedor para mostrar la información del cliente -->
                  <div id="clienteInfo" style="display: none; margin-top: 15px;">
                    <p><strong>Nombre:</strong> <span id="nombreCliente"></span></p>
                    <p><strong>Dirección:</strong> <span id="direcionCliente"></span></p>
                    <p><strong>Teléfono:</strong> <span id="telefonoCliente"></span></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- FORMULARIO PARA CREAR CLIENTE-->
          <div class="recuadro" id="recuadro">
            <h2>Crear Nuevo Cliente</h2>
            <form method="post" class="form" action="../controlador/veremos.php?accion=crear&tipo=cliente">
              <!-- Agrega un contenedor para los mensajes de error -->
              <div class="form-group">
                <label for="nombre" class="form-label">Nombre del cliente:</label>
                <input type="text" id="nombre" name="nombre" class="form-control border-label" required>
              </div>
              <div class="form-group">
                <label for="cuit" class="form-label">CUIL/CUIT:</label>
                <input type="text" id="cuit" name="cuit" class="form-control border-label" required>
              </div>
              <div class="form-group">
                <label for="domicilio" class="form-label">Domicilio:</label>
                <input type="text" id="domicilio" name="domicilio" class="form-control border-label" required>
              </div>
              <!-- <button type="submit" class="btn btn-primary" name="insertar">Crear Alumno</button> -->
              <button type="submit" class="btn btn-primary">Crear Cliente</button>
              <button type="button" class="btn btn-secondary" onclick="cerrarRecuadro()">Cancelar</button>

            </form>
          </div>
          <br>
          <br>

          <div class="col-md-8 mb-3">
            <div class="card h-100 custom-card" style="width: 100%;">
              <div class="card-body">
                <h6 class="card-title">Detalles factura</h6><br>
                <div class="form-group">
                  <label for="tipoFactura">Tipo de factura:</label>
                  <select class="form-control" id="tipoFactura" name="tipoFactura">
                    <option value="consumidor">Consumidor Final</option>
                    <option value="monotributista">Monotributista</option>
                    <option value="responsable">Responsable Inscripto</option>
                    <option value="sujetoexento">Sujeto Exento</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="formaPago">Forma de pago:</label>
                  <select class="form-control" id="formaPago" name="formaPago">
                    <option value="efectivo">Efectivo</option>
                    <option value="tarjeta">Tarjeta de crédito</option>
                    <option value="transferencia">Transferencia Bancaria</option>
                  </select>
                </div>
                <!-- Tabla con scroll horizontal -->
                <div class="table-responsive">
                  <table class="table table-bordered">
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
                    <tbody>
                      <tr>
                        <td><input class="itemRow" type="checkbox"></td>
                        <td><input type="number" name="productCode[]" id="productCode_1" class="form-control" autocomplete="off"></td>
                        <td><input type="text" name="productName[]" id="productName_1" class="form-control" autocomplete="off"></td>
                        <td><input type="number" name="quantity[]" id="quantity_1" class="form-control" autocomplete="off"></td>
                        <td><input type="number" name="price[]" id="price_1" class="form-control" autocomplete="off"></td>
                        <td><input type="number" name="total[]" id="total_1" class="form-control" autocomplete="off"></td>
                      </tr>
                    </tbody>
                  </table>
                </div>

                <!-- Botones para agregar/eliminar ítems -->
                <div class="botones mb-3">
                  <button class="btn custom-btn">- Eliminar</button>
                  <button class="btn custom-btn" onclick="agregarFila()">+ Agregar</button>
                </div>

                <!-- Resumen de la factura -->
                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label for="montoPagado" class="form-label">Monto Pagado</label>
                    <input type="number" id="montoPagado" class="form-control" placeholder="$">
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="total" class="form-label">Total</label>
                    <input type="number" id="total" class="form-control" placeholder="$">
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label for="montoImpuestos" class="form-label">Monto Impuestos</label>
                    <input type="number" id="montoImpuestos" class="form-control" placeholder="$">
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="porcentajeImpuestos" class="form-label">Porcentaje Impuestos</label>
                    <input type="number" id="porcentajeImpuestos" class="form-control" placeholder="%">
                  </div>
                </div>

                <!-- Observaciones -->
                <div class="mb-3">
                  <label for="observacion" class="form-label">Observaciones</label>
                  <textarea class="form-control" id="observacion" rows="3"></textarea>
                </div>

                <!-- Botón de generar factura -->
                <button class="btn custom-btn">Generar Factura</button>
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


  <script>
    function abrirRecuadro() {
      var recuadro = document.getElementById("recuadro");
      recuadro.style.display = "block";
    }

    function cerrarRecuadro() {
      var recuadro = document.getElementById("recuadro");
      recuadro.style.display = "none";
    }

    // ////////////////////////////  Buscar cliente por dni //////////////////////////////////////////////////////
    // document.querySelector('form').addEventListener('submit', function(event) {
    //   event.preventDefault(); // Prevenir el envío normal del formulario

    //   const dni = document.getElementById('dni').value;

    //   // Realizar la petición AJAX
    //   fetch('../controlador/cliente.php', {
    //       method: 'POST',
    //       headers: {
    //         'Content-Type': 'application/x-www-form-urlencoded',
    //       },
    //       body: new URLSearchParams({
    //         dni: dni,
    //       })
    //     })
    //     .then(response => response.json())
    //     .then(data => {
    //       // Verificar si hay un error en la respuesta
    //       if (data.error) {
    //         alert(data.error);
    //         return;
    //       }

    //       // Mostrar datos del cliente en la página
    //       document.getElementById('clienteInfo').style.display = 'block';
    //       document.getElementById('nombreCliente').innerText = data.nombre; // Asumiendo que tienes un campo 'nombre'
    //       document.getElementById('direcionCliente').innerText = data.domicilio; // Asumiendo que tienes un campo 'email'
    //       document.getElementById('telefonoCliente').innerText = data.celular; // Asumiendo que tienes un campo 'telefono'
    //     })
    //     .catch(error => {
    //       console.error('Error:', error);
    //       alert('Ha ocurrido un error al buscar el cliente.');
    //     });
    // });
  </script>

<script>
    // Evento de clic para buscar cliente por DNI
    document.getElementById('buscarClienteBtn').addEventListener('click', function() {
        const clienteDni = document.getElementById('dni').value;

        // Verificar que el DNI no esté vacío antes de hacer la solicitud
        if (!clienteDni) {
            alert("Por favor ingresa el DNI del cliente.");
            return;
        }

        // Realizar la petición AJAX
        fetch('../controlador/cliente.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                dni: clienteDni,
            })
        })
        .then(response => response.json())
        .then(data => {
            // Verificar si hay un error en la respuesta
            if (data.error) {
                alert(data.error);
                return;
            }

            // Mostrar datos del cliente en la página
            document.getElementById('clienteInfo').style.display = 'block';
            document.getElementById('nombreCliente').innerText = data.nombre; // Campo 'nombre'
            document.getElementById('direcionCliente').innerText = data.domicilio; // Campo 'domicilio'
            document.getElementById('telefonoCliente').innerText = data.celular; // Campo 'celular'
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Ha ocurrido un error al buscar el cliente.');
        });
    });
</script>
<script>
document.querySelectorAll('.productCode').forEach(input => {
    input.addEventListener('change', function() {
        const productCode = this.value;
        const rowId = this.id.split('_')[1]; // Obtener el número de la fila, e.g., 1

        // Verificar que se haya ingresado un código de producto
        if (!productCode) return;

        // Realizar la petición AJAX al controlador de productos
        fetch('../controlador/producto.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                numeroProducto: productCode,
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert(data.error);
                return;
            }

            // Actualizar los campos de nombre y precio con los datos obtenidos
            document.getElementById(`productName_${rowId}`).value = data.descricion_producto;
            document.getElementById(`price_${rowId}`).value = data.precio_producto;

            // Calcular el total automáticamente si ya hay una cantidad ingresada
            const quantity = document.getElementById(`quantity_${rowId}`).value;
            if (quantity) {
                document.getElementById(`total_${rowId}`).value = (data.precio_producto * quantity).toFixed(2);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Ha ocurrido un error al buscar el producto.');
        });
    });
});

// Evento para actualizar el total automáticamente al cambiar la cantidad
document.querySelectorAll('.quantity').forEach(input => {
    input.addEventListener('input', function() {
        const rowId = this.id.split('_')[1]; // Obtener el número de la fila
        const price = parseFloat(document.getElementById(`price_${rowId}`).value);
        const quantity = parseFloat(this.value);

        if (!isNaN(price) && !isNaN(quantity)) {
            document.getElementById(`total_${rowId}`).value = (price * quantity).toFixed(2);
        }
    });
});
</script>


</body>

</html>