@extends("layouts.app", ["title" => "Neue WG erstellen"])

@section('headcss')
    <link href="{{ asset('css/wgchoice.css') }}" rel="stylesheet">
@endsection

@section('headjs')

@endsection

@section("content")
    <h1>WG erstellen</h1>
    <div id="dashContent">
    </div>
@endsection
