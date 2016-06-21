@extends('layout')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                @include('vendors.partials.left-sidebar')
                <div class="col l8 m7 s12">
                    @if(count($products = $item->products))
                        <ul class="elements divide-top bordered pd_8">
                            @foreach($products as $product)
                                @include('partials.products.big-item-block', ['item' => $product])
                            @endforeach
                        </ul>
                    @else
                        <p>This vendor don't have a products.</p>
                    @endif
                </div><!--right block-->
            </div>
        </div>
    </section>
@endsection