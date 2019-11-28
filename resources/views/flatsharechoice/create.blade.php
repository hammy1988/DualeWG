@extends("layouts.app", ["title" => "Neue WG erstellen"])

@section('headcss')
    <link href="{{ asset('css/wgchoice.css') }}" rel="stylesheet">
@endsection

@section('headjs')
    <script src="{{ asset('js/wgflatsharecreate.js') }}"></script>
@endsection

@section("content")
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route("flatsharechoiceoptions") }}" class="wgArrowBack">
                            <span class="fas fa-arrow-left"></span>
                        </a>
                        {{ __('Neue WG erstellen') }}
                    </div>

                    <div class="card-body wgCreateWrapper">
                        @csrf

                        <div class="form-group row">
                            <label for="login" class="col-sm-4 col-form-label text-md-right">
                                {{ __('WG Name') }}
                            </label>

                            <div class="col-md-6">
                                <div class="wgInputFieldWrapper" id="wgcreateinput">
                                    <input id="wgname" type="text" placeholder="WG Name"
                                           class="form-control wgInputField"
                                           name="wgname" value="" autofocus autocomplete="off" />
                                    <input type="hidden" id="wgCreateUserId" name="wgCreateUserID" value="{{ Auth::id() }}" />
                                </div>
                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="col-md-12 wgchoiceerrormessages">
                                <span id="wgcreatefail" class="invalid-feedback wgchoicefail" role="alert">
                                        <strong>Da hat etwas nicht geklappt. Probiere es noch einmal.</strong>
                                </span>
                                <span id="wgcreatenamefail" class="invalid-feedback wgchoicefail" role="alert">
                                        <strong>Bitte einen WG Namen angeben.</strong>
                                </span>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" id="createWG" class="btn btn-primary wgButton">
                                    {{ __('WG erstellen') }}
                                </button>
                            </div>
                        </div>

                    </div>

                    <div class="card-body wgWaitWrapper">
                        <span id="wgwaitspinner" class="fas fa-spinner fa-pulse"></span>
                    </div>

                    <div class="card-body wgCreateSuccessWrapper">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="wgCreateSuccessWelcome">
                                    Du hast erfolgreich die WG <br />
                                    <span id="wgcreatesuccessflatsharename"></span>
                                    <br /> erstellt.
                                </div>
                                <div class="wgCreateSuccessRedirect">
                                    <a href="/">Weiter zur Übersicht <span class="fad fa-chart-network"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
