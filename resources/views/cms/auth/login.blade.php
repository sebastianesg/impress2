@extends('cms/layouts/fullLayoutMaster')

@section('title', 'Login')

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('cms/css/base/pages/authentication.css')) }}">
@endsection

@section('content')
  <div class="auth-wrapper auth-basic px-2">
    <div class="auth-inner my-2">
      <!-- Login basic -->
      <div class="card mb-0">
        <div class="card-body">
          <a href="#" class="brand-logo">
            <img src="{{ asset('cms/images/logo/logo.svg') }}" class="img-fluid" alt="{{ __('login.title') }} Logo">
          </a>

          <h4 class="card-title mb-1">{{ __('login.login.welcome') }}! 👋</h4>
          <p class="card-text mb-2">{{ __('login.login.txt') }}</p>

          @if (session('status'))
            <div class="alert alert-success mb-1 rounded-0" role="alert">
              <div class="alert-body">
                {{ session('status') }}
              </div>
            </div>
          @endif

          <form class="auth-login-form mt-2" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-1">
              <label for="login-email" class="form-label"><i data-feather="mail" class="me-1"></i> {{ __('login.login.email') }}</label>
              <input type="text" class="form-control @error('email') is-invalid @enderror" id="login-email" name="email"
                placeholder="john@example.com" aria-describedby="login-email" tabindex="1" autofocus
                value="{{ old('email') }}" />
              @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>

            <div class="mb-1">
              <div class="d-flex justify-content-between">
                <label class="form-label" for="login-password"><i data-feather="lock" class="me-1"></i> {{ __('login.login.password') }}</label>
                @if (Route::has('password.request'))
                  <a href="{{ route('password.request') }}">
                    <small>{{ __('login.login.forgot') }}</small>
                  </a>
                @endif
              </div>
              <div class="input-group input-group-merge form-password-toggle">
                <input type="password" class="form-control form-control-merge" id="login-password" name="password"
                  tabindex="2" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                  aria-describedby="login-password" />
                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
              </div>
            </div>
            <div class="mb-1">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="remember" name="remember" tabindex="3"
                  {{ old('remember') ? 'checked' : '' }} />
                <label class="form-check-label" for="remember"> {{ __('login.login.remember') }} </label>
              </div>
            </div>
            <button type="submit" class="btn btn-primary w-100" tabindex="4"><i data-feather="log-in" class="me-1"></i> {{ __('login.login.sign') }}</button>
          </form>
        </div>
      </div>
      <!-- /Login basic -->
    </div>
  </div>
@endsection
