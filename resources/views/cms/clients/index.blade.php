@extends('cms/layouts/contentLayoutMaster')

@section('title', 'Clientes')

@section('vendor-style') {{-- Page Css files --}} @endsection

@section('page-style'){{-- Page Css files --}} @endsection

@section('content')
    <div class="container">
        <h2>Clients List</h2>
        <a href="{{ route('clients.create') }}" class="btn btn-success">Create Client</a>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>WhatsApp</th>
                    <th>Instagram</th>
                    <th>Contact</th>
                    <th>Blacklist</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clients as $client)
                    <tr>
                        <td>{{ $client->id }}</td>
                        <td>{{ $client->full_name }}</td>
                        <td>{{ $client->wsp }}</td>
                        <td>{{ $client->ig }}</td>
                        <td>{{ $client->contact }}</td>
                        <td>{{ $client->bList ? 'Yes' : 'No' }}</td>
                        <td>
                            <a href="{{ route('clients.show', $client->id) }}" class="btn btn-info">View</a>
                            <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('clients.destroy', $client->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('page-script')

@endsection