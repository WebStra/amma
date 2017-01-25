@extends('layout')

@section('content')
    <section class="history_buy">
        <div class="container">
            <div class="row">
                @include('partials.dashboard.nav-bar')
                <div class="col l9 m7 s12">
                    <ul class="elements divide-top bordered pd_8">
                        @if(isset($product) && count($product) > 0)
                            @foreach($product as $item)
                                    @include('partials.products.big-item-block', ['item' => $item['product'],'lot'=>$item['product']->lot,'involved'=>$item['involved']])
                            @endforeach
                        @else
                            <p>{{$meta->getMeta('involved-products-no-have')}}</p>
                        @endif
                    </ul>
                </div><!--right block-->
            </div>
        </div>
    </section>
@endsection