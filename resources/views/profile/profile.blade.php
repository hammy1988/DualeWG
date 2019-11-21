@extends("layouts.app", ["title" => "Profil"])

@section('headcss')
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
@endsection

@section("content")

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Ihre Profil Informationen') }}</div>

                    <div class="card-body">
                        Username: <br>
                        E-Mail-Adresse: <br>
                        BierBierBier!
                    </div>
                </div>

                <div class="logininfo"> Sie sind angemeldet als: <a href=""> NAME </a>  | <a href=" {{route('logout')}}"       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">{{__('(Logout)')}}  </a>



                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>

                </div>

            </div>
        </div>
    </div>




@endsection

