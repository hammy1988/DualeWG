@extends("layouts.flatsharechoice", ["title" => "Auswahl"])

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
        </div>
    </div>
</div>
@endsection
