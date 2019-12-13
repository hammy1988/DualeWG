@extends("layouts.app", ["title" => "Auswahl"])

@section('headcss')
    <link href="{{ asset('css/management/flatshare.css') }}" rel="stylesheet">
@endsection

@section('headjs')
    <script src="{{ asset('js/wgflatsharemanagement.js') }}"></script>
@endsection

@section("content")
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8" id="wgFlatshareManagement">
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
                        <input type="hidden" id="wgAuthUserId" name="wgProfileUserId" value="{{ Auth::id() }}" />
                        <input type="hidden" id="wgAuthUserCrownCnd" name="wgAuthUserCrownCnd" value="{{ Auth::user()->crowncnt }}" />
                    </div>

                </div>
            </div>


            @if(Auth::user()->flatshare()->first()->users->where("flatsharejoin_at", null)->count() > 0)
            <div class="card">
                <div class="card-header">{{ __('WG Anfragen') }}</div>

                <div class="card-body">

                    <div class="form-group row">
                        <label class="col-md-12 col-form-label text-md-left">{{ __('WG-Anfragen kann nur der WG-König beantworten.') }}</label>
                    </div>
                    <div class="form-group row">
                        <ul class="wgFlatshareRequestList">
                            @foreach (Auth::user()->flatshare()->first()->users->sortBy('username', SORT_NATURAL|SORT_FLAG_CASE)->sortBy('name', SORT_NATURAL|SORT_FLAG_CASE)->sortBy('givenname', SORT_NATURAL|SORT_FLAG_CASE)->where("flatsharejoin_at", null) as $wguser)
                                <li id="wgUserCard_{{ $wguser->id }}" class="wgUserCard">
                                    <div class="wgUserTitle">
                                        <span class="wgUserGivenname">{{ $wguser->givenname }}</span>
                                        <span class="wgUserName">{{ $wguser->name }}</span>
                                        <span class="wgUserUsername">({{ $wguser->username }})</span>
                                    </div>
                                    <div class="wgUserActions">
                                        @if(Auth::user()->isFlatshareAdmin())
                                            <a href="#" class="wgrequestaccept" data-userid="{{ $wguser->id }}">
                                                <span class="fad fa-user-plus"></span>
                                                annehmen
                                            </a>
                                            <a href="#" class="wgrequestdenied" data-userid="{{ $wguser->id }}">
                                                <span class="fad fa-user-times"></span>
                                                ablehnen
                                            </a>
                                        @endif
                                    </div>
                                    <div class="wgrequesterrormessages">
                                        <span id="wgrequestfail_{{ $wguser->id }}" class="invalid-feedback wgrequestfail" role="alert">
                                                <strong>Da hat etwas nicht geklappt. Probiere es noch einmal.</strong>
                                        </span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endif


            <div class="card">
                <div class="card-header">{{ __('Deine Mitbewohner') }}</div>

                <div class="card-body">

                    <div class="form-group row">
                        <label class="col-md-12 col-form-label text-md-left">{{ __('Deine WG hat folgende Mitbewohner:') }}</label>
                    </div>
                    <div class="form-group row">


                        <ul class="wgFlatshareMemberList">
                        @foreach (Auth::user()->flatshare()->first()->users->sortBy('username', SORT_NATURAL|SORT_FLAG_CASE)->sortBy('name', SORT_NATURAL|SORT_FLAG_CASE)->sortBy('givenname', SORT_NATURAL|SORT_FLAG_CASE)->sortBy('flatsharejoin_at')->where("flatsharejoin_at","<>",null) as $wguser)
                            <li id="wgUserCard_{{ $wguser->id }}" class="wgUserCard">
                                @if($wguser->isFlatshareAdmin())
                                    <div class="wgUserCrown"><span class="fad fa-crown" id="wgCrown"></span></div>
                                @endif
                                <div class="wgUserTitle">
                                    <span class="wgUserGivenname">{{ $wguser->givenname }}</span>
                                    <span class="wgUserName">{{ $wguser->name }}</span>
                                    <span class="wgUserUsername">({{ $wguser->username }})</span>
                                </div>
                                <div class="wgUserInfos">
                                    <span>In der WG seit: </span><span>{{ ((new DateTime($wguser->flatsharejoin_at, new DateTimeZone('UTC')))->setTimezone(new DateTimeZone('Europe/Berlin')))->format('d.m.Y H:i') }}</span>
                                </div>
                                @if(Auth::user()->id == $wguser->id)
                                <div class="wgUserActions">
                                    <a href="#" class="wguserleave" data-userid="{{ $wguser->id }}"><span class="fad fa-user-times"></span> austreten</a>
                                </div>
                                @else
                                    @if(Auth::user()->isFlatshareAdmin())
                                        <div class="wgUserActions">
                                            <a href="#" class="wgadminchange" data-userid="{{ $wguser->id }}"><span class="fad fa-users-crown"></span> krönen</a>
                                            <a href="#" class="wguserremove" data-userid="{{ $wguser->id }}"><span class="fad fa-user-times"></span> entfernen</a>
                                        </div>
                                    @endif
                                @endif
                                <div class="wgremoveerrormessages">
                                    <span id="wgremovefail_{{ $wguser->id }}" class="invalid-feedback wgremovefail" role="alert">
                                            <strong>Da hat etwas nicht geklappt. Probiere es noch einmal.</strong>
                                    </span>
                                </div>
                            </li>
                        @endforeach
                        </ul>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-8" id="wgFlatshareLeaveSuccess">
            <div class="card">
                <div class="card-body wgLeaveSuccessWrapper">
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="wgLeaveSuccessWelcome">
                                Du bist aus der WG ausgetreten.
                            </div>
                            <div class="wgLeaveSuccessRedirect">
                                <a href="/">Weiter <span class="fad fa-chart-network"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
