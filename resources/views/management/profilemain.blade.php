@extends("layouts.app", ["title" => "Profil"])

@section('headcss')
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
@endsection

@section('headjs')
    <script src="{{ asset('js/wgprofilechange.js') }}"></script>
@endsection

@section("content")

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Deine Profil Informationen') }}</div>

                    <div class="card-body">
                    @csrf

                    <!-- Ab hier sind die bearbeitbaren Auflistungen  -->
                        <div class="form-group row">
                            <label for="givenname" class="col-md-4 col-form-label text-md-right">{{ __('Vorname') }}</label>
                            <div class="col-md-6">
                                <div class="wgInputFieldWrapper_Show profileinputprefilled">
                                    <span id="profilgivenname_span">{{ Auth::user()->givenname }}</span>
                                </div>
                                <div class="wgInputFieldWrapper profileinputhide">
                                    <input id="profilgivenname_input" type="text"
                                           class="form-control wgInputField" name="profilgivenname"
                                           value="{{ Auth::user()->givenname }}"autofocus autocomplete="off" />
                                </div>
                                @error('givenname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <div class="wgInputFieldWrapper_Show profileinputprefilled">
                                    <span id="profilname_span">{{ Auth::user()->name }}</span>
                                </div>
                                <div class="wgInputFieldWrapper profileinputhide">
                                    <input id="profilname_input" type="text"
                                           class="form-control wgInputField " name="profilname"
                                           value="{{Auth::user()->name}}" autofocus autocomplete="off" />
                                </div>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Benutzername') }}</label>

                            <div class="col-md-6">
                                <div class="wgInputFieldWrapper_Show">
                                    <span id="profileusername_span">{{ Auth::user()->username }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Adresse') }}</label>

                            <div class="col-md-6">
                                <div class="wgInputFieldWrapper_Show profileinputprefilled">
                                    <span id="profilemail_span">{{ Auth::user()->email }}</span>
                                </div>
                                <div class="wgInputFieldWrapper profileinputhide">
                                    <input id="profilemail_input" type="text"
                                           class="form-control wgInputField " name="profilemail"
                                           value="{{Auth::user()->email}}" autofocus autocomplete="off" />
                                </div>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4" id="profileeditstart">
                                <button id="profileditbuttonstart" type="submit" class="btn btn-primary wgButton">
                                    {{ __('Profil bearbeiten') }}
                                </button>
                            </div>
                            <div class="col-md-9 offset-md-3 profileinputhide" id="profileeditend">
                                <button id="profileditbuttonsave" type="submit" class="btn btn-primary wgButton">
                                    {{ __('Profil speichern') }}
                                </button>
                                <input type="hidden" id="wgProfileUserId" name="wgProfileUserId" value="{{ Auth::id() }}" />
                                <a href="{{ route("profile") }}" id="profileditbuttonabort" class="btn btn-primary wgButton">
                                    {{ __('Abbrechen') }}
                                </a>
                            </div>
                        </div>
                        <!-- Ab hier sind die nicht bearbeitbaren Auflistungen  -->

                        <div class="paragraphDiv">          <!-- gibt den Abstand zu den bearbeitbaren Listeneinträgen an -->
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">{{ __('Registriert seit:') }}</label>

                                <div class="col-md-6">
                                    <div class="wgInputFieldWrapper_Show">
                                        <span>{{ ((new DateTime(Auth::user()->created_at, new DateTimeZone('UTC')))->setTimezone(new DateTimeZone('Europe/Berlin')))->format('d.m.Y H:i') }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">{{ __('Letzte Änderung:') }}</label>

                                <div class="col-md-6">
                                    <div class="wgInputFieldWrapper_Show">
                                        <span id="profilupdatedat_span">{{ ((new DateTime(Auth::user()->updated_at, new DateTimeZone('UTC')))->setTimezone(new DateTimeZone('Europe/Berlin')))->format('d.m.Y H:i') }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">{{ __('WG-Zuordnung:') }}</label>

                                <div class="col-md-6">
                                    <div class="wgInputFieldWrapper_Show">
                                        <span>
                                            @if(Auth::user()->hasActiveFlatshare())
                                                {{ Auth::user()->flatshare()->first()->name }}
                                            @else
                                                Du bist aktuell in keiner WG
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                     </div>
                    <div>
                 </div>
            </div>
        </div>
    </div>




@endsection

