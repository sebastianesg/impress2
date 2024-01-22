@extends('cms/layouts/contentLayoutMaster')

@section('title', 'Pedido')

@section('vendor-style') {{-- Page Css files --}} @endsection

@section('page-style'){{-- Page Css files --}} @endsection

@section('content')
    <div class="container">
        <form action="{{ route('orders.update', ['order' => $order->id]) }}" method="post">
            @csrf
            @method('put')

            <h1>Detalles del Pedido</h1>
            
            <div class="mb-3">
                <label for="realizer">Encargado de Realizar:</label>
                <select class="form-select" id="realizer" name="realizer_id">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ $order->realizer_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="mb-3">
                <label for="shipper">Encargado de Envío:</label>
                <select class="form-select" id="shipper" name="shipper_id">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ $order->shipper_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="shipper">Estado del envio</label>
                <select class="form-select" id="estado" name="estado">
                <option value="Pendiente" {{ $order->estado == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                <option value="Ready" {{ $order->estado == 'Ready' ? 'selected' : '' }}>Ready</option>
                <option value="Enviado" {{ $order->estado == 'Enviado' ? 'selected' : '' }}>Enviado</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
            
            <p><strong>Detalles del Pedido:</strong> {{ $order->order_details }}</p>
            <p><strong>Total:</strong> ${{ $order->total }}</p>

            <h2>Productos</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Estado</th>
                        <th>Enlace</th>
                        <!--<th>Acción</th>-->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>${{ $product->pivot->precio }}</td>
                            
                            <td>
                                <select class="form-select" name="product_status[{{ $product->id }}]">
                                    <option value="pending" {{ $product->pivot->estado == 'pending' ? 'selected' : '' }}>Pendiente</option>
                                    <option value="completed" {{ $product->pivot->estado == 'completed' ? 'selected' : '' }}>Completado</option>
                                </select>
                            </td>
                            
                            <td>
                                <a href="{{ $product->link }}" target="_blank">{{ $product->link }}</a>
                            </td>
                            
                            <!--<td>
                                <button type="submit" name="action" value="markProductCompleted[{{ $product->id }}]" class="btn btn-success">Marcar como Completado</button>
                            </td>-->
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </form>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js"></script>
