@extends("layouts.app", ["title" => "Kalender"])

@section('headcss')
    <link href="{{ asset('css/modules/appointment.css.css') }}" rel="stylesheet">
@endsection

@section('headjs')
    <script src="{{ asset('js/wgappointment.js') }}"></script>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card wgpurchaselist">
                    <div class="card-header">{{ __('Kalender') }}</div>
                    <div class="card-body">
                        Hier könnte Ihr Termin stehen
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
