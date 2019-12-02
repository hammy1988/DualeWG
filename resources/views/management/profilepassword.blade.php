@extends("layouts.app", ["title" => "Profil"])

@section('headcss')
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
@endsection

@section('headjs')
    <script src="{{ asset('js/wgprofilechange.js') }}"></script>
@endsection

@section("content")

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Passwort ändern') }}</div>

                    <div class="card-body" id="wgpasswortchangeinput">
                    @csrf

                        <div class="form-group row">
                            <label for="oldpassword" class="col-md-4 col-form-label text-md-right">{{ __('Altes Passwort') }}</label>
                            <div class="col-md-6">
                                <div class="wgInputFieldWrapper">
                                    <input id="oldpassword" type="password"
                                           class="form-control wgInputField " name="oldpassword"
                                           value="" autofocus autocomplete="off" placeholder="Altes Passwort" />
                                </div>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="newpassword" class="col-md-4 col-form-label text-md-right">{{ __('Neues Passwort') }}</label>

                            <div class="col-md-6">
                                <div class="wgInputFieldWrapper">
                                    <input id="newpassword" type="password"
                                           class="form-control wgInputField " name="newpassword"
                                           value="" autocomplete="off" placeholder="Neues Passwort" />
                                </div>

                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="newpassword-confirmation" class="col-md-4 col-form-label text-md-right">{{ __('Passwort wiederholen') }}</label>

                            <div class="col-md-6">
                                <div class="wgInputFieldWrapper">
                                    <input id="newpassword-confirmation" type="password"
                                           class="form-control wgInputField " name="newpassword_confirmation"
                                           value="" autocomplete="off" placeholder="Passwort wiederholen" />
                                </div>

                            </div>
                        </div>

                        <div class="form-group row mb-1">
                            <div class="col-md-9 offset-md-4" id="passwordchange">
                                <input type="hidden" id="wgProfileUserId" name="wgProfileUserId" value="{{ Auth::id() }}" />
                                <a href="{{ route("profilepassword") }}" id="passwordchangesubmitbutton" class="btn btn-primary wgButton">
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

