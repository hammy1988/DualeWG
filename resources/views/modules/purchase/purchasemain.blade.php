@extends("layouts.app", ["title" => "Auswahl"])

@section('headcss')
    <link href="{{ asset('css/modules/purchase.css') }}" rel="stylesheet">
@endsection

@section('headjs')
    <script src="{{ asset('js/wgpurchase.js') }}"></script>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Purchase</div>
                    <div class="card-body">
                        Hier könnte ihr einkauf stehen!
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
