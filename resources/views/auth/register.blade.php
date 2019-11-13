@extends('layouts.app')

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
                <div class="card-header">{{ __('Registrierung') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="givenname" class="col-md-4 col-form-label text-md-right">{{ __('Vorname') }}</label>

                            <div class="col-md-6">
                                <div class="wgInputFieldWrapper">
                                    <input id="givenname" type="text" placeholder="Vorname" class="form-control @error('givenname') is-invalid @enderror wgInputField" name="givenname" value="{{ old('givenname') }}" required autocomplete="givenname" autofocus>
                                </div>
                                @error('givenname')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <div class="wgInputFieldWrapper">
                                    <input id="name" type="text" placeholder="Nachname" class="form-control @error('name') is-invalid @enderror wgInputField" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                </div>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Benutzername') }}</label>

                            <div class="col-md-6">
                                <div class="wgInputFieldWrapper">
                                    <input id="username" type="text" placeholder="Benutzername" class="form-control @error('username') is-invalid @enderror wgInputField" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                                </div>
                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Adresse') }}</label>

                            <div class="col-md-6">
                                <div class="wgInputFieldWrapper">
                                    <input id="email" type="email" placeholder="E-Mail-Adresse" class="form-control @error('email') is-invalid @enderror wgInputField" name="email" value="{{ old('email') }}" required autocomplete="email">
                                </div>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Passwort') }}</label>

                            <div class="col-md-6">
                                <div class="wgInputFieldWrapper">
                                    <input id="password" type="password" placeholder="Passwort" class="form-control @error('password') is-invalid @enderror wgInputField" name="password" required autocomplete="new-password">
                                </div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Passwort bestätigen') }}</label>

                            <div class="col-md-6">
                                <div class="wgInputFieldWrapper">
                                    <input id="password-confirm" type="password" placeholder="Passwort wiederholen" class="form-control wgInputField" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary wgButton">
                                    {{ __('Registrieren') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
