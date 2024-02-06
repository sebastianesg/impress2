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
            <h1 class="mb-2">{{ $mode === 'create' ? 'Crear' : 'Editar' }} nuevo pedido</h1>
            <form class="form form-vertical needs-validation" action="{{ $mode === 'create' ? route('orders.store') : route('orders.update', $order->id) }}" method="POST" novalidate>
                @csrf
                @if ($mode === 'edit')
                    @method('PUT')
                @endif
                <input type="hidden" name="product_data" id="product_data">
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
                    <div class="col-sm-3">
                        <label for="payment_method">Método de Pago:</label>
                        <select class="form-control" name="payment_method" id="payment_method">
                            <option value="0" {{ ($order ?? null) && $order->payment_method === 0 ? 'selected' : '' }}>Efectivo</option>
                            <option value="1" {{ ($order ?? null) && $order->payment_method === 1 ? 'selected' : '' }}>Tarjeta de Debito</option>
                            <option value="2" {{ ($order ?? null) && $order->payment_method === 2 ? 'selected' : '' }}>Tarjeta de Crédito</option>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <label for="payment_method">Método de Contacto:</label>
                        <select class="form-control" name="payment_method" id="payment_method">
                            <option value="0" {{ ($order ?? null) && $order->contact_method === 0 ? 'selected' : '' }}>Wsp</option>
                            <option value="1" {{ ($order ?? null) && $order->contact_method === 1 ? 'selected' : '' }}>Instagram</option>
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
                <div class="row">
                    <div class="form-group col-sm-9">
                        <label for="products">Productos:</label>
                        <select class="form-control product-select" name="products[]"></select>
                    </div>
                    <div class="form-group col-sm-2">
                        <button type="button" class="btn btn-primary mt-2" id="addProductToTableDirect">Agregar producto

                        </button>
                    </div>
                </div>
                <table class="table" id="productTable">
    <thead>
        <tr>
            <th>Producto</th>
            <th>Precio</th>
            <th>Acciones</th>
            <th style="display:none;">ID</th> <!-- Nueva columna oculta para el ID -->
        </tr>
    </thead>
    <tbody>
        <!-- Aquí se agregarán las filas de productos -->
    </tbody>
</table>
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
                            <textarea placeholder="Descripcion" name="order_details" id="order_details" class="form-control" rows="3">{{ $order->order_details ??  old('order_details', '') }}</textarea>
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
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Volver</a>
                        <button type="submit" class="btn btn-primary">
                            {{ $mode === 'create' ? 'Crear Orden' : 'Editar Orden' }}
                        </button>
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
$('#productTable').on('click', '.remove-product', function() {
        $(this).closest('tr').remove();
        updateTotal();
    });

    $('#addProductToTableDirect').on('click', function() {
    var selectedProduct = $('.product-select, .combo-select').select2('data')[0];

    if (selectedProduct) {
        console.log(selectedProduct);
        if (selectedProduct.type === 'combo') {
            // Agregar productos del combo a la tabla
            $.each(selectedProduct.products, function(index, product) {
                $('#productTable tbody').append('<tr><td>' + product.name + '</td><td>' + product.price + '</td><td><button type="button" class="btn btn-danger btn-sm remove-product">Eliminar</button></td><td style="display:none;">' + product.id + '</td></tr>');
            });

            // Agregar la línea de descuento por combo
            $('#productTable tbody').append('<tr><td>Descuento por Combo</td><td>' + selectedProduct.descuento + '</td><td><button type="button" class="btn btn-danger btn-sm remove-product">Eliminar</button></td><td style="display:none;"></td></tr>');
        } else {
            // Agregar producto a la tabla
            $('#productTable tbody').append('<tr><td>' + selectedProduct.text + '</td><td>' + selectedProduct.price + '</td><td><button type="button" class="btn btn-danger btn-sm remove-product">Eliminar</button></td><td style="display:none;">' + selectedProduct.id + '</td></tr>');
        }

        // Limpiar el valor seleccionado en el select2
        $('.product-select, .combo-select').val(null).trigger('change');

        // Actualizar el total y la seña
        updateTotal();
    }
});
    $('.product-select').select2({
        placeholder: 'Cargando productos...',
    });

    $.ajax({
    url: '{{ route("products.api") }}',
    dataType: 'json',
    success: function(data) {
        console.log(data);
        // Procesar los resultados para el formato de Select2
        var formattedData = $.map(data.products, function(product) {
            return {
                id: product.id,
                text: 'Producto: ' + product.name + ' - $' + product.price,
                price: product.price,
                type: 'product'
            };
        });

        var formattedCombos = $.map(data.combos, function(combo) {
            return {
                id: combo.id,
                text: 'Combo: ' + combo.name + ' - $' + combo.price,
                price: combo.price,
                descuento: combo.descuento,
                type: 'combo',
                products: combo.products // Array de productos en el combo
            };
        });

        // Combinar productos y combos en un solo array
        var combinedData = formattedData.concat(formattedCombos);

        // Inicializar select2 con los datos cargados
        $('.product-select').select2({
            placeholder: 'Seleccione un producto o combo',
            data: combinedData
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