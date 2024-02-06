@extends('cms/layouts/contentLayoutMaster')

@section('title', 'Pedido')

@section('vendor-style') {{-- Page Css files --}} @endsection

@section('page-style'){{-- Page Css files --}} @endsection


@section('content')
    <h1>Combos</h1>

    <a href="{{ route('combos.create') }}" class="btn btn-success">Crear Combo</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($combos as $combo)
                <tr>
                    <td>{{ $combo->id }}</td>
                    <td>{{ $combo->name }}</td>
                    <td>{{ $combo->description }}</td>
                    <td>
                        <a href="{{ route('combos.show', $combo->id) }}" class="btn btn-info">Ver</a>
                        <a href="{{ route('combos.edit', $combo->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('combos.destroy', $combo->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
