@extends("layouts.app", ["title" => "Profil"])

@section("content")
    <h1>Profil: </h1>
    <div id="dashContent">
        Username: <br>


        E-Mail:
    </div>

    <div class="logininfo"> Sie sind angemeldet als: <a href=""> NAME </a>  | <a href=" {{route('logout')}}"       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">{{__('(Logout)')}}  </a>



    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
@endsection
</div>
