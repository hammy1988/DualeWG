@extends("layouts.app", ["title" => "Passwort zurücksetzen"])

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
                <div class="card-header">{{ __('Passwort zurücksetzen') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail-Adresse') }}</label>

                            <div class="col-md-6">
                                <div class="wgInputFieldWrapper">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror wgInputField" placeholder="E-Mail-Adresse" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                </div>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary wgButton">
                                    {{ __('Passwort zurücksetzen') }}
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
