@extends("layouts.app", ["title" => "Auswahl"])

@section('headcss')
    <link href="{{ asset('css/modules/purchase.css') }}" rel="stylesheet">
@endsection

@section('headjs')
    <script src="{{ asset('js/wgpurchase.js') }}"></script>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card wgpurchaselist">
                    <div class="card-header">{{ __('Einkaufsliste') }}</div>
                    <div class="card-body">
                        <a href="{{ route("purchaselist") }}" id="purchaseaddbutton" class="btn btn-primary wgButton">
                            {{ __('Neues Zeug hinzufügen') }}
                        </a>
                        <div id="wgaddpurchase">
                            <div class="wgInputFieldWrapper profileinputhide" style="float: left">
                                <input id="profilgivenname_input" type="text"
                                       class="form-control wgInputField" name="profilgivenname"
                                       value=""autofocus autocomplete="off" />
                            </div>
                            <div class="wgInputFieldWrapper profileinputhide" style="float: left; margin-left: 2%">
                                <input id="profilgivenname_input" type="text"
                                       class="form-control wgInputField" name="profilgivenname"
                                       value=""autofocus autocomplete="off" />
                            </div>
                            <a href=""><span class="fad fa-cart-plus"></span></a>
                        </div>
                        <br />
                        <div class="wgpurchaseitemlist wgtable">
                            <div class="wgtr wgtitle">
                                <div class="wgtd">Name</div>
                                <div class="wgtd">Anzahl</div>
                                <div class="wgtd">Hinzugefügt am</div>
                                <div class="wgtd"></div>
                            </div>
                            @foreach(Auth::user()->flatshare()->first()->purchases->sortBy('created_at', SORT_NATURAL|SORT_FLAG_CASE)->where('user_id', null) as $purchaseitem)
                                <div class="wgtr wgtitle">
                                    <div class="wgtd">{{ $purchaseitem->name }}</div>
                                    <div class="wgtd">{{ $purchaseitem->count }}</div>
                                    <div class="wgtd">{{ ((new DateTime($purchaseitem->created_at, new DateTimeZone('UTC')))->setTimezone(new DateTimeZone('Europe/Berlin')))->format('d.m.Y H:i') }}</div>
                                    <div class="wgtd">-</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="card wgpurchaseboughtlist">
                    <div class="card-header">{{ __('Gekauftes Zeug') }}</div>
                    <div class="card-body">
                        <div class="wgboughtitemlist wgtable">
                            <div class="wgtr wgtitle">
                                <div class="wgtd">Name</div>
                                <div class="wgtd">Anzahl</div>
                                <div class="wgtd">Bewohner</div>
                                <div class="wgtd">Gekauft am</div>
                            </div>
                            @foreach(Auth::user()->flatshare()->first()->purchases->sortBy('created_at', SORT_NATURAL|SORT_FLAG_CASE)->where('user_id', '<>',null) as $purchaseitem)
                                <div class="wgtr wgtitle">
                                    <div class="wgtd">{{ $purchaseitem->name }}</div>
                                    <div class="wgtd">{{ $purchaseitem->count }}</div>
                                    <div class="wgtd">{{ $purchaseitem->user->username }}</div>
                                    <div class="wgtd">{{ ((new DateTime($purchaseitem->paid_at, new DateTimeZone('UTC')))->setTimezone(new DateTimeZone('Europe/Berlin')))->format('d.m.Y H:i') }}</div>

                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
