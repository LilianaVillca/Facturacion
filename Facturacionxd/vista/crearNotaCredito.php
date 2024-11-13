
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

<form action="../http://localhost:3307/facturacion/controlador/notaCredito.php" method="POST">
    <label for="id_factura">ID de la Factura:</label>
    <input type="text" id="id_factura" name="id_factura" required>

    <label for="monto">Monto de la Nota de Crédito:</label>
    <input type="number" id="monto" name="monto" required>

    <label for="motivo">Motivo de la Nota de Crédito:</label>
    <textarea id="motivo" name="motivo" required></textarea>

    <button type="submit">Crear Nota de Crédito</button>
</form>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../factura.js"></script>

</body>

</html>