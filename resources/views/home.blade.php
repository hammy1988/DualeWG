@extends('layouts.app')

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

                    You are logged in!
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
        </div>
    </div>
</div>
@endsection
