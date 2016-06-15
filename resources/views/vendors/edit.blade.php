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
                    <form method="post" action="{{ route('edit_vendor', ['slug' => $item->slug]) }}" enctype="multipart/form-data">
                        @include('vendors.partials.form')
                        {!! csrf_field() !!}
                        <div class="col l12">
                            <button type="submit" class="btn btn_base btn_submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection