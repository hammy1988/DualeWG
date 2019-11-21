@extends("layouts.app", ["title" => "Auswahl"])

@section('headcss')
    <link href="{{ asset('css/wgchoice.css') }}" rel="stylesheet">
@endsection

@section('headjs')

@endsection

@section("content")
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('WG Auswahl') }}</div>

                <div class="card-body">


                    <div class="wgChoiceOptions">
                        <a href="{{route('flatsharechoicecreate')}}">neue WG <br />erstellen</a>
                        <a href="{{route('flatsharechoicejoin')}}">einer bestehender <br />WG beitreten</a>
                    </div>
                </div>
            </div>
            <div class="logininfo"> Sie sind angemeldet als: <a href="{{ route('profile') }}"> {{Auth::user()->givenname}} {{Auth::user()->name}} </a>  | <a href=" {{route('logout')}}"       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">{{__('(Logout)')}}  </a>



                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
