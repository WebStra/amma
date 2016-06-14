@extends('layout')

@section('breadcrumbs')
    <div class="container">
        <ul class="breadcrumbs">
            <li><a href="#" class="icon-home"></a></li>
            <li>Dashboard \ Create Vendor</li>
        </ul>
    </div>
@endsection

@section('content')
    <section class="">
        <div class="container">
            <div class="row">
                @include('partials.dashboard.nav-bar')
                <div class="col l9 m7 s12">
                    <form method="post" action="{{ route('post_create_vendor') }}">
                        <!--<div class="col l12 m12 s12">
                            <div class="file-field input-field">
                                <div class="wrapp_img left">
                                    <img src="/assets/images/no-avatar2.png" height="78" width="78">
                                </div>
                                <div class="left">
                                    <div class="btn_ btn_base input_file xsmall">
                                        <span>Logo</span>
                                        <input type="file" name="image" required class="avatar">
                                    </div>
                                </div>
                                <p class="left">* PNG, JPG minim 76x76px, proportie 1:1</p>
                            </div>
                        </div> -->
                        <div class="col l6 m6 s12">
                            <div class="input-field">
                                <span class="label">Denumirea</span>
                                <input type="text" required name="name" placeholder="Ex: Bucuria">
                                @include('partials.errors.error-field', ['field' => 'name'])
                            </div>
                        </div>

                        <div class="col l6 m6 s12">
                            <div class="input-field">
                                <span class="label">EMAIL</span>
                                <input type="email" required name="email" placeholder="">
                                @include('partials.errors.error-field', ['field' => 'email'])
                            </div>
                        </div>

                        <div class="col l6 m6 s12">
                            <div class="input-field">
                                <span class="label">TELEFON</span>
                                <input type="tel" required name="phone" placeholder="Ex: 070 323 677">
                                @include('partials.errors.error-field', ['field' => 'phone'])
                            </div>
                        </div>
                        <div class="col l6 m6 s12">
                            <div class="input-field">
                                <span class="label">DESCRIPTION</span>
                                <textarea name="description" placeholder=""></textarea>
                                @include('partials.errors.error-field', ['field' => 'description'])
                            </div>
                        </div>
                        {!! csrf_field() !!}
                        <div class="col l12">
                            <button type="submit" class="btn btn_base btn_submit">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection