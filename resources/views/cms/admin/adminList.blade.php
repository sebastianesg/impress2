@extends('cms/layouts/contentLayoutMaster')

@section('title', 'Administradores')

@section('vendor-style') {{-- Page Css files --}} @endsection

@section('page-style'){{-- Page Css files --}} @endsection

@section('content')
<section>
    @if (session('deleted'))
    <div class="alert alert-success"><div class="alert-body">Administrador borrado correctamente</div></div>
    @endif

    @if (session('saved'))
    <div class="alert alert-success"><div class="alert-body">Administrador guardado correctamente</div></div>
    @endif
    <div class="card">
        <div class="card-datatable table-responsive pt-0">
            <a class="dt-button create-new btn btn-primary" tabindex="0" type="button" href={{ route('admins.create') }}>
                <span><i data-feather="plus" class="me-50 font-small-4"></i>Agregar</span>
            </a>
            <table class="data-table table">
                <thead class="table-light">
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th class="no-sort">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($admins as $admin)
                    <tr>
                        <td>{{ $admin->id }}</td>
                        <td>{{ $admin->name }}</td>
                        <td>{{ $admin->email }}</td>
                        <td>{{ $admin->rol->name }}</td>
                        <td width="100">
                            <a type="button" href={{ route('admins.edit', $admin) }} class="btn btn-icon btn-icon rounded-circle btn-primary">
                                <i data-feather="edit"></i>
                            </a>
                            <button
                                data-href={{ route('admins.destroy', $admin) }} type="button"
                                class="btn btn-icon btn-icon rounded-circle btn-danger deleteComp"
                                data-txt="¿Desea eliminar este administrador?">
                                <i data-feather="trash-2"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
  <!-- list and filter end -->
</section>
<!-- users list ends -->
@endsection

@section('page-script'){{-- Page js files --}}@endsection
