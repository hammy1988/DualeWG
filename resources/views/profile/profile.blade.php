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
                                <td>{{Auth::user()->givenname}}</td>

                            </tr>
                            <tr>
                                <td> Nachname:</td>
                                <td>{{Auth::user()->name}} </td>
                            </tr>
                            <tr>
                                <td> Username:</td>
                                <td>{{Auth::user()->username}} </td>
                            </tr>

                            <tr>
                                <td> E-Mail-Adresse:</td>
                                <td>{{Auth::user()->email}} </td>
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

                        <div id="ibimsmartin">test</div><br />
                        <div id="ibimsbutton">ich bin ein button ;)</div>

                        Meine WG:  @if(Auth::user()->hasActiveFlatshare())
                            Ist in der WG: <b><u>{{Auth::user()->flatshare()->first()->name}}</u></b>
                        @else
                            Oh, leider scheinst du keiner WG beigetreten zu sein!
                        @endif
                        <br>
                        <DIV id="mouselayer" style="z-index:100;left:200px;top:100px;height:35px;width:40px;position:absolute;bor der:1px
solid #000000;background-color:white;">


                            <DIV id="mouselayer" style="z-index:100;left:200px;top:100px;height:35px;width:40px;position:absolute;bor der:1px
solid #000000;background-color:white;">

                                <form name="formname">
                                    <table>
                                        <tr>
                                            <td><a onClick="document.formname.textfeldname.value ='test1'"><img src="test.png" width=30 height=30 border="0"></a></td>
                                            <td><a onClick="document.formname.textfeldname.value ='test2'"><img src="test.png" width=30 height=30 border="0"></a></td>
                                            <td><input type="text" name="textfeldname" value=""></td>
                                        </tr>
                                    </table>
                                </form>
                     </div>
                    <div>
                 </div>
            </div>
        </div>
    </div>




@endsection

