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
                <div class="card-header">{{ __('Deine WG') }}</div>

                <div class="card-body">

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Deine WG') }}</label>

                        <div class="col-md-6">
                            <div class="wgInputFieldWrapper_Show">
                                <span>{{ Auth::user()->flatshare->name }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Vollständiger WG Name') }}</label>

                        <div class="col-md-6">
                            <div class="wgInputFieldWrapper_Show">
                                <span>{{ Auth::user()->flatshare->name . '#' . Auth::user()->flatshare->tagid }}</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card">
                <div class="card-header">{{ __('Deine Mitbewohner') }}</div>

                <div class="card-body">

                    <div class="form-group row">
                        <label class="col-md-12 col-form-label text-md-left">{{ __('Deine WG hat folgende Mitbewohner:') }}</label>
                    </div>
                    <div class="form-group row">


                        <ul class="wgFlatshareMemberList">
                        @foreach (Auth::user()->flatshare()->first()->users->sortBy('username', SORT_NATURAL|SORT_FLAG_CASE)->sortBy('name', SORT_NATURAL|SORT_FLAG_CASE)->sortBy('givenname', SORT_NATURAL|SORT_FLAG_CASE)->where("flatsharejoin_at","<>",null) as $wguser)
                            <li>
                                <span class="wgFlatshareMemberGivenname">{{ $wguser->givenname }}</span>
                                <span class="wgFlatshareMemberName">{{ $wguser->name }}</span>
                                <span class="wgFlatshareMemberUsername">({{ $wguser->username }})</span>
                            </li>
                        @endforeach
                        </ul>
                    </div>

                </div>
            </div>

            <div class="card">
                <div class="card-header">{{ __('WG Anfragen') }}</div>

                <div class="card-body">

                    <div class="form-group row">
                        <label class="col-md-12 col-form-label text-md-left">{{ __('WG-Anfragen kann nur der WG-König beantworten.') }}</label>
                    </div>
                    <div class="form-group row">
                        <ul class="wgFlatshareMemberList">
                            @foreach (Auth::user()->flatshare()->first()->users->sortBy('username', SORT_NATURAL|SORT_FLAG_CASE)->sortBy('name', SORT_NATURAL|SORT_FLAG_CASE)->sortBy('givenname', SORT_NATURAL|SORT_FLAG_CASE)->where("flatsharejoin_at", null) as $wguser)
                                <li>
                                    <span class="wgFlatshareMemberGivenname">{{ $wguser->givenname }}</span>
                                    <span class="wgFlatshareMemberName">{{ $wguser->name }}</span>
                                    <span class="wgFlatshareMemberUsername">({{ $wguser->username }})</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
