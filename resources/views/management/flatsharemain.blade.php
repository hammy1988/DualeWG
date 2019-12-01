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
                        <label class="col-md-12 col-form-label text-md-left">{{ __('Folgende Mitbewohner sind zusammen mit dir in der WG:') }}</label>
                    </div>
                    <div class="form-group row">

                        <ul class="wgFlatshareMemberList">

                        </ul>
                    </div>

                </div>
            </div>

            <div class="card">
                <div class="card-header">{{ __('WG Anfragen') }}</div>

                <div class="card-body">

                    Deine WG

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
