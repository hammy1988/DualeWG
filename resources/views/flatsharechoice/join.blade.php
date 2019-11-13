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
                    <div class="card-header">{{ __('Einer WG beitreten') }}</div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="login" class="col-sm-4 col-form-label text-md-right">
                                    {{ __('WG-Suche') }}
                                </label>

                                <div class="col-md-6">
                                    <div class="wgInputFieldWrapper">
                                        <input id="wgsearch" type="text" placeholder="Suche ..."
                                               class="form-control wgInputField"
                                               name="wgsearch" value="" autofocus autocomplete="off">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div id="wgsearchresult"></div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary wgButton">
                                        {{ __('WG beitreten') }}
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
