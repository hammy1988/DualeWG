@extends("layouts.app", ["title" => "Auswahl"])

@section('headcss')
    <link href="{{ asset('css/wgchoice.css') }}" rel="stylesheet">
@endsection

@section('headjs')
    <script src="{{ asset('js/wgflatsharerequest.js') }}"></script>
@endsection

@section("content")
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('WG Anfrage') }}</div>

                    <div class="card-body">


                        <div class="wgRequest">
                            WG ANFRAGE STEHT AUS.<br />
                            <a href="#" id="delWgRequest" data-userid="{{ Auth::id() }}">Anfrage löschen</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
