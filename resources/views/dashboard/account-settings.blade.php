
@extends('layout')
@section('content')
    <section class="">
        <div class="container">
            <div class="row">
                @include('partials.dashboard.nav-bar')
                <div class="col l9 m7 s12">
                <div class="col s12">
                  <ul class="tabs">
                    <li class="tab"><a  class="active"  href="#personal_data">DATE PERSONALE</a></li>
                    <li class="tab"><a href="#change_password">MODIFICĂ PAROLA</a></li>
                  </ul>
                </div>
                <div id="personal_data" class="col s12 tab_content">
                <form action="{{route('setupdate')}}" method="POST" class="form styled2 row" enctype="multipart/form-data">
                    @include('partials.errors.list')
                    <div class="col l12 m12 s12">
                      <div class="file-field input-field">
                        <div class="wrapp_img left">
                          <img src="{{  Auth::user()->present()->cover() }}" height="78" width="78" id="preview_image">
                        </div>
                        <div class="left">
                          <div class="btn_ btn_base input_file xsmall">
                            <span>Încarcă o poză</span>
                            <input type="file" name="photo" class="avatar" value="{{ Auth::user()->present()->cover()}}">
                          </div>
                        </div>
                        <p class="left">* PNG, JPG minim 76x76px, proportie 1:1</p>
                      </div>
                    </div>
                    <div class="col l6 m6 s12">
                      <div class="input-field">
                      <span class="label">NUMELE</span>
                        <input type="text" name="fname" value="{{ old('fname') ? : Auth::user()->profile->firstname }}" placeholder="Ex: Ion">
                      </div>
                    </div>
                    <div class="col l6 m6 s12">
                      <div class="input-field">
                      <span class="label">PRENUMELE</span>
                        <input type="text" name="lname" value="{{ old('lastname') ? : Auth::user()->profile->lastname }}" placeholder="Ex: Ciobanu">
                      </div>
                    </div>
                    <div class="col l6 m6 s12">
                      <div class="input-field">
                      <span class="label">TELEFON</span>
                        <input type="text" name="phone" value="{{ old('phone') ? : Auth::user()->profile->phone }}" placeholder="Ex: 070 323 677">
                      </div>
                    </div>
                    <div class="col l6 m6 s12">
                      <div class="input-field">
                      <span class="label">EMAIL</span>
                        <input type="email" name="email" value="{{ old('email') ? : Auth::user()->email }}" placeholder="Ex: maria@gmail.com">
                      </div>
                    </div>
                    {{csrf_field()}}
                    <div class="col l8 m12 s12 offset-l2">
                        <input type="submit" class="btn btn_base center-block full_width" value="Trimite">
                    </div>
                  </form>
                </div>
         <div id="change_password" class="col s12 tab_content">
          <form action="{{route('updatepassword')}}" method="POST" class="form styled2 row">
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
                <span class="label">PAROLA VECHE</span>
                  <input type="password" name="old_password">
                </div>
              </div>
              {{csrf_field()}}
              <div class="col l8 m12 s12 offset-l2">
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
