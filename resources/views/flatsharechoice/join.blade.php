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
                        Hier kommt Zeugs her!
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
