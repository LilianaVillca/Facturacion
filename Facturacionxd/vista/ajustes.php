<?php
// Verifica si el usuario tiene permisos de administrador
// session_start();
// if ($_SESSION["rol"] !== "1") {
//     header("Location: .."); // Redirigir si no es admin
//     exit();
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ajustes</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="styles.css">
  <style>
    .perfil {
      background-color: #f5f5f5;
      padding: 20px;
      border-radius: 10px;
      max-width: 400px;
      margin: auto;
    }

    .perfil-item {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 10px 0;
      border-bottom: 1px solid #ddd;
    }

    .perfil-item p {
      margin: 0;
    }

    .btn-editar {
      background-color: #6a0dad;
      color: white;
      border: none;
      padding: 5px 10px;
      cursor: pointer;
      border-radius: 5px;
    }

    .btn-editar:hover {
      background-color: #5a0cac;
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
          <a class="nav-link text-dark" href="admin.php"><i class="fas fa-th-large me-2"></i> Inicio</a>
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
          <a class="nav-link text-dark active" href="ajustes.php"><i class="fas fa-cog me-2"></i> Ajustes</a>
        </li>
      </ul>
      <hr>
      <div class="mt-auto">
        <a class="nav-link text-dark" href="../controlador/cerrarSession.php"><i class="fas fa-sign-out-alt me-2"></i> Cerrar sesión</a>
      </div>
    </div>

    <div class="container mt-4">
      <div class="content p-4">
        <h3 class="mb-4">Editar perfil</h3>

        <!-- Sección de datos del perfil -->
        <div class="card mb-4 custom-card">
          <div class="card-body">
            <!-- Nombre -->
            <div class="d-flex justify-content-between align-items-center mb-3">

              <div>
                <h6 class="text-muted">Nombre</h6>
                <!-- Texto de nombre no editable -->
                <p id="nombreTexto">Administrador <?php echo htmlspecialchars($_SESSION["nombre_usuario"]) ?></p>
                <!-- Campo de entrada oculto para edición -->
                <!-- <input type="text" id="nombreInput" value="Administrador (abre php) echo htmlspecialchars($_SESSION["nombre_usuario"])(cierrea php) " class="form-control d-none"> -->
              </div>
              <!-- <div>-->
              <button class="btn custom-btn" onclick="editarCampo('nombre')">Editar</button>
              <!-- <button class="btn btn-outline-success btn-sm d-none" id="guardarNombreBtn" onclick="guardarCampo('nombre')">Guardar</button>
          <button class="btn btn-outline-secondary btn-sm d-none" id="cancelarNombreBtn" onclick="cancelarEdicion('nombre')">Cancelar</button>
        </div>  -->
            </div>
            <hr>

            <!-- Correo -->
            <div class="d-flex justify-content-between align-items-center mb-3">
              <div>
                <h6 class="text-muted">Correo</h6>
                <p class="mb-0">admin@gmail.com </p>
              </div>
              <button class="btn custom-btn">Editar</button>
            </div>

            <hr>

            <!-- Contraseña -->
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <h6 class="text-muted">Contraseña</h6>
                <p class="mb-0">********</p>
              </div>
              <a href="#" class="btn custom-btn" onclick="mostrarFormularioCambio()">Editar</a>
            </div>
          </div>
        </div>

        <!-- Formulario de cambio de contraseña oculto inicialmente -->
        <!-- <div id="formularioCambioContrasena" class="card mt-4" style="display: none;">
  <div class="card-body">
    <h5 class="card-title">Cambiar Contraseña</h5>
    <form action="ruta_a_tu_controlador_de_cambio_contraseña.php" method="POST">
      <div class="form-group">
        <label for="currentPassword">Contraseña actual:</label>
        <input type="password" id="currentPassword" name="currentPassword" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="newPassword">Nueva contraseña:</label>
        <input type="password" id="newPassword" name="newPassword" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="confirmPassword">Confirmar nueva contraseña:</label>
        <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-primary">Guardar cambios</button>
    </form>
  </div>
</div> -->




        <!-- Sección para actualizar detalles de factura -->
        <h4 class="mb-3">Actualizar detalles de factura</h4>
        <div class="card mb-4 custom-card">
          <div class="card-body d-flex justify-content-between align-items-center">
            <div>
              <img src="../vista/fpdf/logo_2.png" alt="Logo" class="rounded-circle" style="width: 50px; height: 50px;">
              <span class="ml-3">Encanto Natural</span>
            </div>
            <button class="btn custom-btn">Editar</button>
          </div>
        </div>
        <!-- Sección para Crear un Subadministrador -->
        <h4>Registrar Nuevos Usuarios</h4>
        <br>
        <div class="card mb-4 custom-card">
          <div class="card-body">
            <form action="../controlador/accionesCliente.php?accion=crearUsuario" method="POST">
              <div class="row">
                <!-- Columna 1: Nombre Completo y Nombre de Usuario -->
                <div class="col-md-6 mb-3">
                  <label for="nombreCompleto" class="form-label">Nombre Completo</label>
                  <input type="text" class="form-control form-control-sm" id="nombreCompleto" name="nombre" required>
                </div>

                <div class="col-md-6 mb-3">
                  <label for="usuario" class="form-label">Nombre de Usuario</label>
                  <input type="text" class="form-control form-control-sm" id="usuario" name="usuario" required>
                </div>

                <!-- Columna 2: Correo Electrónico y Contraseña -->
                <div class="col-md-6 mb-3">
                  <label for="correo" class="form-label">Correo Electrónico</label>
                  <input type="email" class="form-control form-control-sm" id="correo" name="correo" required>
                </div>

                <div class="col-md-6 mb-3">
                  <label for="contrasena" class="form-label">Contraseña</label>
                  <input type="password" class="form-control form-control-sm" id="contrasena" name="contrasena" required>
                </div>

                <!-- Campo oculto para el rol -->
                <input type="hidden" value="0" name="rol">
              </div>

              <!-- Botón centrado -->
              <div class="text-center mt-3">
                <button type="submit" class="btn custom-btn">Crear Sub Administrador</button>
              </div>
            </form>
          </div>
        </div>


        <h4 class="mb-3">Usuarios empleado</h4>
        <?php
        include_once("../modelo/conexion.php");
        $modelo = new conexion();
        $usuarios = $modelo->obtenerUsuarios();
        ?>
        <div class="card custom-card ms-3">
          <div class="card-body">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col"> </th>
                  <th scope="col">Nombre completo</th>
                  <th scope="col">Nombre de usuario</th>
                  <th scope="col">Correo electrónico</th>
                  <th scope="col">Contraseña</th>
                  <th scope="col"> </th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($usuarios as $usuario) {
                  echo "<tr >";
                  // echo "<tr onclick=\"window.location.href='facturas.php'\">";
                  // echo "<th scope='row'><i class='fas fa-edit me-2'></i></th>";
                  // echo "<th><a scope='row' href='../controlador/accionesCliente.php?accion=editarUsuario&id=" . $usuario["id_usuario"] . "'><i class='fas fa-edit me-2'></i></a></th>";
                  echo "<th></th>";
                  echo "<td>" . $usuario["nombre"] . "</td>";
                  echo "<td>" . $usuario["nomUsuario"] . "</td>";
                  echo "<td>" . $usuario["email"] . "</td>";
                  echo "<td>" . $usuario["password"] . "</td>";
                  // echo "<th scope='row'><i class='fas fa-trash me-2'></i></th>";
                  echo "<th><a scope='row' href='../controlador/accionesCliente.php?accion=eliminarUsuario&id=" . $usuario["id_usuario"] . "'><i class='fas fa-trash me-2'></i></a></th>";
                  echo "</tr>";
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
        <br>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Función para iniciar la edición del campo
    function editarCampo(campo) {
      document.getElementById(campo + 'Texto').classList.add('d-none');
      document.getElementById(campo + 'Input').classList.remove('d-none');

      document.getElementById('guardar' + capitalize(campo) + 'Btn').classList.remove('d-none');
      document.getElementById('cancelar' + capitalize(campo) + 'Btn').classList.remove('d-none');
    }

    // Función para guardar el campo editado
    function guardarCampo(campo) {
      const nuevoValor = document.getElementById(campo + 'Input').value;

      // Aquí enviarías `nuevoValor` al backend mediante una solicitud AJAX o un formulario oculto
      // Simulación de cambio en el frontend:
      document.getElementById(campo + 'Texto').innerText = nuevoValor;

      // Finalizar la edición
      cancelarEdicion(campo);
    }

    // Función para cancelar la edición
    function cancelarEdicion(campo) {
      document.getElementById(campo + 'Texto').classList.remove('d-none');
      document.getElementById(campo + 'Input').classList.add('d-none');

      document.getElementById('guardar' + capitalize(campo) + 'Btn').classList.add('d-none');
      document.getElementById('cancelar' + capitalize(campo) + 'Btn').classList.add('d-none');
    }

    // Función auxiliar para capitalizar la primera letra (para IDs de botones)
    function capitalize(s) {
      return s.charAt(0).toUpperCase() + s.slice(1);
    }
  </script>

  <!-- <script>
    function mostrarFormularioCambio() {
      var formulario = document.getElementById("formularioCambioContrasena");
      formulario.style.display = "block";
    }

    function cerrarFormulario() {
      var formulario = document.getElementById("formularioCambioContrasena");
      formulario.style.display = "none";
    }
</script> -->
</body>

</html>