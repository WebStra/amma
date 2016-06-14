@extends('layout')

@section('breadcrumbs')
    <div class="container">
        <ul class="breadcrumbs">
            <li><a href="#" class="icon-home"></a></li>
            <li>&nbsp;Vendors&nbsp;\&nbsp;{{ $item->name }}</li>
        </ul>
    </div>
@endsection

@section('content')
    <section>
        <div class="container">
            <div class="row">
                @include('vendors.partials.left-sidebar')
                <div class="col l8 m7 s12">
                    @if(count($products = $item->products))
                        <ul class="elements divide-top bordered pd_8">
                            @foreach($products as $product)
                                @include('partials.products.big-item-block', ['item' => $product->product])
                            @endforeach
                        </ul>
                    @endif
                </div><!--right block-->
            </div>
        </div>
    </section>
@endsection