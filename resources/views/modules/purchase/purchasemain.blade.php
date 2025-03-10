@extends("layouts.app", ["title" => "Einkaufsliste"])

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
                        <div class="form-group row">
                            <a href="{{ route("purchaselist") }}" id="newproductbutton"
                               class="btn btn-primary wgButton">
                                {{ __('Neues Produkt hinzufügen') }}
                            </a>

                            <div class="col-md-10" id="wgaddpurchase">
                                <div class="wgpurchaseFieldWrapper purchaseaddname">
                                    <div class="wgInputFieldWrapper">
                                        <input id="purchaseaddname_input" type="text"
                                               class="form-control wgInputField" name="purchaseaddname"
                                               placeholder="Produkt"
                                               value="" autofocus autocomplete="off"/>
                                    </div>

                                    <div class="invalid-feedback wgerrormessages">
                                        <div>
                                            <span id="nameerrorfield"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="wgpurchaseFieldWrapper purchaseaddcount">
                                    <div class="wgInputFieldWrapper">
                                        <input id="purchaseaddcount_input" type="text"
                                               class="form-control wgInputField" name="purchaseaddcount"
                                               placeholder="Anzahl"
                                               value="" autofocus autocomplete="off"/>
                                    </div>
                                    <div class="invalid-feedback wgerrormessages">
                                        <div>
                                            <span id="counterrorfield"></span>
                                        </div>
                                    </div>
                                </div>

                                <a href="#" id="purchaseaddbutton" class="purchaseaddbutton"><span
                                        class="fad fa-cart-plus"></span></a>
                                <a href="#" id="purchasecancelbutton" class="purchasecancelbutton"><span
                                        class="fad fa-ban"></span></a>
                            </div>

                        </div>





                        <div class="wgpurchaseitemlist wgtable">
                            <div class="wgtr wgtitle">
                                <div class="wgtd">Name</div>
                                <div class="wgtd" style="text-align: center">Anzahl</div>
                                <div class="wgtd" style="text-align: center">Hinzugefügt am</div>
                                <div class="wgtd"></div>
                            </div>
                            @foreach(Auth::user()->flatshare()->first()->purchases->sortBy('created_at', SORT_NATURAL|SORT_FLAG_CASE)->where('user_id', null) as $purchaseitem)
                                <div id="purchaserownotpaid_{{ $purchaseitem->id }}" class="wgtr">
                                    <div class="wgtd">{{ $purchaseitem->name }}</div>
                                    <div class="wgtd" style="text-align: center">{{ $purchaseitem->count }}</div>
                                    <div
                                        class="wgtd" style="text-align: center">{{ ((new DateTime($purchaseitem->created_at, new DateTimeZone('UTC')))->setTimezone(new DateTimeZone('Europe/Berlin')))->format('d.m.Y H:i') }}</div>
                                    <div class="wgtd" style="text-align: right">
                                        <a href="#" class="purchaseboughtbutton"
                                           data-purchaseid="{{ $purchaseitem->id }}"><span
                                                class="fad fa-cart-arrow-down"></span></a>
                                        <a href="#" class="purchasedeletebutton" data-purchaselist="notpaid"
                                           data-purchaseid="{{ $purchaseitem->id }}"><span
                                                class="fad fa-trash-alt"></span></a>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="card wgpurchaseboughtlist">
                    <div class="card-header">{{ __('Gekaufte Produkte') }}</div>
                    <div class="card-body">
                        <div class="wgboughtitemlist wgtable">
                            <div class="wgtr wgtitle">
                                <div class="wgtd">Name</div>
                                <div class="wgtd" style="text-align: center">Anzahl</div>
                                <div class="wgtd">Bewohner</div>
                                <div class="wgtd" style="text-align: center">Gekauft am</div>
                                <div class="wgtd">&nbsp;</div>
                            </div>
                            @foreach(Auth::user()->flatshare()->first()->purchases->sortBy('paid_at', SORT_NATURAL|SORT_FLAG_CASE, true)->where('user_id', '<>',null) as $purchaseitem)
                                <div id="purchaserowpaid_{{ $purchaseitem->id }}" class="wgtr">
                                    <div class="wgtd">{{ $purchaseitem->name }}</div>
                                    <div class="wgtd" style="text-align: center">{{ $purchaseitem->count }}</div>
                                    <div class="wgtd">{{ $purchaseitem->user->username }}</div>
                                    <div
                                        class="wgtd" style="text-align: center">{{ ((new DateTime($purchaseitem->paid_at, new DateTimeZone('UTC')))->setTimezone(new DateTimeZone('Europe/Berlin')))->format('d.m.Y H:i') }}</div>
                                    <div class="wgtd" style="text-align: right">
                                        <a href="#" class="purchasebuyagainbutton"
                                           data-purchaseid="{{ $purchaseitem->id }}"><span
                                                class="fad fa-sync"></span></a>
                                        <a href="#" class="purchasedeletebutton" data-purchaselist="paid"
                                           data-purchaseid="{{ $purchaseitem->id }}"><span
                                                class="fad fa-trash-alt"></span></a>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
