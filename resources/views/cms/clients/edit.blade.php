@extends('cms/layouts/contentLayoutMaster')

@section('title', 'Pedido')

@section('vendor-style') {{-- Page Css files --}} @endsection

@section('page-style'){{-- Page Css files --}} @endsection


@section('content')
    <div class="container">
        <h2>Edit Client</h2>
        <form action="{{ route('clients.update', $client->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="full_name">Full Name</label>
                <input type="text" class="form-control" id="full_name" name="full_name" value="{{ $client->full_name }}" required>
            </div>
            <div class="form-group">
                <label for="wsp">WhatsApp</label>
                <input type="text" class="form-control" id="wsp" name="wsp" value="{{ $client->wsp }}" required>
            </div>
            <div class="form-group">
                <label for="ig">Instagram</label>
                <input type="text" class="form-control" id="ig" name="ig" value="{{ $client->ig }}" required>
            </div>
            <div class="form-group">
                <label for="contact">Contact</label>
                <input type="text" class="form-control" id="contact" name="contact" value="{{ $client->contact }}" required>
            </div>
            <div class="form-group">
                <label for="bList">Blacklist</label>
                <select class="form-control" id="bList" name="bList" required>
                    <option value="0" {{ $client->bList == 0 ? 'selected' : '' }}>No</option>
                    <option value="1" {{ $client->bList == 1 ? 'selected' : '' }}>Yes</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js"></script>
