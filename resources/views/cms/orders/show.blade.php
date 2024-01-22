@extends('cms/layouts/contentLayoutMaster')

@section('title', 'Pedido')

@section('vendor-style') {{-- Page Css files --}} @endsection

@section('page-style'){{-- Page Css files --}} @endsection

@section('content')
    <div class="container">
        <h1>Pedido</h1>
        <p><strong>Encargado de Realizar:</strong> {{ $order->realizer->name }}</p>
        <p><strong>Encargado de Envío:</strong> {{ $order->shipper->name }}</p>
        <p><strong>Order Details:</strong> {{ $order->order_details }}</p>
        <p><strong>Total:</strong> ${{ $order->total }}</p>
        <p><strong>Estado:</strong> {{ $order->estado }}</p>
        <p><strong>Seña:</strong> {{ $order->senia }}</p>
        <h2>Productos</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Link</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>
                            <a href="{{ $product->link }}" target="_blank">{{ $product->link }}</a>
                        </td>
                    </tr>
                @endforeach
                @foreach ($order->custmoProducts as $cProduct)
                    <tr>
                        <td>Producto personalizado</td>
                        <td>
                            <a href="{{ $cProduct->path }}" target="_blank">{{ $cProduct->path }}</a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js"></script>
