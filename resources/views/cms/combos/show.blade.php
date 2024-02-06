@extends('cms/layouts/contentLayoutMaster')

@section('title', 'Pedido')

@section('vendor-style') {{-- Page Css files --}} @endsection

@section('page-style'){{-- Page Css files --}} @endsection


@section('content')
    <h1>Detalles del Combo</h1>

    <p><strong>ID:</strong> {{ $combo->id }}</p>
    <p><strong>Nombre:</strong> {{ $combo->name }}</p>
    <p><strong>Descripción:</strong> {{ $combo->description }}</p>

    <h2>Productos del Combo</h2>

    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Precio</th>
                <!-- Puedes agregar más columnas según las propiedades de tus productos -->
            </tr>
        </thead>
        <tbody>
            @foreach ($combo->products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }}</td>
                    <!-- Puedes mostrar más propiedades del producto aquí -->
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('combos.index') }}" class="btn btn-primary">Volver</a>
@endsection
