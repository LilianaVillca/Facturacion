<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            background: #ddd;
            padding: 40px;
        }

        textarea {
            width: 100% !important;
            border: 1px solid #ddd !important;
        }

        .container {
            min-height: 29.7cm;
            margin: auto;
        }

        .invoice {
            background: #fff;
            width: 100%;
            padding: 50px;
        }

        .logo {
            width: 2.5cm;
        }

        .document-type {
            text-align: right;
            color: #444;
        }

        .conditions {
            font-size: 0.7em;
            color: #666;
        }

        .bottom-page {
            font-size: 0.7em;
        }

        table {
            font-size: 12px !important;
        }

        table td {
            padding: 0.45rem !important;
        }

        table td {
            font-size: 15px;
        }


        @media print {

            [data-editable="true"] {
                border: none !important
            }

            .invoice {
                display: block;
            }

            .hide-elements {
                display: none;
            }

            @page {
                size: auto;
                /* auto is the initial value */
                margin: 30px 0;
                /* this affects the margin in the printer settings */
            }

            .container {
                width: 100% !important;
            }

            .invoice {
                font-size: 13px !important;
                color: black !important;
                padding: 0 !important;
            }

            .btn {
                display: none;
            }



            #logoForm {
                display: none;
            }

            table td {
                padding: 0.45rem !important;
            }

            .table> :not(caption)>*>* {
                color: black !important;
                font-size: 10px !important;
            }


            body {
                margin: 0;
                /* Remove default body margin */
                padding: 0;
                /* Remove default body padding */
            }

            textarea {
                resize: none;
            }
        }

        .editable {
            cursor: pointer;
        }

        .transparent-input {
            border: none;
            background: transparent;
            outline: none;
        }

        .text-right {
            text-align: right
        }

        .flex-container {
            display: flex;
        }

        [data-editable="true"] {
            border: 1px dashed #ddd;
            padding: 5px;
        }
    </style>
</head>

