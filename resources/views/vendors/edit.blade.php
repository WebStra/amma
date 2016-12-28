@extends('layout')

@section('content')
    <section class="">
        <div class="container">
            <div class="row">
                <div class="col s3">
                    @include('partials.dashboard.vendor-settings')
                </div>
                <div class="col l9 m7 s12">
                    <div class="profile-settings">
                        <h4>Editeaza magazinul</h4>
                        <hr color="#eee">
                        <div class="row">
                            <div class="col l12 m12 s12">
                                <form method="post" action="{{ route('update_vendor', ['slug' => $item->slug]) }}"
                                      enctype="multipart/form-data">
                                    @include('vendors.partials.form')
                                    {!! csrf_field() !!}
                                        <button type="submit" class="btn btn_base btn_submit profile_settings_submit">Modifica setarile</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="profile-delete">
                        <div class="row">
                            <div class="col s12">
                                <h4>Sterge magazinul</h4>
                                <hr color="#eee">
                                <div class="col s12">
                                    <a href="#" onclick="return confirm('Are you sure you want to delete vendor?');"><i class="material-icons">delete</i>Sterge magazinul</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection