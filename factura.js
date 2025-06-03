
function abrirRecuadro() {
    var recuadro = document.getElementById("recuadro");
    recuadro.style.display = "block";
}

function cerrarRecuadro() {
    var recuadro = document.getElementById("recuadro");
    recuadro.style.display = "none";
}

function abrirRecuadroo() {
    var recuadro = document.getElementById("recuadro");
    recuadro.style.display = "block";
}

///////////////////////////////// Evento de clic para buscar cliente por DNI////////////////////////////////////////////////////////////
// document.getElementById('buscarClienteBtn').addEventListener('click', async function () {
//     const clienteDni = document.getElementById('dni').value;

//     // if (!clienteDni) {
//     //     alert("Por favor ingresa el DNI del cliente.");
//     //     return;
//     // }

//     try {
//         const response = await fetch('../controlador/cliente.php', {
//             method: 'POST',
//             headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
//             body: new URLSearchParams({ dni: clienteDni })
//         });

//         const data = await response.json();

//         if (data.error) throw new Error(data.error);

//         document.getElementById('clienteInfo').style.display = 'block';
//         document.getElementById('nombreCliente').innerText = data.nombre;
//         document.getElementById('direcionCliente').innerText = data.domicilio;
//         document.getElementById('telefonoCliente').innerText = data.celular;
//     } catch (error) {
//         console.error('Error:', error);
//         alert('Ha ocurrido un error al buscar el cliente.');
//     }
// });

///////////////////////////////// Evento de clic para buscar cliente por DNI////////////////////////////////////////////////////////////
document.getElementById('buscarClienteBtn').addEventListener('click', async function (e) {
    e.preventDefault(); // Evita el comportamiento predeterminado del botón

    const clienteDni = document.getElementById('dni').value;

    if (!clienteDni) {
        alert("Por favor ingresa el DNI del cliente.");
        return;
    }

    try {
        const response = await fetch('../controlador/cliente.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({ dni: clienteDni })
        });

        const data = await response.json();

        if (data.error) throw new Error(data.error);

        // Mostrar la información del cliente
        document.getElementById('clienteInfo').style.display = 'block';
        document.getElementById('nombreCliente').innerText = data.nombre;
        document.getElementById('apellidoCliente').innerText = data.apellido;
        document.getElementById('direcionCliente').innerText = data.domicilio;
        document.getElementById('telefonoCliente').innerText = data.celular;

        // Habilitar el botón de "Generar Factura"
        document.getElementById('guardarFactura').disabled = false;

    } catch (error) {
        console.error('Error:', error);
        alert('Ha ocurrido un error al buscar el cliente.');
    }
});

// Desactivar el botón de "Generar Factura" al inicio
document.getElementById('guardarFactura').addEventListener('click', function (e) {
    if (document.getElementById('guardarFactura').disabled) {
        e.preventDefault();
        alert("Por favor, selecciona o crea un cliente antes de generar la factura.");
    }
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


// $(document).ready(function () {
//     // Marcar todos los ítems
//     $(document).on('click', '#checkAll', function () {
//         $(".fila").prop("checked", this.checked);
//     });

//     // Control de marcado de ítems
//     $(document).on('click', '.fila', function () {
//         $('#checkAll').prop('checked', $('.fila:checked').length === $('.fila').length);
//     });

//     var count = 1; // Inicializa el contador de filas

//     // Ambas funciones de agregar filas funcionan y toman la funcion de buscar productos
//     $(document).on('click', '.btn.custom-btn', function (e) {
//         e.preventDefault();
//         if ($(this).text().includes("Agregar")) {
//             count++;
//             var htmlRows = '<tr>';
//             htmlRows += '<td><input class="fila" type="checkbox"></td>';
//             htmlRows += '<td><input type="number" name="codigoProducto[]" id="codigoProducto_' + count + '" class="form-control" autocomplete="off"></td>';
//             htmlRows += '<td><input type="text" name="nombreProducto[]" id="nombreProducto_' + count + '" class="form-control" autocomplete="off"></td>';
//             htmlRows += '<td><input type="number" name="cantidad[]" id="cantidad_' + count + '" class="form-control cantidad" autocomplete="off"></td>';
//             htmlRows += '<td><input type="number" name="precio[]" id="precio_' + count + '" class="form-control precio" autocomplete="off"></td>';
//             htmlRows += '<td><input type="number" name="total[]" id="total_' + count + '" class="form-control total" readonly></td>'; // Total será solo de lectura
//             htmlRows += '</tr>';
//             $('#tbodyFacturas').append(htmlRows);
//         } else if ($(this).text().includes("Eliminar")) {
//             $(".fila:checked").each(function () {
//                 $(this).closest('tr').remove();
//             });
//             calculateTotal(); // Recalcular totales después de eliminar
//         }
//     });

//     // Calcular total al cambiar cantidad o precio
//     $(document).on('blur', "[id^=cantidad_], [id^=precio_]", function () {
//         calculateRowTotal($(this)); // Calcula total de la fila correspondiente
//         calculateTotal(); // Calcula total general
//     });
//      // Calcular impuestos y cambio al actualizar campos relevantes
//      $(document).on('blur', "#porcentajeImpuestos", function () {
//         calculateTotal();
//     });
//     $(document).on('blur', "#montoPagado", function () {
//         calculateChange(parseFloat($('#totalFinal').val())); // Actualiza cambio en función del monto pagado
//     });

// });

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

    // Función para agregar y eliminar filas
    $(document).on('click', '.btn.custom-btn', function () {
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

    // Validación o manejo antes de enviar el formulario (opcional)
    $('form').on('submit', function (e) {
        // Si necesitas hacer validaciones antes de enviar el formulario
        // y no interrumpir el flujo, solo asegúrate de que todo esté listo
        // para el envío, sin evitar el comportamiento predeterminado del formulario.
        if (!validateForm()) {
            e.preventDefault(); // Esto solo se activará si hay un error en la validación
            alert("Formulario incompleto.");
        }
    });
});

// Función para calcular el total de la fila
function calculateRowTotal(element) {
    var row = $(element).closest('tr');
    var cantidad = parseFloat(row.find('.cantidad').val()) || 0;
    var precio = parseFloat(row.find('.precio').val()) || 0;
    var total = cantidad * precio;
    row.find('.total').val(total.toFixed(2)); // Redondear el total de la fila
}

// Función para calcular el total general
function calculateTotal() {
    var totalGeneral = 0;
    $(".total").each(function () {
        totalGeneral += parseFloat($(this).val()) || 0;
    });
    $('#totalFinal').val(totalGeneral.toFixed(2)); // Asignar el total general
}

// Función para calcular el cambio
function calculateChange(total) {
    var montoPagado = parseFloat($('#montoPagado').val()) || 0;
    var cambio = montoPagado - total;
    $('#cambio').val(cambio.toFixed(2)); // Asignar el cambio
}

// Función de validación (opcional)
function validateForm() {
    // Aquí puedes agregar validaciones si es necesario, como asegurarte
    // de que todos los campos estén completos, que los totales sean correctos, etc.
    return true; // Retorna true si todo es válido
}


// // Función para calcular total de cada fila
function calculateRowTotal(element) {
    var row = element.closest('tr'); // Obtiene la fila más cercana
    var quantity = row.find("input[id^='cantidad_']").val();
    var price = row.find("input[id^='precio_']").val();

    var total = quantity * price;
    row.find("input[id^='total_']").val(total.toFixed(2)); // Actualiza total de la fila

}

// // Función para calcular el total general
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

// // Función para calcular impuestos
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
// // Función para eliminar filas
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
