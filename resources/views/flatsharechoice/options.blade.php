@extends("layouts.flatsharechoice", ["title" => "Auswahl"])

@section("content")
    <h1>WG Auswahl</h1>
    <div id="dashContent">
        <ul>
            <li><a href="{{route('flatsharechoicecreate')}}">neue WG erstellen</a></li>
            <li><a href="{{route('flatsharechoicejoin')}}">einer bestehender WG beitreten</a></li>
        </ul>
    </div>
@endsection
