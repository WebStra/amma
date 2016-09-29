@extends('layout')

@section('content')
    <section class="">
        <div class="container">
            <div class="row">
                @include('partials.dashboard.nav-bar')
                <div class="col l9 m7 s12">
                    <form action="{{ route('post_create_vendor') }}" class="row validate-it" enctype="multipart/form-data" method="post">
                        @include('vendors.partials.form')
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