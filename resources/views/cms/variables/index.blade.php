@extends('cms/layouts/contentLayoutMaster')

@section('title', 'Productos')

@section('vendor-style') {{-- Page Css files --}} @endsection

@section('page-style'){{-- Page Css files --}} @endsection

@section('content')
    <div class="container">
        <h2>Variable List</h2>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <table>
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Name</th>
                    <th>Value</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($variables as $variable)
                    <tr>
                        <td>{{ $variable->type }}</td>
                        <td>{{ $variable->name }}</td>
                        <td>{{ $variable->value }}</td>
                        <td>
                            <a href="{{ route('variables.show', $variable->id) }}">Show</a>
                            <a href="{{ route('variables.edit', $variable->id) }}">Edit</a>
                            <form action="{{ route('variables.destroy', $variable->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No variables found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection