@extends('cms/layouts/contentLayoutMaster')

@section('title', 'Pedido')

@section('vendor-style') {{-- Page Css files --}} @endsection

@section('page-style'){{-- Page Css files --}} @endsection


@section('content')
    <h1>Editar Combo</h1>

    @include('cms.combos._form', ['action' => route('combos.update', $combo->id), 'method' => 'PUT'])
@endsection
