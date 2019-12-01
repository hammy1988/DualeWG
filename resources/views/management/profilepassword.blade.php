@extends("layouts.app", ["title" => "Profil"])

@section('headcss')
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
@endsection

@section('headjs')

@endsection

@section("content")

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Passwort ändern') }}</div>

                    <div class="card-body">
                    @csrf

                        <div class="form-group row">
                            <label for="oldpassword" class="col-md-4 col-form-label text-md-right">{{ __('Altes Passwort') }}</label>
                            <div class="col-md-6">
                                <div class="wgInputFieldWrapper_Show profileinputprefilled">
                                    <span id="oldpassword_span">Platzhalter</span>
                                </div>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="newpassword" class="col-md-4 col-form-label text-md-right">{{ __('Neues Passwort') }}</label>

                            <div class="col-md-6">
                                <div class="wgInputFieldWrapper_Show profileinputprefilled">
                                    <span id="newpassword_span">Platzhalter</span>
                                </div>

                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="checknewpassword" class="col-md-4 col-form-label text-md-right">{{ __('Passwort wiederholen') }}</label>

                            <div class="col-md-6">
                                <div class="wgInputFieldWrapper_Show profileinputprefilled">
                                    <span id="checknewpassword_span">Platzhalter</span>
                                </div>
                                
                            </div>
                        </div>

                        <div class="form-group row mb-1">
                            <div class="col-md-9 offset-md-4" id="passwordchange">
                                <a href="{{ route("profilepassword") }}" id="passwordchangebutton" class="btn btn-primary wgButton">
                                    {{ __('Passwort ändern') }}
                                </a>
                            </div>
                        </div>

                    </div>
                    <div>
                    </div>
                </div>
            </div>
        </div>




@endsection

