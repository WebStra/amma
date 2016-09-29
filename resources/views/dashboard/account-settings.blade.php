@extends('layout')
@section('content')
    <section class="">
        <div class="container">
            <div class="row">
                @include('partials.dashboard.nav-bar')
                <div class="col l9 m7 s12">
                    <div class="col s12">
                        <ul class="tabs">
                            <li class="tab"><a
                                        href="#personal_data" {{ Session::has('activeclass') ? (Session::get('activeclass') == 'update_settings' ? 'class=active' : '') : '' }}>DATE
                                    PERSONALE</a></li>
                            <li class="tab"><a
                                        href="#change_password" {{ Session::has('activeclass') ? (Session::get('activeclass') == 'update_password' ? 'class=active' : '') : '' }}>MODIFICĂ
                                    PAROLA</a></li>
                        </ul>
                    </div>
                    <div id="personal_data" class="col s12 tab_content">
                        <form action="{{route('update_settings')}}" method="POST" class="styled2 row"
                              enctype="multipart/form-data">
                            <?php $fields = ['fname', 'lname', 'phone', 'email']; ?>
                            @foreach($fields as $field)
                                @include('partials.errors.settings-error',['field' => $field])
                            @endforeach
                            <div class="col l12 m12 s12">
                                <div class="file-field input-field">
                                    <div class="wrapp_img left settings_avatar_image">
                                        <img src="{{  Auth::user()->present()->cover() }}" height="78" width="78"
                                             id="preview_image">
                                        <label for="photo">
                                            <i class="material-icons">assignment_ind</i>
                                        </label>
                                        <input type="file" id="photo" name="photo" class="avatar"
                                               value="{{ Auth::user()->present()->cover()}}">
                                    </div>
                                    <p class="left settings_avatar_format">* PNG, JPG minim 76x76px, proportie 1:1</p>
                                </div>
                            </div>
                            <div class="col l6 m6 s12">
                                <div class="input-field">
                                    <span class="label">NUMELE</span>
                                    <input type="text" name="fname"
                                           value="{{ old('fname') ? : Auth::user()->profile->firstname }}"
                                           placeholder="Ex: Ion">
                                </div>
                            </div>
                            <div class="col l6 m6 s12">
                                <div class="input-field">
                                    <span class="label">PRENUMELE</span>
                                    <input type="text" name="lname"
                                           value="{{ old('lastname') ? : Auth::user()->profile->lastname }}"
                                           placeholder="Ex: Ciobanu">
                                </div>
                            </div>
                            <div class="col l6 m6 s12">
                                <div class="input-field vendor_edit_phone">
                                    <span class="label">TELEFON</span>
                                    <input type="tel" required name="phone" placeholder="XXXXXXXX"
                                           value="{{ old('phone') ? : isset(Auth::user()->profile->phone) ? Auth::user()->profile->phone : '' }}"
                                           length="8">
                                    <span class="country_code">+373</span>
                                </div>
                            </div>
                            <div class="col l6 m6 s12">
                                <div class="input-field">
                                    <span class="label">EMAIL</span>
                                    <input type="email" name="email" value="{{ old('email') ? : Auth::user()->email }}"
                                           placeholder="Ex: maria@gmail.com">
                                </div>
                            </div>
                            {{csrf_field()}}
                            <div class="col l8 m12 s12 offset-l2 profile_settings_submit">
                                <input type="submit" class="btn btn_base center-block full_width" value="Trimite">
                            </div>
                        </form>
                    </div>
                    <div id="change_password" class="col s12 tab_content">
                        <form action="{{route('update_password')}}" method="POST" class="styled2 row">
                            @include('partials.errors.settings-error',[ 'field' => 'password' ])
                            @include('partials.errors.settings-error',[ 'field' => 'old_password' ])
                            <div class="col l6 m6 s12">
                                <div class="input-field">
                                    <span class="label">PAROLA NOUA</span>
                                    <input type="password" name="password">
                                </div>
                            </div>
                            <div class="col l6 m6 s12">
                                <div class="input-field">
                                    <span class="label">CONFIRMA PAROLA</span>
                                    <input type="password" name="password_confirmation">
                                </div>
                            </div>
                            <div class="col l6 m6 s12">
                                <div class="input-field">
                                    <span class="label">PAROLA CURENTA</span>
                                    <input type="password" name="old_password">
                                </div>
                            </div>
                            {{csrf_field()}}
                            <div class="col l8 m12 s12 offset-l2 profile_settings_submit">
                                <input type="submit" class="btn btn_base center-block full_width" value="Trimite">
                            </div>
                        </form>
                    </div>
                    <!--right block-->
                </div>
            </div>
    </section>
    </section>
@endsection