<body>
    <div class="flex-container">

        <!-- invoice generator -->
        <section style="flex-grow: 4;">
            <div class="container">

                <div class="invoice" id="invoice-container">
                    <div class="row">
                        <div class="col-7">
                            <img alt="Logo" id="uploadedLogo" src="https://fakeimg.pl/600x400?text=Logo" class="logo">
                            <form id="logoForm">
                                <input type="file" accept="image/*" id="logoInput" onchange="handleLogoChange()">
                            </form>

                        </div>
                        <div class="col-5">
                            <h1 class="document-type display-4">
                                <div data-editable="true">FACTURE</div>
                            </h1>
                            <div class="text-right" data-editable="true">N°90T-17-01-0123</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-7">
                            <p>
                            <div data-editable="true">90TECH SAS</div><br>
                            <div data-editable="true">
                                6B Rue Aux-Saussaies-Des-Dames <br> 57950 MONTIGNY-LES-METZ
                            </div>

                            </p>
                        </div>
                        <div class="col-5" style="text-align: right;">
                            <br><br><br>
                            <p>
                            <div data-editable="true">
                                Energies54 <br>
                                Réf. Client C00022 <br>
                                12 Rue de Verdun <br>
                                54250 JARNY</div>
                            </p>
                        </div>
                    </div>
                    <br>
                    <br>
                    <h6>
                        <div data-editable="true">Audits et rapports mensuels (1er Novembre 2016 - 30 Novembre 2016)</div>
                    </h6>
                    <br>
                    <table id="table" class="table table-striped">
                        <thead>
                            <tr>
                                <th data-editable="true">Description</th>
                                <th data-editable="true">Quantité</th>
                                <th data-editable="true">Unité</th>
                                <th data-editable="true">PU HT</th>
                                <th data-editable="true">TVA</th>
                                <th data-editable="true">Total HT</th>
                                <th class="hide-elements">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <span data-editable="true">Audits et rapports mensuels</span>
                                </td>
                                <td class="text-right">
                                    <span data-editable="true" data-field="quantity" data-editable-type="number">1</span>
                                </td>
                                <td>Jour</td>
                                <td class="text-right">
                                    <span data-editable="true" data-field="pu-ht" data-editable-type="number">500</span><span
                                        class="currency">€</span>
                                </td>
                                <td class="text-right">
                                    <span data-editable="true" data-field="tva" data-editable-type="number">20</span>%
                                </td>
                                <td class="text-right">
                                    <span data-editable="true" data-field="total-ht" data-editable-type="number">500</span>
                                    <span class="currency">€
                                    </span>
                                </td>
                                <td class="text-right hide-elements">
                                    <button class="btn btn-sm btn-danger" onclick="deleteRow(this)">-</button>
                                </td>

                            </tr>

                        </tbody>

                    </table>
                    <button class="btn btn-xs btn-success" onclick="addNewRow()">+</button>

                    <div class="row">
                        <div class="col-8">
                        </div>
                        <div class="col-4">
                            <table class="table table-sm text-right">
                                <tbody>
                                    <tr>
                                        <td><strong>Total HT</strong></td>
                                        <td class="text-right" id="total-ht">3 700,00 <span class="currency">€</span> </td>
                                    </tr>
                                    <tr>
                                        <td>TVA 20%</td>
                                        <td class="text-right" id="total-tva">740,00 <span class="currency">€</span> </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Total TTC</strong></td>
                                        <td class="text-right" id="total-ttc">4 440,00 <span class="currency">€</span> </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <p class="conditions">
                    <div data-editable="true">
                        En votre aimable règlement
                        Et avec nos remerciements. <br>
                        Conditions de paiement : paiement à réception de facture, à 15 jours. <br>
                        Aucun escompte consenti pour règlement anticipé. <br>
                        Règlement par virement bancaire. <br>

                        En cas de retard de paiement, <br> indemnité forfaitaire pour frais de recouvrement : 40 euros (art. L.4413
                        et L.4416s
                        code du commerce).

                    </div>
                    </p>

                    <br>
                    <br>
                    <br>
                    <br>

                    <p class="bottom-page text-right">
                    <div data-editable="true">
                        90TECH SAS - N° SIRET 80897753200015 RCS METZ <br>
                        6B, Rue aux Saussaies des Dames - 57950 MONTIGNY-LES-METZ 03 55 80 42 62 - www.90tech.fr <br>
                        Code APE 6201Z - N° TVA Intracom. FR 77 808977532 <br>
                        IBAN FR76 1470 7034 0031 4211 7882 825 - SWIFT CCBPFRPPMTZ <br>
                    </div>

                    </p>
                </div>
            </div>
        </section>

        <!-- settings -->
        <section class="hide-elements" style="flex-grow: 2;">
            <h4 class="text-center">Settings</h4>
            <table class="table">
                <tbody>
                    <tr>
                        <td><strong>Currency:</strong></td>
                        <td>
                            <select onchange="getSelectedCurrency()" id="select-currency" class="form-select">
                                <option value="$">USD</option>
                                <option value="€">EUR</option>
                                <option value="£">GBP</option>
                                <!-- Add more currency options as needed -->
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <button class="btn btn-success btn-block" onclick="printInvoice()">Print Invoice</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>


    </div>

    <script>
        // Get the parent div
        var parentDiv = document.getElementById("invoice-container");
        const currency = getSelectedCurrency()

        calculateTotals()
        // Add click event listener to the parent div
        parentDiv.addEventListener("click", function(event) {
            //editable element
            if (event.target.getAttribute("data-editable")) {

                const editableDiv = event.target;

                if (event.target.getAttribute("data-editable-type") && event.target.getAttribute("data-editable-type") == "number") {

                    // Create an input element
                    var inputElement = document.createElement("input");

                    // Set input properties
                    inputElement.type = "number";
                    var divWidth = event.target.offsetWidth;
                    divWidth += (divWidth * 0.8)
                    inputElement.style.width = divWidth + "px";
                    inputElement.value = editableDiv.innerText;
                    inputElement.className = "transparent-input,text-right";
                    // Replace the div with the input
                    editableDiv.replaceWith(inputElement);

                } else {

                    // Create an input element
                    var inputElement = document.createElement("textarea");

                    // Set input properties
                    var divHeight = event.target.offsetHeight;
                    inputElement.style.height = divHeight + "px !importat";
                    var divWidth = event.target.offsetWidth;
                    divWidth += (divWidth)
                    inputElement.style.width = divWidth + "px";
                    inputElement.value = editableDiv.innerText;
                    inputElement.className = "transparent-input,text-right";
                    // Replace the div with the input
                    editableDiv.replaceWith(inputElement);

                }

                // Add event listener to handle editing completion
                inputElement.addEventListener("blur", function() {
                    event.target.innerText = inputElement.value;
                    inputElement.replaceWith(event.target);
                    calculateTotals()
                });

                // Focus on the input for immediate editing
                inputElement.focus();
            }
        });


        function calculateTotals() {
            console.log('calculateTotals triggered')
            // Get all rows in the table body
            var tableRows = document.querySelectorAll('#table tbody tr');

            // Initialize total HT, total TVA, and total TTC
            var totalHT = 0;
            var totalTVA = 0;
            var totalTTC = 0;

            // Loop through each row
            tableRows.forEach(function(row) {
                // Get relevant cells in the row
                var quantityCell = row.querySelector('[data-field="quantity"]');
                var puHTCell = row.querySelector('[data-field="pu-ht"]');
                var tvaCell = row.querySelector('[data-field="tva"]');
                var totalHTCell = row.querySelector('[data-field="total-ht"]');

                if (quantityCell && puHTCell && tvaCell && totalHTCell) {
                    // Extract numeric values from cells
                    var quantity = parseFloat(quantityCell.textContent);
                    var puHT = parseFloat(puHTCell.textContent);
                    var tvaPercentage = parseFloat(tvaCell.textContent);
                    var totalHTValue = parseFloat(totalHTCell.textContent);

                    // Calculate total HT for the current row
                    var rowTotalHT = quantity * puHT;

                    totalHTCell.innerText = rowTotalHT
                    // Update total HT, total TVA, and total TTC
                    totalHT += rowTotalHT;
                    totalTVA += rowTotalHT * (tvaPercentage / 100);
                    totalTTC += rowTotalHT * (1 + tvaPercentage / 100);
                }

            });

            // Display the calculated totals
            document.getElementById('total-ht').innerText = totalHT.toFixed(2) + currency
            document.getElementById('total-tva').innerText = totalTVA.toFixed(2) + currency
            document.getElementById('total-ttc').innerText = totalTTC.toFixed(2) + currency

        }


        function addNewRow() {
            // Get the table body
            var tableBody = document.querySelector('#table tbody');

            // Create a new row
            var newRow = tableBody.insertRow();

            // Array of column values for the new row
            var columnValues = ['New Description', 1, 'Unit', 0, 0, 0];


            // Loop through each column and create cells
            for (var i = 0; i < columnValues.length; i++) {
                var cell = newRow.insertCell(i);

                var span = document.createElement('span');

                switch (i) {

                    case 0:
                        span.setAttribute('data-field', 'description')
                        break;

                    case 1:
                        span.setAttribute('data-field', 'quantity')
                        break;

                    case 2:
                        span.setAttribute('data-field', 'unity')
                        break;

                    case 3:
                        span.setAttribute('data-field', 'pu-ht')
                        break;

                    case 4:
                        span.setAttribute('data-field', 'tva')
                        break;

                    case 5:
                        span.setAttribute('data-field', 'total-ht')
                        break;


                    default:
                        break;
                }

                // Create editable content (input for numbers, div for other columns)
                if (i === 1 || i === 3 || i === 4 || i === 5) {
                    cell.className = 'text-right'
                    span.setAttribute('data-editable-type', 'number');
                    span.setAttribute('data-editable', 'true');
                    span.innerText = columnValues[i]
                    cell.appendChild(span);

                    cell.addEventListener('change', function() {
                        calculateTotals();
                    });

                    if (i == 4) {
                        var perCentSpan = document.createElement('span');
                        perCentSpan.innerText = '%'
                        cell.appendChild(perCentSpan);


                    }

                    if (i == 3 || i == 5) {
                        var currencySpan = document.createElement('span');
                        currencySpan.innerText = currency
                        cell.appendChild(currencySpan);
                    }
                } else {
                    span.textContent = columnValues[i];
                    span.setAttribute('data-editable', 'true');
                    cell.appendChild(span);
                }
            }

            var actionCell = newRow.insertCell(6);
            actionCell.className = 'text-right'
            var button = document.createElement('button');
            button.className = 'btn btn-sm btn-danger'
            button.innerText = '-'
            actionCell.appendChild(button);

            actionCell.addEventListener('click', function(e) {
                deleteRow(e.target);
            });

            calculateTotals()
        }

        function deleteRow(button) {
            const row = button.closest('tr');
            row.remove();
            calculateTotals();
        }



        function handleLogoChange() {
            const logoInput = document.getElementById('logoInput');
            const uploadedLogo = document.getElementById('uploadedLogo');

            const file = logoInput.files[0];

            if (file) {
                // Use FileReader to read the selected file
                const reader = new FileReader();

                reader.onload = function(e) {
                    // Set the source of the image to the base64-encoded content of the file
                    uploadedLogo.src = e.target.result;
                };

                // Read the file as a data URL
                reader.readAsDataURL(file);
            }
        }


        function printInvoice() {
            window.print()
        }

        function getSelectedCurrency() {
            console.log('getSelectedCurrency triggred')
            // Get the select element
            var selectElement = document.getElementById("select-currency");

            // Get the selected index
            var selectedIndex = selectElement.selectedIndex;

            // Get the selected option element
            var selectedOption = selectElement.options[selectedIndex];

            // Log the selected option value and text
            console.log("Selected Value: " + selectedOption.value);

            document.querySelector('.currency').innerText = selectedOption.value

            return selectedOption.value
        }
    </script>
</body>

</html>