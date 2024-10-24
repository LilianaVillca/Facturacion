<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facturacion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
        <a class="nav-link text-dark" href="clientes.php"><i class="fas fa-user me-2"></i> Clientes</a>
      </li>
      <li class="nav-item mb-2">
        <a class="nav-link text-dark" href="articulos.php"><i class="fas fa-box me-2"></i> Articulos</a>
      </li>
      <li class="nav-item mb-2">
        <a class="nav-link text-dark active" href="facturas.php"><i class="fas fa-file-invoice me-2"></i> Facturas</a>
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

        <a class="btn custom-btn btn-center" href="craerFactura.php"><b>+</b> Crear Factura </a>

    <div class="card custom-card">
      <div class="card-body">
        <table class="table table-hover">
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
                 // debemos de extraer los datos del usuario para mostrarlos por acá
                 // pero lo hacemos luego
                echo "<td> $ " . $factura["total_despues_impuesto"] . "</td>";
                echo "<td>";
                echo "<a href='../controlador/factura.php?accion=editar&id=" . $factura["id_factura"] . "' class='editar'>Ver</a>";
                echo "<a href='../controlador/factura.php?accion=imprimir&id=" . $factura["id_factura"] . "' class='editar'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-filetype-pdf' viewBox='0 0 16 16'>
                <path fill-rule='evenodd' d='M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zM1.6 11.85H0v3.999h.791v-1.342h.803q.43 0 .732-.173.305-.175.463-.474a1.4 1.4 0 0 0 .161-.677q0-.375-.158-.677a1.2 1.2 0 0 0-.46-.477q-.3-.18-.732-.179m.545 1.333a.8.8 0 0 1-.085.38.57.57 0 0 1-.238.241.8.8 0 0 1-.375.082H.788V12.48h.66q.327 0 .512.181.185.183.185.522m1.217-1.333v3.999h1.46q.602 0 .998-.237a1.45 1.45 0 0 0 .595-.689q.196-.45.196-1.084 0-.63-.196-1.075a1.43 1.43 0 0 0-.589-.68q-.396-.234-1.005-.234zm.791.645h.563q.371 0 .609.152a.9.9 0 0 1 .354.454q.118.302.118.753a2.3 2.3 0 0 1-.068.592 1.1 1.1 0 0 1-.196.422.8.8 0 0 1-.334.252 1.3 1.3 0 0 1-.483.082h-.563zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638z'/>
                </svg></a>";
                echo "</td>";
                echo "</tr>";
               }
              ?>
            </tbody>
        </table>
      </div>  
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>