@extends('cms/layouts/contentLayoutMaster')

@section('title', 'Pedido')

@section('vendor-style') {{-- Page Css files --}} @endsection

@section('page-style'){{-- Page Css files --}} @endsection


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h1>Crear Combo</h1>

                <form action="{{ route('combos.store') }}" method="POST">
                    @csrf

                    @isset($method)
                        @method($method)
                    @endisset

                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre:</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $combo->name ?? '') }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a href="{{ route('combos.index') }}" class="btn btn-secondary">Cancelar</a>

                    <div class="mt-4">
                        <h2>Agregar Productos al Combo</h2>
                        <div class="row">
                            <div class="form-group col-sm-9">
                                <label for="products">Productos:</label>
                                <select class="form-control product-select" name="products[]"></select>
                            </div>
                            <div class="form-group col-sm-2">
                                <button type="button" class="btn btn-primary mt-2" id="addProductToTableDirect">Agregar producto</button>
                            </div>
                        </div>

                        <table class="table" id="productTable">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Precio</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Aquí se agregarán las filas de productos -->
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js"></script>
<script>
$(document).ready(function() {
    var totalField = $('#total_price');
    var customIndex =0;
    $('#client_id').select2();
    $(document).on('change', 'input[id^="cQuantity"]', function() {
    console.log($(this));
    var index = $(this).attr('id').match(/\d+/)[0];

    $('#cPrice' + index).val(newPrice.toFixed(2));
    updateTotal();
});
$('#productTable').on('click', '.remove-product', function() {
        $(this).closest('tr').remove();
        updateTotal();
    });

$('#addProductToTableDirect').on('click', function() {
    var selectedProduct = $('.product-select').select2('data')[0];

    if (selectedProduct) {
        // Agregar fila a la tabla
        $('#productTable tbody').append('<tr><td>' + selectedProduct.text + '</td><td>' + selectedProduct.price + '</td><td><button type="button" class="btn btn-danger btn-sm remove-product">Eliminar</button></td><td style="display:none;">' + selectedProduct.id + '</td></tr>');
        
        // Limpiar el valor seleccionado en el select2
        $('.product-select').val(null).trigger('change');
        
        // Actualizar el total y la seña
        updateTotal();
    }
});
    $('.product-select').select2({
        placeholder: 'Cargando productos...',
    });

    // Llamada a la API para obtener los productos
    $.ajax({
        url: '{{ route("products.api") }}',
        dataType: 'json',
        success: function(data) {
            // Procesar los resultados para el formato de Select2
            var formattedData = $.map(data.products, function(product) {
                return {
                    id: product.id,
                    text: product.name + ' - $' + product.price,
                    price: product.price
                };
            });

            // Inicializar select2 con los datos cargados
            $('.product-select').select2({
                placeholder: 'Seleccione un producto',
                data: formattedData
            });
        },
        error: function() {
            console.error('Error al cargar datos desde la API.');
            // Puedes manejar el error según tus necesidades
        }
    });


    function updateTotal() {
    var totalField = $('#total_price');
    var newTotal = 0;
    var productData = []; // Array para almacenar datos de productos

    $('#productTable tbody tr').each(function() {
        var productId = $(this).find('td:eq(3)').text(); // Obtener el ID de la columna oculta
        var productName = $(this).find('td:eq(0)').text(); // Obtener el nombre del producto
        var productPrice = parseFloat($(this).find('td:eq(1)').text()) || 0; // Obtener el precio

        // Agregar datos del producto al array
        productData.push({
            id: productId,
            name: productName,
            price: productPrice
        });

        newTotal += productPrice;
    });

    totalField.val(newTotal.toFixed(2));

    var senia = newTotal * 0.10;
    $('#senia').val(senia.toFixed(2));

    // Actualizar el campo oculto con los datos de la tabla en formato JSON
    $('#product_data').val(JSON.stringify(productData));
}
    $('#total_price').on('input', function () {
        var total = parseFloat($(this).val()) || 0;
        var senia = total * 0.10;
        $('#senia').val(senia.toFixed(2));
    });
    // Botón para agregar línea con archivo PDF
    $('#addPdfLine').on('click', function () {
        var pdfLine = '<div class="row">' +
                        '<div class="form-group col-sm-6">' +
                            '<label for="pdf_file">Archivo PDF:</label>' +
                            '<input type="file" class="form-control-file" name="pdf_files[]">' +
                        '</div>' +
                        '<div class="form-group col-sm-3">' +
                            '<label for="pdf_pages">Páginas:</label>' +
                            '<input type="text" class="form-control" readonly>' +
                        '</div>' +
                        '<div class="form-group col-sm-3">' +
                            '<label for="pdf_price">Precio:</label>' +
                            '<input type="text" class="form-control" readonly>' +
                        '</div>' +
                      '</div>';

        // Añadir la línea de PDF
        $('#product-lines').append(pdfLine);

        // Obtener el nuevo input para la nueva línea de PDF
        var newPdfPagesInput = $('.form-group.col-sm-6 input').last();
        var newPdfPriceInput = $('.form-group.col-sm-3 input').last();
        var totalPages = 0;
        // Configurar evento de cambio en el nuevo input de PDF
        newPdfPagesInput.on('change', function (e) {
            const file = e.target.files[0];

            if (file) {
            const fileURL = URL.createObjectURL(file);
            const loadingTask = pdfjsLib.getDocument(fileURL);
            loadingTask.promise
                .then(pdfDocument => {
                totalPages = pdfDocument.numPages;
                console.log(totalPages);
                })
                .catch(error => {
                console.error('Error al cargar el PDF:', error);
                });
            }
            newPdfPriceInput.val(totalPages*15);
        });
    });
    function getPdfPrice() {
        var apiUrl = '{{ route("getPdfPrice") }}';
        $.ajax({
            url: apiUrl,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                console.log(data.price);
                return 10;
            },
            error: function() {
                console.error('Error al obtener el precio del PDF.');
                return 0;
            }
        });
    }
    $(document).on('click', '.remove-product-line', function () {
        $(this).closest('.product-line').remove();
        updateTotal();
    });
});
</script>
@endsection