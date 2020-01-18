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
                        <div id="showCalHere"></div>
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
                            <div class="form-group row">
                                <label for="appointmenttitle_input" class="col-md-4 col-form-label text-md-right">{{ __('Titel') }}</label>
                                <div class="col-md-6">
                                    <div class="wgInputFieldWrapper">
                                        <input id="appointmenttitle_input" type="text"
                                               class="form-control wgInputField " name="appointmenttitle"
                                               placeholder="Titel"
                                               value="" autofocus />
                                    </div>
                                </div>
                                <div class="col-md-6 offset-4">
                                    <span id="titleerrorfield" class="invalid-feedback wgerrormessages"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="appointmentdesc_input" class="col-md-4 col-form-label text-md-right">{{ __('Beschreibung') }}</label>
                                <div class="col-md-6">
                                    <div class="wgInputFieldWrapper">
                                        <textarea id="appointmentdesc_input" class="form-control wgInputField " name="appointmentdesc" placeholder="Beschreibung">

                                        </textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 offset-4">
                                    <span id="descerrorfield" class="invalid-feedback wgerrormessages"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="appointmentdate_input" class="col-md-4 col-form-label text-md-right">{{ __('Datum') }}</label>
                                <div class="col-md-6">
                                    <div class="wgInputFieldWrapper">
                                        <input id="appointmentdate_input" type="date"
                                               class="form-control wgInputField " name="appointmentdate"
                                               value="" />
                                    </div>
                                </div>
                                <div class="col-md-6 offset-4">
                                    <span id="dateerrorfield" class="invalid-feedback wgerrormessages"></span>
                                </div>
                            </div>

                            <div class="form-group row">

                                <div class="col-md-7 offset-3">
                                    <input id="appointmentfullday_input" type="checkbox"
                                           class="form-check-input" name="appointmentfullday"
                                           checked="checked" />
                                    <label for="appointmentfullday_input" class="form-check-label text-md-right">{{ __('Ganztägig') }}</label>
                                </div>
                                <div class="col-md-6 offset-4">
                                    <span id="dateerrorfield" class="invalid-feedback wgerrormessages"></span>
                                </div>
                            </div>

                            <div class="form-group row wgfulldayrows">
                                <label for="appointmentstartat_input" class="col-md-6 col-form-label text-md-right">{{ __('Von (Uhrzeit)') }}</label>
                                <div class="col-md-4">
                                    <div class="wgInputFieldWrapper">
                                        <input id="appointmentstartat_input" type="time"
                                               class="form-control wgInputField " name="appointmentstartat"
                                               value="" />
                                    </div>
                                </div>
                                <div class="col-md-6 offset-4">
                                    <span id="startaterrorfield" class="invalid-feedback wgerrormessages"></span>
                                </div>
                            </div>

                            <div class="form-group row wgfulldayrows">
                                <label for="appointmentendat_input" class="col-md-6 col-form-label text-md-right">{{ __('Bis (Uhrzeit)') }}</label>
                                <div class="col-md-4">
                                    <div class="wgInputFieldWrapper">
                                        <input id="appointmentendat_input" type="time"
                                               class="form-control wgInputField " name="appointmentendat"
                                               value="" />
                                    </div>
                                </div>
                                <div class="col-md-6 offset-4">
                                    <span id="endaterrorfield" class="invalid-feedback wgerrormessages"></span>
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-md-7 offset-3">
                                    <input id="appointmentrecurringchk_input" type="checkbox"
                                           class="form-check-input" name="appointmentrecurringchk" />
                                    <label for="appointmentrecurringchk_input" class="form-check-label text-md-right">{{ __('Wiederkehrender Termin') }}</label>
                                </div>
                                <div class="col-md-6 offset-4">
                                    <span id="recurringchkerrorfield" class="invalid-feedback wgerrormessages"></span>
                                </div>
                            </div>

                            <div class="form-group row wgrecuuringrows">
                                <label for="appointmentrecurring_input" class="col-md-6 col-form-label text-md-right">{{ __('Wiederholen') }}</label>
                                <div class="col-md-4">
                                    <select id="appointmentrecurring_input" class="form-control" name="appointmentrecurring">
                                        <option value="0" selected="selected">täglich</option>
                                        <option value="1">wöchentlich</option>
                                        <option value="2">monatlich</option>
                                        <option value="3">jährlich</option>
                                    </select>
                                </div>
                                <div class="col-md-6 offset-4">
                                    <span id="recurringerrorfield" class="invalid-feedback wgerrormessages"></span>
                                </div>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-2">
                                    <button id="appointmentditbuttonsave" type="submit" class="btn btn-primary wgButton">
                                        {{ __('Termin speichern') }}
                                    </button>
                                    <input type="hidden" id="wgAppointmentUserId" name="wgAppointmentUserId" value="{{ Auth::id() }}" />
                                    <a href="{{ route("calendar") }}" id="appointmenteditbuttonabort" class="btn btn-primary wgButton">
                                        {{ __('Abbrechen') }}
                                    </a>
                                </div>
                                <div class="col-md-2 wgWaitWrapper">
                                    <span class="fas fa-spinner fa-pulse wgwaitspinner"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
