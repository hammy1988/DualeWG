@extends("layouts.app", ["title" => "Kalender"])

@section('headcss')
    <link href="{{ asset('css/modules/appointment.css') }}" rel="stylesheet">
@endsection

@section('headjs')
    <script src="{{ asset('js/wgappointment.js') }}"></script>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Kalender') }}<span class="wgappointmentAddButton"><span class="fa fa-plus" id="wpappointmentAddButtonInner"></span></span></div>
                    <div class="card-body" id="calendarShow">
                        Hier könnte Ihr Termin stehen
                    </div>
                    <div class="card-body wgappointmentWaitWrapper" id="calendarLoad">
                        <span class="fas fa-spinner fa-pulse wgwaitspinner"></span>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">{{ __('Termine') }}<span class="wgappointmentAddButton"><span class="fa fa-plus"></span></span></div>
                    <div class="card-body" id="appointmentListShow">
                        <div id="wgappointmentlistContainer" class="wgappointmentlistWrapper">
                        </div>
                    </div>
                    <div class="card-body wgappointmentWaitWrapper" id="appointmentListLoad">
                        <span class="fas fa-spinner fa-pulse wgwaitspinner"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="wgOverlayWrapper" id="appointmentOverlayAdd">
            <div class="row justify-content-center wgOverlayInnerWrapper">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Termin hinzufügen') }}<span class="wgappointmentCloseButton"><span class="fa fa-times"></span></span></div>
                        <div class="card-body">
                            Hier könnte Ihr Termin stehen<br />
                            <br /><br /><br /><br /><br /><br /><br />
                            Hier könnte Ihr Termin stehen<br />
                            <br /><br /><br /><br /><br /><br /><br />
                            Hier könnte Ihr Termin stehen
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
