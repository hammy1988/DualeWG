@extends("layouts.app", ["title" => "Auswahl"])

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
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Du wurdest erfolgreich eingeloggt!
                </div>
            </div>
            <div class="card">
                <div class="card-header">Benutzer Infos</div>
                <div class="card-body">
                    Benutzername: {{Auth::user()->name}}<br />
                    Datenbank-ID: {{Auth::id()}}<br />
                    <br />
                    Login-Infos:<br />
                    <code>
                        {{Auth::user()}}
                    </code>
                </div>
            </div>
            <div class="card">
                <div class="card-header">WG - Info</div>
                <div class="card-body">
                    @if(Auth::user()->hasActiveFlatshare())
                        Ist in der WG: <b><u>{{Auth::user()->flatshare()->first()->name}}</u></b>
                    @else
                        Ist in keiner WG.
                    @endif
                    <br />
                    Ist WG-Admin:
                    @if(Auth::user()->isFlatshareAdmin())
                        <b>ja</b>
                        <br />
                        <b style="font-weight: 800">&nbsp;&nbsp;WG-Anfragen: </b><br />
                        <ul>
                        @foreach ($flatshareUsers->users->where('flatsharejoin_at',null) as $wguser)
                            <li id="wgcontroluserrequest_{{ $wguser->id }}">{{ $wguser->username }} (<a href="#" class="wgcontrolaccept" data-userid="{{ $wguser->id }}">annehmen</a> | <a href="#" class="wgcontroldenied" data-userid="{{ $wguser->id }}">verweigern</a>)</li>
                        @endforeach
                        </ul>
                    @else
                        <b>nein</b>
                    @endif
                    <br /><br />
                    WG-Datensatz:<br />
                    <code>
                        {{ Auth::user()->flatshare()->first() }}
                    </code>
                    <br /><br />
                    WG-Admin:
                    <code>
                        {{Auth::user()->flatshare()->first()->admin()->first()}}
                    </code>
                    <br /><br />
                    Alle WG Mitglieder:<br />
                    <ul>
                    @foreach ($flatshareUsers->users->where("flatsharejoin_at","<>",null) as $wguser)
                            <li><code>{{ $wguser }}</code></li>
                    @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
