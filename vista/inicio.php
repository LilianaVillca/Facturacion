<?php
// Inicializar la sesión
session_start();

// Si no existe el carrito en la sesión, inicializarlo
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Añadir producto al carrito
if (isset($_GET['accion']) && $_GET['accion'] === 'agregar') {
    $id = $_GET['id'];
    $nombre = $_GET['nombre'];
    $precio = $_GET['precio'];

    // Añadir producto al carrito
    $_SESSION['carrito'][] = ['id' => $id, 'nombre' => $nombre, 'precio' => $precio];
}

// Vaciar el carrito
if (isset($_GET['accion']) && $_GET['accion'] === 'vaciar') {
    $_SESSION['carrito'] = [];
}

// Datos de los productos
$productos = [
    'cocina_comedor' => [
        ['id' => 1, 'nombre' => 'Mesa de Cocina', 'precio' => 100, 'imagen' => 'mesa_cocina.jpg'],
        ['id' => 2, 'nombre' => 'Silla de Comedor', 'precio' => 50, 'imagen' => 'silla_comedor.jpg'],
        ['id' => 3, 'nombre' => 'Vitrina', 'precio' => 150, 'imagen' => 'vitrina.jpg'],
        ['id' => 4, 'nombre' => 'Taburete', 'precio' => 30, 'imagen' => 'taburete.jpg'],
        ['id' => 5, 'nombre' => 'Banco de Cocina', 'precio' => 70, 'imagen' => 'banco_cocina.jpg'],
        ['id' => 6, 'nombre' => 'Mesa de Comedor', 'precio' => 200, 'imagen' => 'mesa_comedor.jpg'],
    ],
    'sala' => [
        ['id' => 7, 'nombre' => 'Sofá', 'precio' => 300, 'imagen' => 'sofa.jpg'],
        ['id' => 8, 'nombre' => 'Mesa de Centro', 'precio' => 100, 'imagen' => 'mesa_centro.jpg'],
        ['id' => 9, 'nombre' => 'Estantería', 'precio' => 200, 'imagen' => 'estanteria.jpg'],
        ['id' => 10, 'nombre' => 'Sillón', 'precio' => 150, 'imagen' => 'sillon.jpg'],
        ['id' => 11, 'nombre' => 'Lámpara de Pie', 'precio' => 80, 'imagen' => 'lampara_pie.jpg'],
        ['id' => 12, 'nombre' => 'Mesa Auxiliar', 'precio' => 60, 'imagen' => 'mesa_auxiliar.jpg'],
    ],
    'cuarto' => [
        ['id' => 13, 'nombre' => 'Cama', 'precio' => 400, 'imagen' => 'cama.jpg'],
        ['id' => 14, 'nombre' => 'Armario', 'precio' => 350, 'imagen' => 'armario.jpg'],
        ['id' => 15, 'nombre' => 'Mesita de Noche', 'precio' => 70, 'imagen' => 'mesita_noche.jpg'],
        ['id' => 16, 'nombre' => 'Cómoda', 'precio' => 200, 'imagen' => 'comoda.jpg'],
        ['id' => 17, 'nombre' => 'Espejo', 'precio' => 50, 'imagen' => 'espejo.jpg'],
        ['id' => 18, 'nombre' => 'Lámpara de Mesa', 'precio' => 40, 'imagen' => 'lampara_mesa.jpg'],
    ],
    'oficina' => [
        ['id' => 19, 'nombre' => 'Escritorio', 'precio' => 250, 'imagen' => 'escritorio.jpg'],
        ['id' => 20, 'nombre' => 'Silla de Oficina', 'precio' => 120, 'imagen' => 'silla_oficina.jpg'],
        ['id' => 21, 'nombre' => 'Estantería Oficina', 'precio' => 180, 'imagen' => 'estanteria_oficina.jpg'],
        ['id' => 22, 'nombre' => 'Archivador', 'precio' => 100, 'imagen' => 'archivador.jpg'],
        ['id' => 23, 'nombre' => 'Lámpara de Escritorio', 'precio' => 45, 'imagen' => 'lampara_escritorio.jpg'],
        ['id' => 24, 'nombre' => 'Mesa de Reuniones', 'precio' => 350, 'imagen' => 'mesa_reuniones.jpg'],
    ],
];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda de Muebles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Tienda de Muebles</h1>
        <nav>
            <ul>
                <li><a href="#cocina_comedor">Cocina y Comedor</a></li>
                <li><a href="#sala">Sala</a></li>
                <li><a href="#cuarto">Cuarto</a></li>
                <li><a href="#oficina">Oficina</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <?php foreach ($productos as $categoria => $items): ?>
            <section id="<?php echo $categoria; ?>">
                <h2><?php echo ucfirst(str_replace('_', ' y ', $categoria)); ?></h2>
                <div class="productos">
                    <?php foreach ($items as $item): ?>
                        <div class="producto">
                            <img src="images/<?php echo $item['imagen']; ?>" alt="<?php echo $item['nombre']; ?>">
                            <h3><?php echo $item['nombre']; ?></h3>
                            <p>Precio: $<?php echo number_format($item['precio'], 2); ?></p>
                            <a href="?accion=agregar&id=<?php echo $item['id']; ?>&nombre=<?php echo urlencode($item['nombre']); ?>&precio=<?php echo $item['precio']; ?>">Añadir al Carrito</a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endforeach; ?>
    </main>

    <aside>
        <h2>Carrito de Compras</h2>
        <ul>
            <?php foreach ($_SESSION['carrito'] as $item): ?>
                <li><?php echo $item['nombre']; ?> - $<?php echo number_format($item['precio'], 2); ?></li>
            <?php endforeach; ?>
        </ul>
        <p>Total: $<?php echo number_format(array_sum(array_column($_SESSION['carrito'], 'precio')), 2); ?></p>
        <a href="?accion=vaciar" class="boton">Nueva Compra</a>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    </aside>

    <footer>
        <p>&copy; 2024 Tienda de Muebles</p>
    </footer>
</body>
</html>
