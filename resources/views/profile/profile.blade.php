@extends("layouts.app", ["title" => "Profil"])

@section('headcss')
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
@endsection

@section('headjs')
    <script src="{{ asset('js/wgprofilechange.js') }}"></script>
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
                                <td id="tdgivenname">
                                    <span id="profilgivenname_show">{{Auth::user()->givenname}}</span>
                                    <div class="wgInputFieldWrapper">
                                        <input id="profilgivenname_input" type="text"
                                               class="form-control wgInputField profileinputhide" name="profilgivenname"
                                               value="{{Auth::user()->givenname}}"autofocus autocomplete="off" />
                                    </div>
                                </td>
                                <td> <span id="givennamechange" class="fad fa-pencil"></span> </td>
                                <td><span id="givennamechangeClipboard" class="fad fa-clipboard-check"></span></td>
                            </tr>
                            <tr>
                                <td> Nachname:</td>
                                <td id="name">
                                    <span id="profilname_show">{{Auth::user()->name}} </span>
                                    <div class="wgInputFieldWrapper">
                                        <input id="profilname_input" type="text"
                                               class="form-control wgInputField profileinputhide" name="profilname"
                                               value="{{Auth::user()->name}}" autofocus autocomplete="off" />
                                    </div>
                                </td>
                                <td> <span id="namechange" class="fad fa-pencil"></span></td>
                                <td><span id="namechangeClipboard" class="fad fa-clipboard-check"></span></td>
                            </tr>

                            <tr>
                                <td> E-Mail-Adresse:</td>
                                <td id="email">
                                    <span id="email_show">{{Auth::user()->email}} </span>
                                    <div class="wgInputFieldWrapper">
                                    <input id="email_input" type="text"
                                           class="form-control wgInputField profileinputhide" name="profilemail"
                                           value="{{Auth::user()->email}}" autofocus autocomplete="off" />
                                    </div>
                                </td>
                                <td><span id="emailchange" class="fad fa-pencil"></span></td>
                                <td><span id="emailchangeClipboard" class="fad fa-clipboard-check"></span></td>
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

