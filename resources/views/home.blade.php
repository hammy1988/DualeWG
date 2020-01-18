@extends("layouts.app", ["title" => "Übersicht"])

@section('headcss')
    <link href="{{ asset('css/modules/dashboard.css') }}" rel="stylesheet">
@endsection

@section('headjs')
    <script src="{{ asset('js/wgdashboard.js') }}"></script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">WG-Infos<span class="wgmehrheader"><a href="{{ route('flatsharemanagement') }}">mehr...</a></span></div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-8">
                            Hallo {{Auth::user()->name}} :)<br />
                            Du bist in der WG: <span style="font-weight: bold;">{{Auth::user()->flatshare()->first()->username}}</span><br />
                            Es leben <span style="font-weight: bold;">{{$flatshareUsers->users->where("flatsharejoin_at","<>",null)->count()}} Mitbewohner</span> in deiner WG.


                            @if($flatshareUsers->users->where('flatsharejoin_at',null)->count() > 0)
                                <br /><br />
                                <span style="font-weight: bold;">WG-Anfragen:</span><br />
                                <span style="margin: 0 0 0 10px">Es gibt {{$flatshareUsers->users->where('flatsharejoin_at',null)->count()}} offene Anfragen.</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">Termine<span class="wgmehrheader"><a href="{{ route('calendar') }}">mehr...</a></span></div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-8">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
