<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Factura</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        body {
            background-color: #c9d6ff;
            background: linear-gradient(to right, #e2e2e2, #e0f9dc); 
            display: flex;
            flex-direction: column;
            height: 100vh;
        }

        /* .border-label { 
            border: 2px solid #95be9c;
        }*/

        .btn-agregar {
            background: #82E5A9;
            color: #2530B1;
            border-radius: 1em;
            font-weight: 600;
            font-style: bold;
        }

        .form-container {
            padding: 20px;
            margin-bottom: 20px;
        }

        .form-container label {
            display: block;
            margin-bottom: 5px;
        }

        .form-container input,
        .form-container select {
            width: 100%;
            margin-bottom: 15px;
        }

        .table-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .botones {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .d-grid {
            margin-top: 20px;
        }

        
    </style>
</head>
<body>

<nav class="navbar bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand">
      <img src="logo_2.png" alt="Logo" width="50" height="50" class="">
      Encanto Natural
    </a>
  </div>
</nav> 
<br>

<!-- <div class="datos"> 
    <p><b>Dirección:</b> Avenida Rodriguez 123 <br> <b>Teléfono:</b> 2616908765 <br><b>Correo electrónico:</b> EncantoNatural@gmail.com</p>
</div>-->

<div class="container">
  <div class="row">
    <div class="col-md-6">
      <div class="form-container">
        <h2 class="text-left">Generar Factura</h2>
        <br>

        <div class="form-group">
          <label for="nombre" class="form-label">Nombre del cliente:</label>
          <input type="text" id="nombre" name="nombre" class="form-control border-label" required>
        </div>

        <div class="form-group">
          <label for="cuit" class="form-label">CUIL/CUIT:</label>
          <input type="text" id="cuit" name="cuit" class="form-control border-label" required>
        </div>

        <div class="form-group">
          <label for="domicilio" class="form-label">Domicilio:</label>
          <input type="text" id="domicilio" name="domicilio" class="form-control border-label" required>
        </div>

        <div class="form-group">
          <label for="tipoFactura">Tipo de factura:</label>
          <select class="form-control" id="tipoFactura" name="tipoFactura">
            <option value="consumidor">Consumidor Final</option>
            <option value="monotributista">Monotributista</option>
            <option value="responsable">Responsable Inscripto</option>
            <option value="sujetoexento">Sujeto Exento</option>
          </select>
        </div>

        <div class="form-group">
          <label for="formaPago">Forma de pago:</label>
          <select class="form-control" id="formaPago" name="formaPago">
            <option value="efectivo">Efectivo</option>
            <option value="tarjeta">Tarjeta de crédito</option>
            <option value="transferencia">Transferencia Bancaria</option>
          </select>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="table-container">
        <table class="table table-bordered">
          <tr>
            <th width="2%"></th>
            <th width="15%">N° Ítem</th>
            <th width="38%">Nombre Ítem</th>
            <th width="15%">Cantidad</th>
            <th width="15%">Precio</th>
            <th width="15%">Total</th>
          </tr>
          <tr>
            <td><input class="itemRow" type="checkbox"></td>
            <td><input type="number" name="productCode[]" id="productCode_1" class="form-control" autocomplete="off"></td>
            <td><input type="text" name="productName[]" id="productName_1" class="form-control" autocomplete="off"></td>
            <td><input type="number" name="quantity[]" id="quantity_1" class="form-control quantity" autocomplete="off"></td>
            <td><input type="number" name="price[]" id="price_1" class="form-control price" autocomplete="off"></td>
            <td><input type="number" name="total[]" id="total_1" class="form-control total" autocomplete="off"></td>
          </tr>
        </table>
        <div class="botones">
          <button class="btn btn-danger">- Eliminar</button>
          <button class="btn btn-success">+ Agregar</button>
        </div>
      </div>
      <div class="d-grid gap-2 col-12 mx-auto">
        <div class="row">
          <div class="col-md-6">
            <label for="montoPagado" class="form-label">Monto Pagado</label>
            <input type="number" id="montoPagado" class="form-control" placeholder="$">
          </div>
          <div class="col-md-6">
            <label for="total" class="form-label">Total</label>
            <input type="number" id="total" class="form-control" placeholder="$">
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <label for="montoImpuestos" class="form-label">Monto Impuestos</label>
            <input type="number" id="montoImpuestos" class="form-control" placeholder="$">
          </div>
          <div class="col-md-6">
            <label for="porcentajeImpuestos" class="form-label">Porcentaje Impuestos</label>
            <input type="number" id="porcentajeImpuestos" class="form-control" placeholder="%">
          </div>
        </div>
        <div class="mb-3">
          <label for="observacion" class="form-label">Observaciones</label>
          <textarea class="form-control" id="observacion" rows="3"></textarea>
        </div>
        <label for="cambio" class="form-label">Cambio</label>
        <input type="number" id="cambio" class="form-control" placeholder="$">
        <button class="btn btn-agregar mt-3">Generar Factura</button>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
