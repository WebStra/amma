@extends('layout')
@section('content')
    <section class="">
        <div class="container">
            <div class="row">
                @include('partials.dashboard.settings')
                <div class="col l9 m7 s12">
                    <div class="profile-settings">
                        <h4>Editeaza profilul</h4>
                        <hr color="#eee">
                        <form action="{{route('update_settings')}}" method="POST" class="styled2 row"
                              enctype="multipart/form-data">
                            <?php $fields = ['fname', 'lname', 'phone', 'email']; ?>
                            @foreach($fields as $field)
                                @include('partials.errors.settings-error',['field' => $field])
                            @endforeach
                            <div class="col l12 m12 s12">
                                <div class="col s2">
                                    <span class="label">Avatar</span>
                                </div>
                                <div class="col s10">
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
                            </div>
                            <div class="col l12 m6 s12">
                                <div class="col s2">
                                    <span class="label">NUMELE</span>
                                </div>
                                <div class="col s10">
                                    <div class="input-field">
                                        <input type="text" name="fname"
                                               value="{{ old('fname') ? : Auth::user()->profile->firstname }}"
                                               placeholder="Ex: Ion">
                                    </div>
                                </div>
                            </div>
                            <div class="col l12 m6 s12">
                                <div class="col s2">
                                    <span class="label">PRENUMELE</span>
                                </div>
                                <div class="col s10">
                                    <div class="input-field">
                                        <input type="text" name="lname"
                                               value="{{ old('lastname') ? : Auth::user()->profile->lastname }}"
                                               placeholder="Ex: Ciobanu">
                                    </div>
                                </div>
                            </div>
                            <div class="col l12 m6 s12">
                                <div class="col s2">
                                    <span class="label">TELEFON</span>
                                </div>
                                <div class="col s10">
                                    <div class="input-field vendor_edit_phone">
                                        <input type="tel" required name="phone" placeholder="XXXXXXXX"
                                               value="{{ old('phone') ? : isset(Auth::user()->profile->phone) ? Auth::user()->profile->phone : '' }}"
                                               length="8">
                                        <span class="country_code">+373</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col l12 m6 s12">
                                <div class="col s2">
                                    <span class="label">EMAIL</span>
                                </div>
                                <div class="col s10">
                                    <div class="input-field">
                                        <input type="email" name="email" value="{{ old('email') ? : Auth::user()->email }}"
                                               placeholder="Ex: maria@gmail.com">
                                    </div>
                                </div>
                            </div>
                            {{csrf_field()}}
                            <div class="col l8 m12 s12 offset-l2 profile_settings_submit">
                                <input type="submit" class="btn btn_base center-block full_width" value="Salveaza modificarile">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
