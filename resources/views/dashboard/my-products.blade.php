@extends('layout')

@section('content')
    <section class="history_buy">
        <div class="container">
            <div class="row">
                @include('partials.dashboard.nav-bar')

                <div class="col l9 m7 s12">
                    @include('categories.partials.sort_form')
                    <ul class="elements divide-top bordered pd_8">
                        @if(count($vendors))
                            @foreach($vendors as $vendor)
                                @foreach($vendor->products as $item)
                                    @include('partials.products.item-block')
                                @endforeach
                            @endforeach
                        @else
                            <p>You don't have any products.</p>
                        @endif
                    </ul>
                </div><!--right block-->
            </div>
        </div>
    </section>
@endsection