@extends('layout')

@section('content')
    <section class="history_buy">
        <div class="container">
            <div class="row">
                @include('partials.dashboard.nav-bar')
                <div class="col l9 m7 s12">
                   {{-- @include('categories.partials.sort_form')--}}
                    <ul class="elements divide-top bordered pd_8">
                        @if(count($involved))
                            @foreach($involved as $item)
                                @include('partials.products.big-item-block', ['item' => $item->product,'lot'=>$item->product->lot,'count'=>$item->count])
                            @endforeach
                        @else
                            <p>You don't involve any products offer.</p>
                        @endif
                    </ul>
                </div><!--right block-->
            </div>
        </div>
    </section>
@endsection