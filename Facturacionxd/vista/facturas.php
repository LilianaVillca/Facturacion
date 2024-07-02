<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facturacion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: white;
            background: linear-gradient(to right, #e2e2e2, #e0f9dc); 
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            height: 100vh;
        }

        /*  */
        .title-box {
            padding: 3rem 1.5rem 2rem;
            text-align: center;
        }

        .btn-nueva {
            margin: 2px 0 14px 0;
            
        }
    </style>
</head>

<body>
    


    <?php
    
        // Incluir el modelo correspondiente
        include_once("../modelo/conexion.php");

        $modelo = new Conexion();

        $facturas = $modelo->obtener_facturas();
    ?>
    <div class="container">

        <div class="title-box">
            <h1>Gestión de Facturación</h1>
            <p class="lead">Genera facturas de manera rápida y sencilla con todos los detalles necesarios, incluyendo la información del cliente, los productos o servicios, y los impuestos aplicables..</p>
        </div>

        <a class="btn btn-success btn-nueva" href="craerFactura.php"><b>+</b> Crear Factura </a>
        <table class="table table-bordered grocery-crud-table table-hover">
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
                    // debemos de extraer los datos del usuario para mostrolarlos por aca
                    // pero lo hacemos luego
                    echo "<td>" . $factura["total_despues_impuesto"] . "</td>";
                    echo "<td>";
                    echo "<a href='../controlador/factura.php?accion=imprimir&id=" . $factura["id_factura"] . "' class='editar'>Imprimir</a>";
                    echo "<a href='../controlador/factura.php?accion=editar&id=" . $factura["id_factura"] . "' class='editar'>Editar</a>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>

            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>