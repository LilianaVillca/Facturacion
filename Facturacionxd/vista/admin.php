<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Custom Sidebar</title>
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
      <p class="mt-2">Administrador <br> Luis</p>
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
      <a class="nav-link text-dark" href="#"><i class="fas fa-sign-out-alt me-2"></i> Cerrar sesión</a>
    </div>
  </div>

  <!-- Content Section -->
  <div class="w-100">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light text-white">
      <div class="container-fluid">
        <span class="navbar-brand text-white">Encanto Natural</span>
        <!-- <form class="d-flex">
          <input class="form-control me-4" type="search" placeholder="Buscar facturas, clientes, etc" aria-label="Search">
          <button class="btn btn-outline-light" type="submit"><i class="fas fa-search"></i></button>
        </form> -->
        
      </div>
    </nav>

    <!-- Main Content -->
    <div class="content p-4">
      <!-- <h1>Bienvenido, Luis</h1>
      <p>Esta es la área de contenido principal.</p> -->

  <div class="container">
   <div class="row justify-content-md-center">
    <div class="col-md-3 mb-3">
      <div class="card h-100 custom-card" style="width: 100%;">
        <div class="card-body">
          <h6 class="card-title">Hoy</h6><br>
          <div class="text-center">
            <p class="card-text">Total Facturado</p>
            <h4>$6***</h4><br>
            <a href="#" class="btn custom-btn btn-center">Ver</a>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-8 mb-3" >
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
          <th scope="col">N° Factura</th>
          <th scope="col">Nombre</th>
          <th scope="col">Hora</th>
          <th scope="col">Facturado</th>
        </tr>
      </thead>
      <tbody>
        <tr onclick="window.location.href='facturas.php'">
          <th scope="row"><i class="fas fa-file-invoice me-2"></i></th>
          <td>4</td>
          <td>Marcelo Suarez</td>
          <td>13:12 hs</td>
          <td>$50.00</td>
        </tr>
        <tr onclick="window.location.href='facturas.php'">
          <th scope="row"><i class="fas fa-file-invoice me-2"></i></th>
          <td>3</td>
          <td>Carlos Suarez</td>
          <td>12:30 hs</td>
          <td>$100.00</td>
        </tr>
        <tr onclick="window.location.href='facturas.php'">
          <th scope="row"><i class="fas fa-file-invoice me-2"></i></th>
          <td>2</td>
          <td>Gimena Suarez</td>
          <td>11:40 hs</td>
          <td>$650.00</td>
        </tr>
        <tr onclick="window.location.href='facturas.php'">
          <th scope="row"><i class="fas fa-file-invoice me-2"></i></th>
          <td>1</td>
          <td>Pia Suarez</td>
          <td>11:30 hs</td>
          <td>$500.00</td>
        </tr>
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

<script>
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

        maxBarThickness:60,
        
        borderColor: [
          '#6c3ed8',
          '#6c3ed8',
          '#6c3ed8',
          '#6c3ed8'
        ],
        borderWidth: 1
      }]
    }, options: {
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
</script>

</body>
</html>
