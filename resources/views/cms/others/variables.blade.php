@extends('cms/layouts/contentLayoutMaster')

@section('title', 'Configuración')

@section('vendor-style') {{-- Page Css files --}} @endsection

@section('page-style'){{-- Page Css files --}} @endsection

@section('content')
<section>
    @if (session('saved'))
    <div class="alert alert-success"><div class="alert-body">Variables guardadas correctamente</div></div>
    @endif

    <form action="{{ route('variables.save') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Variables de Mail</h4>
                <h4 class="card-title text-primary"><a class="btn btn-primary pull-right btn-sm" target="_blank" href="{{ route('variables.test') }}" style="color: #fff;">Test Mail</a></h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6 col-md-3">
                        <div class="mb-1">
                            <label class=" control-label">No Reply Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><i data-feather='mail'></i></span>
                                <input class="form-control input-sm" name="extra[SMAIL_EMAIL]" value="{{ $vars['SMAIL_EMAIL'] }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="mb-1">
                            <label class=" control-label">No Reply Nombre</label>
                            <div class="input-group">
                                <span class="input-group-text"><i data-feather='user'></i></span>
                                <input class="form-control input-sm" name="extra[SMAIL_FROM]" value="{{ $vars['SMAIL_FROM'] }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="mb-1">
                            <label class=" control-label">SMTP</label>
                            <div class="input-group">
                                <span class="input-group-text"><i data-feather='list'></i></span>
                                <select class="form-control" name="extra[SMAIL_SMTP]">
                                    <option value="0" {{ $vars['SMAIL_FROM'] == 0 ? 'selected' : '' }}>No</option>
                                    <option value="1" {{ $vars['SMAIL_FROM'] == 1 ? 'selected' : '' }}>Si</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="mb-1">
                            <label class=" control-label">Host</label>
                            <div class="input-group">
                                <span class="input-group-text"><i data-feather='server'></i></span>
                                <input class="form-control input-sm" name="extra[SMAIL_HOST]" value="{{ $vars['SMAIL_HOST'] }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="mb-1">
                            <label class=" control-label">Puerto</label>
                            <input class="form-control input-sm" name="extra[SMAIL_PORT]" value="{{ $vars['SMAIL_PORT'] }}">
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="mb-1">
                            <label class=" control-label">Autenticación</label>
                            <select class="form-control" name="extra[SMAIL_AUTH]">
                                <option value="0" {{ $vars['SMAIL_AUTH'] == 0 ? 'selected' : '' }}>No</option>
                                <option value="1" {{ $vars['SMAIL_AUTH'] == 1 ? 'selected' : '' }}>Si</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="mb-1">
                            <label class=" control-label">Usuario</label>
                            <div class="input-group">
                                <span class="input-group-text"><i data-feather='user'></i></span>
                                <input class="form-control input-sm" name="extra[SMAIL_USERNAME]" value="{{ $vars['SMAIL_USERNAME'] }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="mb-1">
                            <label class=" control-label">Clave</label>
                            <div class="input-group">
                                <span class="input-group-text"><i data-feather='lock'></i></span>
                                <input class="form-control input-sm" name="extra[SMAIL_PASSWORD]" value="{{ $vars['SMAIL_PASSWORD'] }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="mb-1">
                            <label class=" control-label">SMTPSecure</label>
                            <div class="input-group">
                                <span class="input-group-text"><i data-feather='list'></i></span>
                                <select class="form-control" name="extra[SMAIL_SECURE]">
                                    <option value="0" {{ $vars['SMAIL_SECURE'] == 0 ? 'selected' : '' }}>NO</option>
                                    <option value="ssl" {{ $vars['SMAIL_SECURE'] == 'ssl' ? 'selected' : '' }}>SSL</option>
                                    <option value="tls" {{ $vars['SMAIL_SECURE'] == 'tls' ? 'selected' : '' }}>TLS</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Variables de OGG</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-1">
                            <label class=" control-label">Título</label>
                            <input class="form-control input-sm" name="extra[OGG_TITLE]" value="{{ $vars['OGG_TITLE'] }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-1">
                            <label class=" control-label">Descripción</label>
                            <textarea class="form-control input-sm" name="extra[OGG_DESCRIPTION]">{{ $vars['OGG_DESCRIPTION'] }}</textarea>
                        </div>
                    </div>

                    <div class="col-4 mb-3">
                        <div class="d-flex">
                            <a href="#" class="me-25">
                                <img src="{{ $ogg_img->getImage() }}" id="img-upload-img" class="uploadedAvatar rounded me-50" alt="profile image" height="100" width="100" />
                            </a>
                            <!-- upload and reset button -->
                            <div class="d-flex align-items-end mt-75 ms-1">
                                <div>
                                    <label for="img-upload" class="btn btn-sm btn-primary mb-75 me-75">Subir</label>
                                    <input type="file" name="ogg_image" id="img-upload" hidden accept="image/*" />
                                    <button type="button" id="img-reset" class="btn btn-sm btn-outline-secondary mb-75">Borrar</button>
                                    <p class="mb-0">Tipos permitidos: png, jpg, jpeg.</p>
                                </div>
                            </div>
                            <!--/ upload and reset button -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-action">
            <button type="submit" class="btn btn-success">Guardar</button>
            <a class="btn btn-outline-secondary" href="{{ route('variables') }}">Cancelar</a>
        </div>
    </form>
</section>
@endsection

@section('page-script')
<script>
$("#img-upload").change(function() {
    const file = this.files[0];
    if (file) {
        let reader = new FileReader();
        reader.onload = function(event) {
            $('#img-upload-img').attr('src', event.target.result);
        }
        reader.readAsDataURL(file);
    }
});
</script>
@endsection
