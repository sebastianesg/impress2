@extends('cms/layouts/contentLayoutMaster')

@section('title', 'Pedido')

@section('vendor-style') {{-- Page Css files --}} @endsection

@section('page-style'){{-- Page Css files --}} @endsection


@section('content')
    <div class="container">
        <h2>View Client</h2>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">ID: {{ $client->id }}</h5>
                <p class="card-text"><strong>Full Name:</strong> {{ $client->full_name }}</p>
                <p class="card-text"><strong>WhatsApp:</strong> {{ $client->wsp }}</p>
                <p class="card-text"><strong>Instagram:</strong> {{ $client->ig }}</p>
                <p class="card-text"><strong>Contact:</strong> {{ $client->contact }}</p>
                <p class="card-text"><strong>Blacklist:</strong> {{ $client->bList ? 'Yes' : 'No' }}</p>
                <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-primary">Edit</a>
                <a href="{{ route('clients.index') }}" class="btn btn-secondary">Back to List</a>
            </div>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js"></script>
