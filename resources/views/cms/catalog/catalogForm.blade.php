@extends('cms/layouts/contentLayoutMaster')

@section('title', 'Catalogos')

@section('vendor-style') {{-- Page Css files --}} @endsection

@section('page-style'){{-- Page Css files --}} @endsection

@section('content')
<section>
    <div class="card">
        <div class="card-body">
            <form class="form form-vertical needs-validation" action="{{ $action }}" method="POST" novalidate>
                @csrf
                @if ($method === 'edit')
                @method('PUT')
                @endif
                <input type="hidden" name="id" value="{{ $catalog->id }}">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="mb-1">
                            <label class="form-label">Nombre</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i data-feather="user"></i></span>
                                <input type="text" class="form-control" name="name" placeholder="Nombre" value="{{ old('name', $catalog->name) }}" required>
                            </div>
                            @error('name')<div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        @if ($method !== 'view')
                        <button type="submit" class="btn btn-primary me-1 waves-effect waves-float waves-light">Guardar</button>
                        @endif
                        <a href="{{ route('catalogs', $type) }}" class="btn btn-outline-secondary waves-effect">{{ $method !== 'view' ? 'Cancelar' : 'Volver' }}</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- users list ends -->
@endsection

@section('page-script'){{-- Page js files --}}@endsection
