<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facturacion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        body {
            background-color: #c9d6ff;
            background: linear-gradient(to right, #e2e2e2, #c9d6ff);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            height: 100vh;
        }

        .form-inline .form-group {
            margin-bottom: 20px;
            float: right;
        }

        .col .form-group {
            margin-bottom: 20px;
            float: left;
        }

        .form-control-txt {
            width: 100%;
            /* Asegúrate de que ocupa el 100% del contenedor */
        }
    </style>
</head>

<body>
    <br><br><br><br>
    <div class="container content-factura">
        <form action="../controlador/factura.php?accion=crear" id="invoice-form" method="post" class="invoice-form" role="form" novalidate="">
            <div class="load-animate animated fadeInUp">
                <div class="row">
                    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                        <h2 class="title">FacturaciónPro</h2>
                    </div>
                </div>
                <input id="currency" type="hidden" value="$">
                <div class="row">

                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                        <h3>Compañía xd</h3>
                        <?php echo "FracturaciónPro" ?><br>
                        <?php echo "Av. Qsyo 123"  ?><br>
                        <?php echo "tel: 2616908765"  ?><br>
                        <?php echo "facturacionpro@gmail.com" ?><br>
                        <!-- por ahora mostramos los datos asi -->
                        <!-- pero nc si hacer un tabla con los datos de la muebleria -->
                        <!-- Muebleria: id,nombre,direccion,email,tel -->
                    </div>
                    <div class="col">
                        <h3 class="col">Quien Compra</h3>
                        <label for="nombre">Nombre del cliente:</label>
                        <input type="text" id="nombre" name="nombre" required>
                        <br>

                        <label for="cuil">CUIL/CUIT:</label>
                        <input type="text" id="cuil" name="cuil" required>
                        <br>

                        <label for="nombre">Domicilio:</label>
                        <input type="text" id="nombre" name="nombre" required>
                        <br>
                    </div>

                </div> <br> <br>
                <div class="row">
                    <label for="tipoFactura">Tipo de factura:</label>
                    <select id="tipoFactura" name="tipoFactura">
                        <option value="consumidor">Consumidor final</option>
                        <option value="monotributista">Monotributista</option>
                        <option value="responsable">Responsable inscripto</option>
                        <option value="sujetoexento">Sujeto Exento </option>
                    </select>

                    <label for="formaPago">Forma de pago:</label>
                    <select id="formaPago" name="formaPago">
                        <option value="efectivo">Efectivo</option>
                        <option value="tarjeta">Tarjeta de crédito</option>
                        <option value="transferencia">Transferencia bancaria</option>
                    </select>
                    <br>
                </div> <br> <br>
                <div class="row">
                    <div class="tablaProducto">
                        <table class="table table-bordered table-hover" id="invoiceItem">
                            <tr>
                                <th width="2%"><input id="checkAll" class="formcontrol" type="checkbox"></th>
                                <th width="15%">No Ítem</th>
                                <th width="38%">Nombre Ítem</th>
                                <th width="15%">Cantidad</th>
                                <th width="15%">Precio</th>
                                <th width="15%">Total</th>
                            </tr>
                            <tr>
                                <td><input class="itemRow" type="checkbox"></td>
                                <td><input type="text" name="productCode[]" id="productCode_1" class="form-control" autocomplete="off"></td>
                                <td><input type="text" name="productName[]" id="productName_1" class="form-control" autocomplete="off"></td>
                                <td><input type="number" name="quantity[]" id="quantity_1" class="form-control quantity" autocomplete="off"></td>
                                <td><input type="number" name="price[]" id="price_1" class="form-control price" autocomplete="off"></td>
                                <td><input type="number" name="total[]" id="total_1" class="form-control total" autocomplete="off"></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="accionesProducto">
                        <button class="btn btn-danger delete" id="removeRows" type="button">- Eliminar</button>
                        <button class="btn btn-success" id="addRows" type="button">+ Agregar Más</button>
                    </div>
                </div>
                <div class="row">
                    <div class="factura">
                        <span class="form-inline">
                            <div class="form-group">
                                <label>Subtotal: &nbsp;</label>
                                <div class="input-group">
                                    <div class="input-group-addon currency">$</div>
                                    <input value="" type="number" class="form-control" name="subTotal" id="subTotal" placeholder="Subtotal">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Porcentaje Impuestos: &nbsp;</label>
                                <div class="input-group">
                                    <input value="" type="number" class="form-control" name="taxRate" id="taxRate" placeholder="Porcentaje Impuestos">
                                    <div class="input-group-addon">%</div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Monto impuestos: &nbsp;</label>
                                <div class="input-group">
                                    <div class="input-group-addon currency">$</div>
                                    <input value="" type="number" class="form-control" name="taxAmount" id="taxAmount" placeholder="Monto impuestos">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Total: &nbsp;</label>
                                <div class="input-group">
                                    <div class="input-group-addon currency">$</div>
                                    <input value="" type="number" class="form-control" name="totalAftertax" id="totalAftertax" placeholder="Total">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Monto Pagado: &nbsp;</label>
                                <div class="input-group">
                                    <div class="input-group-addon currency">$</div>
                                    <input value="" type="number" class="form-control" name="amountPaid" id="amountPaid" placeholder="Monto Pagado">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Cambio: &nbsp;</label>
                                <div class="input-group">
                                    <div class="input-group-addon currency">$</div>
                                    <input value="" type="number" class="form-control" name="amountDue" id="amountDue" placeholder="Cambio">
                                </div>
                            </div>
                            <div class="col">
                                <h3>Observaciones: </h3>
                                <div class="form-group">
                                    <textarea class="form-control-txt" rows="5" name="notes" id="notes" placeholder="Observaciones"></textarea>
                                </div>
                                <br>
                            </div>
                            <div class="finalFactura">
                                <div class="form-group">
                                    <input type="hidden" value="<?php echo $_SESSION['userid']; ?>" class="form-control" name="userId">
                                    <input data-loading-text="Guardando factura..." type="submit" name="invoice_btn" value="Guardar factura" class="btn btn-success submit_btn invoice-save-btm">
                                </div>

                            </div>
                        </span>

                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </form>

    </div>
</body>

</html>