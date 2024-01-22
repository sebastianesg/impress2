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
                <a class="dt-button create-new btn btn-primary" tabindex="0" type="button" href={{ route('products.create') }}>
                    <span><i data-feather="plus" class="me-50 font-small-4"></i>Agregar</span>
                </a>
                <table class="data-table table">
                    <thead class="table-light">
                        <tr>
                            <th class="no-sort">Acciones</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Páginas</th> {{-- Nueva columna --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr>
                            <td>
                                <a type="button" href={{ route('products.edit', $product->id) }} class="btn btn-icon btn-icon rounded-circle btn-primary">
                                    <i data-feather="edit"></i>
                                </a>
                                <button data-href={{ route('products.destroy', $product->id) }} type="button" class="btn btn-icon btn-icon rounded-circle btn-danger deleteComp" data-txt="¿Desea eliminar este administrador?">
                                    <i data-feather="trash-2"></i>
                                </button>
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>{{ $product->paginas }}</td> {{-- Nueva columna --}}
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <form action="{{ route('update.prices') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-info">Actualizar Precios</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@section('page-script')

@endsection
