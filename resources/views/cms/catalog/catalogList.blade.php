@extends('cms/layouts/contentLayoutMaster')

@section('title', 'Catálogos')

@section('vendor-style') {{-- Page Css files --}} @endsection

@section('page-style'){{-- Page Css files --}} @endsection

@section('content')
<section>
    @if (session('deleted'))
    <div class="alert alert-success"><div class="alert-body">Item borrado correctamente</div></div>
    @endif

    @if (session('saved'))
    <div class="alert alert-success"><div class="alert-body">Item guardado correctamente</div></div>
    @endif
    <div class="card">
        <div class="card-datatable table-responsive pt-0">
            <a class="dt-button create-new btn btn-primary" tabindex="0" type="button" href={{ route('catalogs.create', $type) }}>
                <span><i data-feather="plus" class="me-50 font-small-4"></i>Agregar</span>
            </a>
            <table class="data-table table">
                <thead class="table-light">
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        @if ($t == 1)
                        <th>Provincias</th>
                        @elseif ($t == 2)
                        <th>Ciudades</th>
                        @endif
                        <th class="no-sort">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($catalogs as $catalog)
                    <tr>
                        <td>{{ $catalog->id }}</td>
                        <td>{{ $catalog->name }}</td>
                        @if ($t == 1)
                        <td><a href="{{ route('catalogs', '2_'.$catalog->id) }}">Provincias</a></td>
                        @elseif ($t == 2)
                        <td><a href="{{ route('catalogs', '3_'.$catalog->id) }}">Ciudades</a></td>
                        @endif
                        <td>
                            <a type="button" href={{ route('catalogs.edit', [$type, $catalog]) }} class="btn btn-icon btn-icon rounded-circle btn-primary">
                                <i data-feather="edit"></i>
                            </a>
                            <button
                                data-href={{ route('catalogs.destroy', [$type, $catalog]) }} type="button"
                                class="btn btn-icon btn-icon rounded-circle btn-danger deleteComp"
                                data-txt="{{ __('catalog.delete.' . $t) }}">
                                <i data-feather="trash-2"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @if ($t == 2 || $t == 3)
    <a class="dt-button btn btn-primary waves-effect waves-float waves-light" href="{{ route('catalogs', ($t == 3 ? 2 : 1).($back != 0 ? '_'.$back : '')) }}">Volver</a>
    @endif
  <!-- list and filter end -->
</section>
<!-- users list ends -->
@endsection

@section('page-script'){{-- Page js files --}}@endsection
