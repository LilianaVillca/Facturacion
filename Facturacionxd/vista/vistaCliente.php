<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos del Cliente</title>
</head>
<body>
    <h1>Información del Cliente</h1>
    <p><strong>ID:</strong> <?php echo htmlspecialchars($cliente['id_cliente']); ?></p>
    <p><strong>Nombre:</strong> <?php echo htmlspecialchars($cliente['nombre']); ?></p>
    <p><strong>CUIL/CUIT:</strong> <?php echo htmlspecialchars($cliente['cuil']); ?></p>
    <!-- Agrega más campos según lo necesites -->
</body>
</html>
