@extends('cms/layouts/contentLayoutMaster')

@section('title', 'Productos')

@section('vendor-style') {{-- Page Css files --}} @endsection

@section('page-style'){{-- Page Css files --}} @endsection

@section('content')
<section>
    <div class="col">
        @if (session('deleted'))
        <div class="alert alert-success">
            <div class="alert-body">Producto borrado correctamente</div>
        </div>
        @endif

        @if (session('saved'))
        <div class="alert alert-success">
            <div class="alert-body">Producto guardado correctamente</div>
        </div>
        @endif
        <div class="card">
            <div class="card-datatable table-responsive pt-0">
                <a class="dt-button create-new btn btn-primary" tabindex="0" type="button" href={{ route('orders.create') }}>
                    <span><i data-feather="plus" class="me-50 font-small-4"></i>Agregar</span>
                </a>
                <table class="data-table table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User ID</th>
                            <th>Order Details</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->user_id }}</td>
                                <td>{{ $order->order_details }}</td>
                                <td>{{ $order->estado }}</td>
                                <td>
                                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info btn-sm">Ver Detalles</a>
                                    
                                    @if($order->estado == 'pendiente')
                                        <button type="button" class="btn btn-success btn-sm" onclick="markOrderAsReady('{{ $order->id }}')">Realizar</button>
                                    @endif
                                    
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection

@section('page-script')
<script>
    function markOrderAsReady(orderId) {
        var result = confirm("¿Estás seguro de que deseas marcar este pedido como realizado?");
        if (result) {
        $.ajax({
            url: `/accesocms/orders/${orderId}/mark-as-ready`,
            type: 'POST',
            data: {_token: '{{ csrf_token() }}'},
            success: function(response) {
                // Manejar la respuesta según sea necesario
                console.log(response);
                // Puedes recargar la página o actualizar solo la fila de la tabla según tus necesidades
                location.reload();
            },
            error: function(error) {
                // Manejar errores si es necesario
                console.error(error);
            }
        });}
    }
</script>
@endsection
