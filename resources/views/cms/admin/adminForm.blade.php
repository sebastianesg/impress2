@extends('cms/layouts/contentLayoutMaster')

@section('title', 'Administradores')

@section('vendor-style') {{-- Page Css files --}} @endsection

@section('page-style'){{-- Page Css files --}} @endsection

@section('content')
<section>
    <div class="card">
        <div class="card-body">
            <form class="form form-vertical needs-validation" action="{{ $action }}" method="POST" enctype="multipart/form-data" novalidate>
                @csrf
                @if ($method === 'edit')
                @method('PUT')
                @endif
                <div class="row">
                    <div class="col-sm-4">
                        <div class="mb-1">
                            <label class="form-label">Nombre</label>
                            <div class="input-group">
                                <span class="input-group-text"><i data-feather="user"></i></span>
                                <input type="text" class="form-control" name="name" placeholder="Nombre" value="{{ old('name', $admin->name) }}" required>
                            </div>
                            @error('name')<div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="mb-1">
                            <label class="form-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><i data-feather="mail"></i></span>
                                <input type="email" class="form-control" name="email" placeholder="Email" autocomplete="new-password"value="{{ old('email', $admin->email) }}" required>
                            </div>
                            @error('email')<div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="mb-1">
                            <label class="form-label">Clave</label>
                            <div class="input-group">
                                <span class="input-group-text"><i data-feather='key'></i></span>
                                <input type="password" class="form-control" name="password" placeholder="password" autocomplete="new-password" {{ $method == 'create' ? 'required' : '' }}>
                            </div>
                            @error('password')<span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-4 mb-3">
                        <div class="d-flex">
                            <a href="#" class="me-25">
                                <img src="{{ $admin->profile_photo_url }}" id="account-upload-img" class="uploadedAvatar rounded me-50" alt="profile image" height="100" width="100" />
                            </a>
                            <!-- upload and reset button -->
                            <div class="d-flex align-items-end mt-75 ms-1">
                                <div>
                                    <label for="account-upload" class="btn btn-sm btn-primary mb-75 me-75">Subir</label>
                                    <input type="file" name="profile_photo_path" id="account-upload" hidden accept="image/*" />
                                    <button type="button" id="account-reset" class="btn btn-sm btn-outline-secondary mb-75">Borrar</button>
                                    <p class="mb-0">Tipos permitidos: png, jpg, jpeg.</p>
                                </div>
                            </div>
                            <!--/ upload and reset button -->
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="mb-1">
                            <label class="form-label">Rol</label>
                            <div class="input-group">
                                <span class="input-group-text"><i data-feather='key'></i></span>
                                <select name="rol_id" class="form-control">
                                    @foreach ($roles as $r)
                                    <option value="{{ $r->id }}" {{ $r->name == $admin->id ? 'selected' : '' }}>{{ $r->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('rol_id')<span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        @if ($method !== 'view')
                        <button type="submit" class="btn btn-success me-1 waves-effect waves-float waves-light">Guardar</button>
                        @endif
                        <a href="{{ route('admins') }}" class="btn btn-outline-secondary waves-effect">{{ $method !== 'view' ? 'Cancelar' : 'Volver' }}</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- users list ends -->
@endsection

@section('page-script')
<script>
$("#account-upload").change(function() {
    const file = this.files[0];
    if (file) {
        let reader = new FileReader();
        reader.onload = function(event) {
            $('#account-upload-img').attr('src', event.target.result);
        }
        reader.readAsDataURL(file);
    }
});
</script>
@endsection
