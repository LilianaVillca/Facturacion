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

        .imprimir svg,
        .editar svg {
            width: 24px;
            /* Ajusta el ancho del ícono */
            height: 24px;
            /* Ajusta la altura del ícono */
        }

        .imprimir,
        .editar {
            display: inline-block;
            margin-right: 10px;
            /* Añade espacio entre los íconos */
            text-decoration: none;
            /* Elimina el subrayado de los enlaces */
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
                    // echo "<td>" . $factura["fecha"] . "</td>";
                    echo "<td>Juan</td>";
                    echo "<td>Juan</td>";
                    // debemos de extraer los datos del usuario para mostrolarlos por aca
                    // pero lo hacemos luego
                    echo "<td>" . $factura["total_despues_impuesto"] . "</td>";
                    echo "<td>";
                    echo "<a href='../controlador/factura.php?accion=imprimir&id=" . $factura["id_factura"] . "' target='_blank' class='imprimir'>
    <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-filetype-pdf' viewBox='0 0 16 16'>
    <path fill-rule='evenodd' d='M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zM1.6 11.85H0v3.999h.791v-1.342h.803q.43 0 .732-.173.305-.175.463-.474a1.4 1.4 0 0 0 .161-.677q0-.375-.158-.677a1.2 1.2 0 0 0-.46-.477q-.3-.18-.732-.179m.545 1.333a.8.8 0 0 1-.085.38.57.57 0 0 1-.238.241.8.8 0 0 1-.375.082H.788V12.48h.66q.327 0 .512.181.185.183.185.522m1.217-1.333v3.999h1.46q.602 0 .998-.237a1.45 1.45 0 0 0 .595-.689q.196-.45.196-1.084 0-.63-.196-1.075a1.43 1.43 0 0 0-.589-.68q-.396-.234-1.005-.234zm.791.645h.563q.371 0 .609.152a.9.9 0 0 1 .354.454q.118.302.118.753a2.3 2.3 0 0 1-.068.592 1.1 1.1 0 0 1-.196.422.8.8 0 0 1-.334.252 1.3 1.3 0 0 1-.483.082h-.563zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638z'/>
    </svg>
    </a>";

                    //                 echo "<a href='../controlador/factura.php?accion=editar&id=" . $factura["id_factura"] . "' class='editar'>
                    // <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
                    // <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
                    // <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z'/>
                    // </svg>
                    // </a>";
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