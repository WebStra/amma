@extends('layout')

@section('content')
    <section class="">
        <div class="container">
            <div class="row">
                @include('partials.dashboard.nav-bar')
                <div class="col l9 m7 s12">
                    @include('product.partials.dropzone_form')

                    <form method="post" action="{{ route('update_product', ['product' => $item]) }}"
                          class="form styled2 row validate-it" enctype="multipart/form-data">
                        @include('product.partials.form.index')
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