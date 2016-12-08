@extends('layout')
@section('content')
    <section class="">
        <div class="container">
            <div class="row">
                @include('partials.dashboard.settings')
                <div class="col l9 m7 s12">
                    <div class="profile-settings">
                        <h4>Schimba Parola</h4>
                        <hr color="#eee">
                        <form action="{{route('update_settings')}}" method="POST" class="styled2 row"
                              enctype="multipart/form-data">
                            <?php $fields = ['fname', 'lname', 'phone', 'email']; ?>
                            @foreach($fields as $field)
                                @include('partials.errors.settings-error',['field' => $field])
                            @endforeach
                            <div class="col l12 m12 s12">
                                <form action="{{route('update_password')}}" method="POST" class="styled2 row">
                                    @include('partials.errors.settings-error',[ 'field' => 'password' ])
                                    @include('partials.errors.settings-error',[ 'field' => 'old_password' ])

                                    <div class="col s3">
                                        <span class="label">PAROLA NOUA</span>
                                    </div>
                                    <div class="col l9 m9 s12">
                                        <div class="input-field">
                                            <input type="password" name="password" placeholder="Parola Noua">
                                        </div>
                                    </div>
                                    <div class="col s3">
                                        <span class="label">CONFIRMA PAROLA</span>
                                    </div>
                                    <div class="col l9 m9 s12">
                                        <div class="input-field">
                                            <input type="password" name="password_confirmation" placeholder="Confirmati Parola">
                                        </div>
                                    </div>

                                    <div class="col s3">
                                        <span class="label">PAROLA CURENTA</span>
                                    </div>
                                    <div class="col l9 m9 s12">
                                        <div class="input-field">
                                            <input type="password" name="old_password" placeholder="Parola Curenta">
                                        </div>
                                    </div>
                                    {{csrf_field()}}
                                    <div class="col l8 m12 s12 offset-l2 profile_settings_submit">
                                        <input type="submit" class="btn btn_base center-block full_width"
                                               value="Salveaza modificarile">
                                    </div>
                                </form>
                                <!--right block-->
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
        @endsection