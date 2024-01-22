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
                            <th>Responsable de Realizar</th>
                            <th>Responsable de Envío</th>
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
                                <td>{{ $order->realizer->name ?? 'N/A' }}</td>
                                <td>{{ $order->shipper->name ?? 'N/A' }}</td>
                                <td>
                                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info btn-sm">Ver Detalles</a>
                                    <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                    </form>
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

@endsection
