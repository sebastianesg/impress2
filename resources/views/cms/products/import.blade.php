@extends('cms/layouts/contentLayoutMaster')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Importar Productos desde Excel
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <form action="{{ route('products.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="file" class="form-label">Seleccione un archivo Excel:</label>
                        <input type="file" class="form-control" id="file" name="file" accept=".xlsx, .xls" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Importar Productos</button>
                </form>
            </div>
        </div>
    </div>
@endsection