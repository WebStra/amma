<div class="model_info bordered">
    <div class="half_width label colors">
        <span class="title">Product:</span>
        <a href="{{route('view_product', ['product' => $product->id])}}" class="vendor__more_info_product_title">
            &nbsp;{{$product->present()->renderName()}}</a>
    </div>
    @foreach($product->involved()->active()->get() as $involved)
        <div class="label half_width">
            <span class="title">{{ $involved->user->present()->renderName() }} x({{$involved->count}}
                ):</span>&nbsp;{{ $product->present()->renderInvolvedPriceSumm($involved->count) }}
        </div>
    @endforeach
    <div class="total">TOTAL : <span>{{ $product->present()->renderPrice($product->present()->getSalesSumm()) }}</span>
    </div>
</div>