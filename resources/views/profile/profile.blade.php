@extends("layouts.app", ["title" => "Profil"])

@section('headcss')
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
@endsection

@section("content")

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Ihre Profil Informationen') }}
                    </div>

                    <div class="card-body">
                        Vorname: {{Auth::user()->givenname}} <br>
                        Nachname: {{Auth::user()->name}}<br>
                        Username:  {{Auth::user()->username}}<br>
                        E-Mail-Adresse:  {{Auth::user()->email}}<br>
                        Meine WG:  @if(Auth::user()->hasActiveFlatshare())
                            Ist in der WG: <b><u>{{Auth::user()->flatshare()->first()->name}}</u></b>
                        @else
                            Oh, leider scheinst du keiner WG beigetreten zu sein!
                        @endif
                        <br>

                     </div>
                    <div> <button id="workonprofile">Mein Profil bearbeiten </button> </div>
                 </div>
            </div>
        </div>
    </div>




@endsection

