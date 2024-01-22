@extends('cms/layouts/contentLayoutMaster')

@section('title', 'Productos')

@section('vendor-style') {{-- Page Css files --}} @endsection

@section('page-style'){{-- Page Css files --}} @endsection

@section('content')
    <div class="container">
        <h2>Create Variable</h2>
        <form action="{{ route('variables.store') }}" method="post">
            @csrf
            <label for="type">Type:</label>
            <input type="text" name="type" required>
            <label for="name">Name:</label>
            <input type="text" name="name" required>
            <label for="value">Value:</label>
            <input type="text" name="value" required>
            <button type="submit">Create Variable</button>
        </form>
    </div>
@endsection