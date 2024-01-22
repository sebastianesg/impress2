@extends('front.layouts.master')
@section('title', 'Contacto')
@section('description', 'A custom site made by Coding & Company')
@section('keywords', '')

@section('style')
@stop

@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <form role="form" action="sendmail.php" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                    <!-- Honeypot -->
                    <div style="position: absolute; left: -5000px;">
                        <input type="text" name="antispam" value="">
                    </div>
                    <!-- CSRF Token -->
                    <?php
                        $tokenCSRF = bin2hex(random_bytes(32));
                        $_SESSION['token'] = $tokenCSRF;
                    ?>
                    <input type="hidden" name="tokenCSRF" value="<?php echo $tokenCSRF; ?>">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="formNombre">Nombre</label>
                            <input id="formNombre" type="text" name="nombre" class="form-control" required placeholder="Nombre">
                            <div class="invalid-feedback">Campo Obligatorio</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="formEmail">Email</label>
                            <input id="formEmail" type="email" name="email" class="form-control" required placeholder="Email">
                            <div class="invalid-feedback">Campo Obligatorio</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="formTelefono">Teléfono</label>
                            <input id="formTelefono" type="tel" name="telefono" class="form-control" required placeholder="Teléfono">
                            <div class="invalid-feedback">Campo Obligatorio</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <div class="form-group">
                                <label class="file form-control">
                                    <span class="file-button">Seleccionar archivo</span>
                                    <span id="fileInputName">Archivo sin seleccionar</span>
                                    <img src="img/icon-image.png" alt="" width="25" height="19" loading="lazy">
                                    <input id="customFile" type="file" name="fotos[]" multiple lang="es" required>
                                </label>
                                <div class="invalid-feedback">Campo Obligatorio</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="password">Clave</label>
                            <div class="form-password">
                                <input id="password" type="password" name="clave" class="form-control" required placeholder="Clave">
                                <i id="form-eye" class="fas fa-eye" onclick="showPassword()"></i>
                            </div>
                            <div class="invalid-feedback">La contraseña debe tener tal formato</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="confirm_password">Repetir Clave</label>
                            <input id="confirm_password" type="password" name="clave2" class="form-control" required placeholder="Repetir Clave">
                            <div class="invalid-feedback">Las claves deben coincidir</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="formMensaje">Mensaje</label>
                            <textarea id="formMensaje" name="mensaje" class="form-control" required placeholder="Mensaje"></textarea>
                            <div class="invalid-feedback">Campo Obligatorio</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="submit" name="submit" class="btn btn-primary btn-block">Enviar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@stop

@section('scripts')
<script src="{{ asset('front/assets/js/controllers/contacto.js') }}" defer></script>
<script>
    validatePassword();
</script>
@stop
