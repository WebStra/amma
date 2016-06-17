@extends('layout')

@section('content')
    <section class="">
        <div class="container">
            <div class="row">
                @include('partials.dashboard.nav-bar')
                <div class="col l9 m7 s12">
                    <ul class="elements divide-top bordered pd_8">
                    @foreach($vendors as $item)
                        @include('vendors.partials.item-block')
                    @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection