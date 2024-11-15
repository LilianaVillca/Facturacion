
function abrirRecuadro() {
    var recuadro = document.getElementById("recuadro");
    recuadro.style.display = "block";
}

function cerrarRecuadro() {
    var recuadro = document.getElementById("recuadro");
    recuadro.style.display = "none";
}

///////////////////////////////// Evento de clic para buscar cliente por DNI////////////////////////////////////////////////////////////
document.getElementById('buscarClienteBtn').addEventListener('click', function () {
    const clienteDni = document.getElementById('dni').value;

    // Verificar que el DNI no esté vacío antes de hacer la solicitud
    if (!clienteDni) {
        alert("Por favor ingresa el DNI del cliente.");
        return;
    }

    // Realizar la petición AJAX
    fetch('../controlador/cliente.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
            dni: clienteDni,
        })
    })
        .then(response => response.json())
        .then(data => {
            // Verificar si hay un error en la respuesta
            if (data.error) {
                alert(data.error);
                return;
            }

            // Mostrar datos del cliente en la página
            document.getElementById('clienteInfo').style.display = 'block';
            document.getElementById('nombreCliente').innerText = data.nombre; // Campo 'nombre'
            document.getElementById('direcionCliente').innerText = data.domicilio; // Campo 'domicilio'
            document.getElementById('telefonoCliente').innerText = data.celular; // Campo 'celular'
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Ha ocurrido un error al buscar el cliente.');
        });
});

/////////////////////////////////////////////////// Evento para buscar producto en cada fila //////////////////////////////////////////////////////
$(document).on('blur', "[id^=codigoProducto_]", function () {
    const producto = $(this).val();
    const rowId = $(this).attr('id').split('_')[1]; // Obtenemos el número de la fila

    if (producto === '') {
        return;
    }

    fetch('../controlador/producto.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
            numeroProducto: producto,
        })
    })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert(data.error);
                return;
            }

            // Actualizamos los campos de nombre y precio para la fila correspondiente
            $('#nombreProducto_' + rowId).val(data.nombre); //descripcion_producto
            $('#precio_' + rowId).val(data.precio); //precio_producto
            calculateRowTotal($('#cantidad_' + rowId)); // Calcula el total de la fila después de actualizar el precio
            calculateTotal(); // Recalcula el total general
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Ha ocurrido un error al buscar el producto.');
        });
});

/////////////////////////////////////////////////////// Evento factura /////////////////////////////////////////////////////////////


$(document).ready(function () {
    // Marcar todos los ítems
    $(document).on('click', '#checkAll', function () {
        $(".fila").prop("checked", this.checked);
    });

    // Control de marcado de ítems
    $(document).on('click', '.fila', function () {
        $('#checkAll').prop('checked', $('.fila:checked').length === $('.fila').length);
    });

    var count = 1; // Inicializa el contador de filas

    // Ambas funciones de agregar filas funcionan y toman la funcion de buscar productos
    $(document).on('click', '.btn.custom-btn', function (e) {
        e.preventDefault();
        if ($(this).text().includes("Agregar")) {
            count++;
            var htmlRows = '<tr>';
            htmlRows += '<td><input class="fila" type="checkbox"></td>';
            htmlRows += '<td><input type="number" name="codigoProducto[]" id="codigoProducto_' + count + '" class="form-control" autocomplete="off"></td>';
            htmlRows += '<td><input type="text" name="nombreProducto[]" id="nombreProducto_' + count + '" class="form-control" autocomplete="off"></td>';
            htmlRows += '<td><input type="number" name="cantidad[]" id="cantidad_' + count + '" class="form-control cantidad" autocomplete="off"></td>';
            htmlRows += '<td><input type="number" name="precio[]" id="precio_' + count + '" class="form-control precio" autocomplete="off"></td>';
            htmlRows += '<td><input type="number" name="total[]" id="total_' + count + '" class="form-control total" readonly></td>'; // Total será solo de lectura
            htmlRows += '</tr>';
            $('#tbodyFacturas').append(htmlRows);
        } else if ($(this).text().includes("Eliminar")) {
            $(".fila:checked").each(function () {
                $(this).closest('tr').remove();
            });
            calculateTotal(); // Recalcular totales después de eliminar
        }
    });

    // Calcular total al cambiar cantidad o precio
    $(document).on('blur', "[id^=cantidad_], [id^=precio_]", function () {
        calculateRowTotal($(this)); // Calcula total de la fila correspondiente
        calculateTotal(); // Calcula total general
    });
     // Calcular impuestos y cambio al actualizar campos relevantes
     $(document).on('blur', "#porcentajeImpuestos", function () {
        calculateTotal();
    });
    $(document).on('blur', "#montoPagado", function () {
        calculateChange(parseFloat($('#totalFinal').val())); // Actualiza cambio en función del monto pagado
    });
    
});


// Función para calcular total de cada fila
function calculateRowTotal(element) {
    var row = element.closest('tr'); // Obtiene la fila más cercana
    var quantity = row.find("input[id^='cantidad_']").val();
    var price = row.find("input[id^='precio_']").val();

    var total = quantity * price;
    row.find("input[id^='total_']").val(total.toFixed(2)); // Actualiza total de la fila

}

// Función para calcular el total general
function calculateTotal() {
    var totalAmount = 0;
    $("#tbodyFacturas input[id^='total_']").each(function () {
        totalAmount += parseFloat($(this).val()) || 0; // Sumar todos los totales de las filas
    });
    $('#subTotal').val(totalAmount.toFixed(2)); // Actualiza subtotal
    calculateTaxes(totalAmount); // Calcula impuestos

     // Calcula el total final como subTotal + montoImpuestos
     var subTotal = parseFloat($('#subTotal').val()) || 0;
     var montoImpuestos = parseFloat($('#montoImpuestos').val()) || 0;
     var totalFinal = subTotal + montoImpuestos;
     $('#totalFinal').val(totalFinal.toFixed(2)); // Actualiza totalFinal
}

// Función para calcular impuestos
function calculateTaxes(subTotal) {
    var taxRate = $("#porcentajeImpuestos").val();
    if (taxRate) {
        var taxAmount = subTotal * (parseFloat(taxRate) / 100);
        $('#montoImpuestos').val(taxAmount.toFixed(2)); // Actualiza monto de impuestos
        var totalAftertax = subTotal + taxAmount;
        $('#total').val(totalAftertax.toFixed(2)); // Total después de impuestos
        calculateChange(totalAftertax); // Calcula cambio
    }
}
// Función para eliminar filas
function eliminarFila() {
    const tbody = document.getElementById('tbodyFacturas');
    const filas = tbody.querySelectorAll('tr');

    filas.forEach(fila => {
        const checkbox = fila.querySelector('.fila');
        if (checkbox && checkbox.checked) {
            tbody.removeChild(fila);
        }
    });
}


// //// guardra factura
document.getElementById('guardarFactura').addEventListener('click', function() {
    const idpproducto = document.getElementById('codigoProducto_1').value;

    // Verificar que el DNI no esté vacío antes de hacer la solicitud
    if (!idpproducto) {
        alert("Por favor un oroducto.");
        return;
    }

    // Realizar la petición AJAX
    fetch('./guardarFactura.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                dni: clienteDni,
            })
        })
        .then(response => response.json())
        .then(data => {
            // Verificar si hay un error en la respuesta
            if (data.error) {
                alert(data.error);
                return;
            }

            // Mostrar datos del cliente en la página
            document.getElementById('clienteInfo').style.display = 'block';
            document.getElementById('nombreCliente').innerText = data.nombre; // Campo 'nombre'
            document.getElementById('direcionCliente').innerText = data.domicilio; // Campo 'domicilio'
            document.getElementById('telefonoCliente').innerText = data.celular; // Campo 'celular'
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Ha ocurrido un error al buscar el cliente.');
        });
});
