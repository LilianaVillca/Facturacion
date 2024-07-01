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

        .border-label{
            border: 2px solid #95be9c;
        }

        .btn-agregar{
            background: #82E5A9;
            color:#2530B1;
            border-radius: 1em;
            font-weight: 600;
            font-style: bold;
        }
    </style>
</head>
<body>

<nav class="navbar bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand">
      <img src="logo.png" alt="Logo" width="50" height="50" class="">
      Encanto Natural
    </a>
  </div>
</nav>  

<h3>Nombre Empresa</h3>
  <br>

<div>
    <h6>Datos empresa <br> telefono <br>gmail</h6>
</div>

<h2>Generar Factura</h2>

<div class="col-md-4">
  <label for="nombre" class="form-label">Nombre del cliente:</label><br>
  <input type="text" id="nombre" name="nombre" class="form-control border-label"  required><br>

  <label for="nombre" class="form-label">Nombre del cliente:</label><br>
  <input type="text" id="nombre" name="nombre" class="form-control border-label"  required><br>

  <label for="nombre" class="form-label">Nombre del cliente:</label><br>
  <input type="text" id="nombre" name="nombre" class="form-control border-label"  required><br>
</div>

<div class="select">

  <label for="tipoFactura">Tipo de factura:</label>
  <select class="btn btn-outline-success" id="tipoFactura" name="tipoFactura">
  <option value="consumidor">Consumidor Final</option>
  <option value="monotributista">Monotributista</option>
  <option value="responsable">Responsable Inscripto</option>
  <option value="sujetoexento">Sujeto Exento </option>
  </select>

  <label for="formaPago">Forma de pago:</label>
  <select class="btn btn-outline-success" id="formaPago" name="formaPago">
  <option value="efectivo">Efectivo</option>
  <option value="tarjeta">Tarjeta de credito</option>
  <option value="transferencia">Transferencia Bancaria</option>
  </select>

</div>

<br>

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

<div class="d-grid gap-2 col-6 mx-auto">
 <h4>Monto Pagado</h4>
 <input type="int" placeholder="$">

 <h4>Total</h4>
 <input type="int" placeholder="$">

 <h4>Monto impuestos</h4>
 <input type="int" placeholder="$">

 <h4>Porcentaje impuestos</h4>
 <input type="int" placeholder="%">
 
 <div class="mb-3">
  <label for="observacion" class="form-label">Observaciones</label>
  <textarea class="form-control" id="observacion" rows="3"></textarea>
 </div>

 <h4>Cambio</h4>
 <input type="int" placeholder="$">

 <button class="btn btn-agregar">Generar Factura</button>
</div>


                        
</body>
</html>