@extends("layouts.app", ["title" => "Auswahl"])

@section('headcss')
    <link href="{{ asset('css/wgchoice.css') }}" rel="stylesheet">
@endsection

@section('headjs')
    <script src="{{ asset('js/wgflatsharechoice.js') }}"></script>
@endsection

@section("content")
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route("flatsharechoiceoptions") }}" class="wgArrowBack" title="zurück">
                            <span class="fas fa-arrow-left"></span>
                        </a>
                        {{ __('Einer WG beitreten') }}
                    </div>

                    <div class="card-body wgJoinSearchWrapper">
                        @csrf

                        <div class="form-group row">
                            <label for="login" class="col-sm-4 col-form-label text-md-right">
                                {{ __('WG-Suche') }}
                            </label>

                            <div class="col-md-6">
                                <div class="wgInputFieldWrapper">
                                    <input id="wgsearch" type="text" placeholder="Suche ..."
                                           class="form-control wgInputField"
                                           name="wgsearch" value="" autofocus autocomplete="off" />
                                    <input type="hidden" id="wgJoinUserId" name="wgJoinUserID" value="{{ Auth::id() }}" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12 wgchoiceerrormessages">
                                <span id="wgsearchfail" class="invalid-feedback wgchoicefail" role="alert">
                                        <strong>Da hat etwas nicht geklappt. Probiere es noch einmal.</strong>
                                </span>
                                <span id="wgsearchselectfail" class="invalid-feedback wgchoicefail" role="alert">
                                        <strong>Bitte eine WG auswählen.</strong>
                                </span>
                            </div>
                            <div class="col-md-6 offset-md-4 wgJoinSearchWrapper">
                                <div id="wgsearchresult"></div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" id="joinInWG" class="btn btn-primary wgButton">
                                    {{ __('WG beitreten') }}
                                </button>
                            </div>
                        </div>

                    </div>

                    <div class="card-body wgWaitWrapper">
                        <span class="fas fa-spinner fa-pulse wgwaitspinner"></span>
                    </div>

                    <div class="card-body wgJoinSuccessWrapper">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="wgJoinSuccessWelcome">
                                    Eine Beitrittsanfrage für die WG <br />
                                    <span id="wgsearchsuccessflatsharename"></span>
                                    <br /> wurde versandt.
                                </div>
                                <div class="wgJoinSuccessRedirect">
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
