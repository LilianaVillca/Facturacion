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
    if (isset($_GET["datoCliente"])) {
        // Deserializar los datos del usuario
        $cliente_serializado = $_GET["datoCliente"];
        $cliente = unserialize($cliente_serializado);
    }
    ?>

    <div class="d-flex">
        <!-- Sidebar -->
        <div id="sidebar" class="bg-light p-3">
            <div class="text-center mb-4">
                <img src="img/user1.png" class="rounded-circle" alt="Avatar">
                <p class="mt-2">Administrador <br> <?php session_start();
                                          echo htmlspecialchars($_SESSION["nombre_usuario"]) ?></p>
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
                </div>
                <form method="POST" action="../controlador/accionesCliente.php?accion=guardarEditado">
                    <div class="row justify-content-md-center">
                        <div class="col-md-10 mb-3">
                            <div class="card h-80 custom-card" style="width: 100%;">
                                <div class="card h-100 custom-card" style="width: 100%;">
                                    <div class="card-body">
                                        <h6 class="card-title">Datos del Cliente</h6><br>
                                        <input type="hidden" value="<?php echo $cliente['id_cliente'] ?>" name="id">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="nombre" class="form-label">Nombre</label>
                                                <input type="text" id="nombre"  value="<?php echo $cliente['nombre'] ?>" name="nombre" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="apellido" class="form-label">Apellido</label>
                                                <input type="text" id="apellido" value="<?php echo $cliente['apellido'] ?>" name="apellido" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="dni" class="form-label">DNI</label>
                                                <input type="text" id="dni" value="<?php echo $cliente['dni'] ?>" name="dni" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="domicio" class="form-label">Domicilio</label>
                                                <input type="text" id="domicilio" value="<?php echo $cliente['domicilio'] ?>" name="domicilio" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="celular" class="form-label">Celular</label>
                                                <input type="text" id="celular" value="<?php echo $cliente['celular'] ?>" name="celular" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="correo" class="form-label">Correo</label>
                                                <input type="text" id="correo" value="<?php echo $cliente['correo'] ?>"  name="correo" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="tipoCliente" class="form-label">Tipo Cliente</label>
                                                <input type="text" id="tipoCliente" value="<?php echo $cliente['tipo_cliente'] ?>" name="tipoCliente" class="form-control">
                                            </div>
                                        </div>
                                        <input type="submit" class="btn custom-btn" id="guardarFactura" value="Guardar Cambios">
                                        <!-- <button type="submit" class="btn custom-btn" id="guardarFactura"> Generar Factura</button> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
            <script src="../factura.js"></script>

</body>

</html>