<?php
?>
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
<?php
  include_once("../modelo/conexion.php");
  $modelo = new Conexion();
  $facturas = $modelo->obtener4_facturas();
  // $notaCredito = $modelo->obtenerNotaCredito();
  ?>
  <div class="d-flex">
    <!-- Sidebar -->
    <div id="sidebar" class="bg-light p-3">
      <div class="text-center mb-4">
        <img src="img/user1.png" class="rounded-circle" alt="Avatar">
        <p class="mt-2">Empleado <br><?php session_start();
                                          echo htmlspecialchars($_SESSION["nombre_usuario"]) ?> </p>
      </div>
      <hr>
      <ul class="nav flex-column">
        <li class="nav-item mb-2">
          <a class="nav-link text-dark active" href="empleado.php"><i class="fas fa-th-large me-2"></i> Inicio</a>
        </li>
        <li class="nav-item mb-2">
          <a class="nav-link text-dark" href="facturas2.php"><i class="fas fa-file-invoice me-2"></i> Facturas</a>
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

      <!-- Main Content -->
      <div class="content p-4">
        <!-- <p>Esta es la área de contenido principal.</p> -->

        <div class="container">
          <div class="row justify-content-md-center">
            <div class="col-md-8 mb-3">
              <div class="card h-100 custom-card" style="width: 100%;">
                <div class="card-body">
                  <h6 class="card-title">Productos más vendidos</h6><br>
                  <canvas id="myChart" style="width: 100%; height: 160px;"></canvas>

                </div>
              </div>
            </div>

          </div>
        </div>

        <div class="col-md-11 mb-3 mx-auto">
          <h6>Últimas facturas</h6>
          <div class="card custom-card">
            <div class="card-body">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col"> </th>
                    <th scope="col">Tipo Factura</th>
                    <th scope="col">N° Factura</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Hora</th>
                    <th scope="col">Facturado</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach ($facturas as $factura) : ?>
                    <tr>
                      <td scope="col"> </td>
                      <td><?php echo $factura["tipo_comprobante"]; ?></td>
                      <td><?php
                          if (!empty($factura["id_nota_credito"])) {
                            echo $factura["id_nota_credito"];
                          } else {
                            echo $factura["id_factura"];
                          }
                          ?>
                      </td>
                      <td><?php echo $factura["nombre_cliente"]; ?></td>
                      <td><?php echo $factura["fecha"]; ?></td>
                      <td><?php echo $factura["hora"]; ?></td>
                      <td><?php
                          if (!empty($factura["id_nota_credito"])) {
                            echo "- $", $factura["total"];
                          } else {
                            echo "$", $factura["total"];
                          }
                          ?>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>


      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../factura.js"></script>


</body>
<script>
  ////////////////////////////// Funcionalidad de graficos ////////////////////////////////////////////////////////////////////////////////

  var ctx = document.getElementById('myChart').getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'bar', // El tipo de gráfico que quieres (bar, line, pie, etc.)
    data: {
      labels: ['Silla', 'Mesa', 'Alfombra', 'Mesada'], // Las etiquetas en el eje X
      datasets: [{
        //label: 'Productos más vendidos',
        data: [3, 5, 12, 20], // Los datos que quieres graficar
        backgroundColor: [
          '#6c3ed8',
          '#6c3ed8',
          '#6c3ed8',
          '#6c3ed8'
        ],

        maxBarThickness: 60,

        borderColor: [
          '#6c3ed8',
          '#6c3ed8',
          '#6c3ed8',
          '#6c3ed8'
        ],
        borderWidth: 1
      }]
    },
    options: {
      plugins: {
        legend: {
          display: false // Ocultar leyenda
        }
      },
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
  ///////////////////////////////////////////  Funcionalidad ocultar dinero ////////////////////////////////////////////////////////////////////////////////
  document.addEventListener('DOMContentLoaded', function() {
    const totalReal = 6543.75; // Ejemplo: $6543.75

    // Guarda el contenido inicial del HTML
    const totalFacturadoElement = document.getElementById('totalFacturado');
    const toggleBtn = document.getElementById('toggleBtn');
    const initialTextContent = totalFacturadoElement.textContent;
    const initialButtonText = toggleBtn.textContent;

    function toggleFacturado() {
      // Si actualmente muestra los asteriscos, cambia al valor real
      if (totalFacturadoElement.textContent === initialTextContent) {
        totalFacturadoElement.textContent = `$${totalReal.toFixed(2)}`; // Muestra el valor real
        toggleBtn.textContent = 'Ocultar'; // Cambia el texto del botón a "Ocultar"
      } else {
        // Restaura el contenido inicial sin escribir manualmente los valores
        totalFacturadoElement.textContent = initialTextContent;
        toggleBtn.textContent = initialButtonText;
      }
    }

    // Agrega el evento de clic al botón
    toggleBtn.addEventListener('click', toggleFacturado);
  });
</script>

</html>