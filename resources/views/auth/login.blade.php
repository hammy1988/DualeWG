@extends("layouts.app", ["title" => "Anmelden"])

@section('headcss')
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
@endsection

@section('headjs')

@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Anmeldung') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="login" class="col-sm-4 col-form-label text-md-right">
                                {{ __('Benutzername/E-Mail') }}
                            </label>

                            <div class="col-md-6">
                                <div class="wgInputFieldWrapper">
                                    <input id="login" type="text" placeholder="E-Mail-Adresse/Benutzername"
                                           class="form-control{{  $errors->has('email') || $errors->has('username') ? ' is-invalid' : '' }} wgInputField"
                                           name="login" value="{{ old('email') ?: old('username') }}" required autofocus>
                                </div>
                                @if ($errors->has('email') || $errors->has('username'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') ?: $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <div class="wgInputFieldWrapper">
                                    <input id="password" type="password" placeholder="Passwort" class="form-control @error('password') is-invalid @enderror wgInputField" name="password" required autocomplete="current-password">
                                </div>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Angemeldet bleiben') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary wgButton">
                                    {{ __('Anmelden') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        Passwort vergessen?
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
