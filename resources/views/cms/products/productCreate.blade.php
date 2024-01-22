@extends('cms/layouts/contentLayoutMaster')

@section('title', 'Productos')

@section('vendor-style') {{-- Page Css files --}} @endsection

@section('page-style'){{-- Page Css files --}} @endsection


@section('content')
<section class="inner-block">
    <div class="card">
        <div class="card-body">
            @if ($variable ?? false)
            <div class="alert alert-dark">
                <div class="alert-body">Faltan completar datos obligatoios</div>
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
            <h1 class="mb-2">Crear nuevo producto</h1>
            <form class="form form-vertical needs-validation" action=@if ($mode=="create" ){{ route('products.store') }}@else {{ route('products.update',$product->id) }}@endif method="POST" novalidate>
                @csrf
                @if ($mode === 'edit')
                @method('PUT')
                @endif
                <h4 class="fw-bolder border-bottom pb-50 mb-1">Producto</h4>
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <div class="mb-1">
                            <label class="form-label" for="full_name">Nombre</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i data-feather='user'></i></span>
                                <input placeholder="Nombre" type="text" name="name" id="name" class="form-control" value="{{ $product->name ?? old('name', '') }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="mb-1">
                            <label class="form-label" for="identification">Stock</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i data-feather='credit-card'></i></span>
                                <input placeholder="Stock" type="number" name="stock" id="stock" class="form-control" value="{{ $product->stock ?? old('stock', '') }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
    <div class="mb-1">
        <label class="form-label" for="paginas">Páginas</label>
        <div class="input-group input-group-merge">
            <span class="input-group-text"><i data-feather='file-text'></i></span>
            <input placeholder="Páginas" type="number" name="paginas" id="paginas" class="form-control" value="{{ $product->paginas ?? old('paginas', '') }}" required>
        </div>
    </div>
</div>

                    <div class="col-sm-6 col-md-4">
                        <div class="mb-1">
                            <label class="form-label" for="identification">Precio</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i data-feather='credit-card'></i></span>
                                <input placeholder="Precio" type="number" name="price" id="price" class="form-control" value="{{ $product->price ?? old('price', '') }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                        <div class="mb-1">
                            <label class="form-label" for="identification">Link</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i data-feather='credit-card'></i></span>
                                <input placeholder="Link" type="text" name="link" id="link" class="form-control" value="{{ $product->link ?? old('price', '') }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="mb-1">
                                <label class="form-label" for="description">Descripcion</label>
                                <textarea placeholder="Descripcion" name="description" id="description" class="form-control" rows="3">{{ $product->description ?? old('description', '') }}</textarea>
                            </div>
                        </div>
                    </div>
                <div class="row row-last">
                    <div class="col-12 d-flex justify-content-end">
                        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary waves-effect">Cancelar</a>
                        <button type="submit" class="btn btn-success ms-1 waves-effect waves-float waves-light">Crear</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
