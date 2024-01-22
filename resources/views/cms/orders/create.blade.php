@extends('cms/layouts/contentLayoutMaster')

@section('title', 'Pedido')

@section('vendor-style') {{-- Page Css files --}} @endsection

@section('page-style'){{-- Page Css files --}} @endsection


@section('content')
<section class="inner-block">
    <div class="card">
        <div class="card-body">
            @if ($variable ?? false)
                <div class="alert alert-dark">
                    <div class="alert-body">Faltan completar datos obligatorios</div>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        <!-- Recorre los errores y muéstralos en una lista -->
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <h1 class="mb-2">Crear nuevo pedido</h1>
            <form class="form form-vertical needs-validation" action="{{ $mode === 'create' ? route('orders.store') : route('orders.update', $order->id) }}" method="POST" novalidate>
                @csrf
                @if ($mode === 'edit')
                    @method('PUT')
                @endif
                <h4 class="fw-bolder border-bottom pb-50 mb-1">Pedidos</h4>
                <div class="row">
                    <div class="col-sm-6">
                        <label for="client_id">Cliente:</label>
                        <select class="form-control" name="client_id" id="client_id">
                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}" {{ ($order ?? null) && $order->client_id == $client->id ? 'selected' : '' }}>
                                    {{ $client->full_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <label for="realizer_id">Encargado de Realizar:</label>
                        <select class="form-control" name="realizer_id" id="realizer_id">
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ ($order ?? null) && $order->realizer_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label for="shipper_id">Encargado de Envío:</label>
                        <select class="form-control" name="shipper_id" id="shipper_id">
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ ($order ?? null) && $order->shipper_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div id="product-lines">
                    @if($mode === 'edit' && $order->products->isNotEmpty())
                        @foreach ($order->products as $product)
                            <div class="row">
                                <div class="form-group col-sm-9">
                                    <label for="products">Productos:</label>
                                    <select class="form-control product-select" name="products[]" data-price="{{ $product->price }}">
                                        <option value="{{ $product->id }}" selected>{{ $product->name }}</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="selected_price">Precio Seleccionado:</label>
                                    <input type="text" class="form-control" value="{{ $product->price }}" readonly>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="row">
                    <div class="col-sm-9">
                        <div class="mb-1">
                            <label class="form-label" for="description">Descripcion</label>
                            <textarea placeholder="Descripcion" name="order_details" id="description" class="form-control" rows="3">{{ $product->description ?? old('description', '') }}</textarea>
                        </div>
                    </div>
                <div class="col-sm-3">
                        <div class="mb-1">
                            <label class="form-label" for="description">Total</label>
                            <input placeholder="Total" name="total" id="total_price" class="form-control" type="number">
                        </div>
                        <div class="mb-1">
                            <label class="form-label" for="description">Seña</label>
                            <input placeholder="Seña" name="senia" id="senia" class="form-control" type="number">
                        </div>
                    </div>
                </div>
                <div class="row row-last">
                    <div class="col-12 d-flex justify-content-end">
                        <button type="button" class="btn btn-success" id="addProduct">Agregar Producto</button>
                        <button type="button" class="btn btn-info mt-1" id="addCustomProduct">Agregar Producto Personalizado</button>
                        <button type="submit" class="btn btn-primary">Crear Orden</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
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
    var quantity = parseFloat($(this).val()) || 0;
    var pagePrice = parseFloat('{{ $pagePrice }}') || 0;
    var newPrice = quantity * pagePrice;
    $('#cPrice' + index).val(newPrice.toFixed(2));
    updateTotal();
});

    $('.product-select').select2({
        placeholder: 'Seleccione un producto',
        ajax: {
            url: '{{ route("products.api") }}',
            dataType: 'json',
            processResults: function (data) {
                return {
                    results: $.map(data.products, function(product) {
                        return {
                            id: product.id,
                            text: product.name + ' - $' + product.price,
                            price: product.price
                        };
                    })
                };
            }
        }
    });

    $('.product-select').on('change', function (e) {
        var selectedPrice = $(this).select2('data')[0].price;
        updateTotal(selectedPrice);
    });

    $('#addCustomProduct').on('click', function () {
    var customProductLine = '<div class="row">' +
                              '<div class="col-sm-6">' +
                                  '<label for="custom_link">Link:</label>' +
                                  '<input type="text" class="form-control" name="custom_links[]" id="cProduct'+customIndex+'">' +
                              '</div>' +
                              '<div class="col-sm-3">' +
                                  '<label for="custom_quantity">Cantidad de Hojas:</label>' +
                                  '<input type="number" class="form-control" name="custom_quantities[]" id="cQuantity'+customIndex+'">' +
                              '</div>' +
                              '<div class="col-sm-3">' +
                                  '<label for="custom_price">Precio:</label>' +
                                  '<input type="text" class="form-control price" name="custom_prices[]" id="cPrice'+customIndex+'" readonly>' +
                              '</div>' +
                            '</div>';

    // Añadir la línea de productos personalizados
    $('#product-lines').append(customProductLine);
    customIndex=customIndex+1;
    // Obtener el nuevo input para el precio en la nueva línea de productos personalizados
    var newPriceInput = $('[name="custom_prices[]"]').last();

    // Simular una actualización de precio (ajusta según tu lógica)
    updateCustomPrice(newPriceInput);
});

    $('#addProduct').on('click', function () {
        var productLine = '<div class="row">' +
                            '<div class="form-group col-sm-9">' +
                                '<label for="products">Productos:</label>' +
                                '<select class="form-control product-select" name="products[]"></select>' +
                            '</div>' +
                            '<div class="form-group col-sm-3">' +
                                '<label for="selected_price">Precio Seleccionado:</label>' +
                                '<input type="text" class="form-control price" readonly>' +
                            '</div>' +
                          '</div>';

        // Añadir la línea de productos
        $('#product-lines').append(productLine);

        // Obtener el nuevo select2 para la nueva línea de productos
        var newSelect = $('.product-select').last().select2({
            placeholder: 'Seleccione un producto',
            ajax: {
                url: '{{ route("products.api") }}',
                dataType: 'json',
                processResults: function (data) {
                    return {
                        results: $.map(data.products, function(product) {
                            return {
                                id: product.id,
                                text: product.name + ' - $' + product.price,
                                price: product.price
                            };
                        })
                    };
                }
            }
        });

        // Obtener el nuevo input para la nueva línea de productos
        var newInput = newSelect.closest('.row').find('.form-group.col-sm-3 input');

        // Configurar evento de cambio en el nuevo select2
        newSelect.on('change', function (e) {
            var selectedPrice = $(this).select2('data')[0].price;
            
            newInput.val(selectedPrice);
            updateTotal(selectedPrice);
        });
    });

    function updateTotal() {
    var totalField = $('#total_price');
    var newTotal = 0;
    $('.price').each(function() {
        var priceValue = parseFloat($(this).val()) || 0;
        newTotal += priceValue;
    });

    totalField.val(newTotal.toFixed(2));
}

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

    // Obtener el precio del PDF desde la URL (¡Reemplaza la URL con la tuya!)
    function getPdfPrice() {
        // ¡Ajusta la URL según tu implementación!
        var apiUrl = '{{ route("getPdfPrice") }}';

        // Hacer una solicitud AJAX para obtener el precio
        $.ajax({
            url: apiUrl,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                // En este ejemplo, asumimos que la respuesta es el precio
                console.log(data.price);
                return 10;
            },
            error: function() {
                // Manejar errores aquí si es necesario
                console.error('Error al obtener el precio del PDF.');
                return 0;
            }
        });
    }
});
</script>