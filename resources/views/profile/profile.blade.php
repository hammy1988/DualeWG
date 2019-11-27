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
                        <a href="">Profil bearbeiten </a>
                    </div>

                    <div class="card-body">

                        <table id="infotable">
                            <tr>
                                <td>Vorname: </td>
                                <td>{{Auth::user()->givenname}}</td>
                                <td> <span class="fad fa-pencil"></span> </td>

                            </tr>
                            <tr>
                                <td> Nachname:</td>
                                <td>{{Auth::user()->name}} </td>
                                <td> <span class="fad fa-pencil"></span> </td>
                            </tr>


                            <tr>
                                <td> E-Mail-Adresse:</td>
                                <td>{{Auth::user()->email}} </td>
                                <td><span class="fad fa-pencil"></span> </td>
                            </tr>
                            <tr>
                                <td> Username:</td>
                                <td>{{Auth::user()->username}} </td>
                            </tr>
                            <tr>
                                <td> Registriert seit:</td>
                                <td>{{Auth::user()->created_at}} </td>
                            </tr>

                            <tr>
                                <td> Geändert am:</td>
                                <td>{{Auth::user()->updated_at}} </td>
                            </tr>
                        </table>

                        Meine WG:  @if(Auth::user()->hasActiveFlatshare())
                            Ist in der WG: <b><u>{{Auth::user()->flatshare()->first()->name}}</u></b>
                        @else
                            Oh, leider scheinst du keiner WG beigetreten zu sein!
                        @endif
                        <br>

                     </div>
                    <div>
                 </div>
            </div>
        </div>
    </div>




@endsection

