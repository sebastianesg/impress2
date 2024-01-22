@extends('cms/layouts/contentLayoutMaster')

@section('title', 'Productos')

@section('vendor-style') {{-- Page Css files --}} @endsection

@section('page-style'){{-- Page Css files --}} @endsection

@section('content')
    <div class="container">
        <h2>Edit Variable</h2>
        <form action="{{ route('variables.update', $variable->id) }}" method="post">
            @csrf
            @method('PUT')
            <label for="type">Type:</label>
            <input type="text" name="type" value="{{ $variable->type }}" required>
            <label for="name">Name:</label>
            <input type="text" name="name" value="{{ $variable->name }}" required>
            <label for="value">Value:</label>
            <input type="text" name="value" value="{{ $variable->value }}" required>
            <button type="submit">Update Variable</button>
        </form>
    </div>
@endsection