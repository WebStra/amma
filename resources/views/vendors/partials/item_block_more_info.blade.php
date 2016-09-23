<div class="model_info bordered">
    <div class="model_info_title_product">
        <span>Product:</span>
        <a href="{{route('view_product', ['product' => $product->id])}}" class="vendor__more_info_product_title" title="{{$product->present()->renderName()}}">
            {{ str_limit($product->present()->renderName(), 30) }} </a>
    </div>
    @foreach($product->involved()->active()->get() as $involved)
        <div class="label half_width">
            <span class="title">{{ $involved->user->present()->renderName() }} x({{$involved->count}}
                ):</span>{{ $product->present()->renderInvolvedPriceSumm($involved->count) }}
        </div>
        <div class="label half_width"> <span class="title">Suma:</span> 200 EUR</div>
    @endforeach

    <div class="label half_width">
        <span class="title">Uzveri x(10):</span> Tetris
    </div>
    <div class="label half_width"> 
        <span class="title">Suma:</span> 200 EUR
    </div>
    <div class="label half_width">
        <span class="title">Uzveri x(10):</span> Tetris
    </div>
    <div class="label half_width"> 
        <span class="title">Suma:</span> 200 EUR
    </div>
    <div class="label half_width">
        <span class="title">Uzveri x(10):</span> Tetris
    </div>
    <div class="label half_width"> 
        <span class="title">Suma:</span> 200 EUR
    </div>
    <div class="label half_width">
        <span class="title">Uzveri x(10):</span> Tetris
    </div>
    <div class="label half_width"> 
        <span class="title">Suma:</span> 200 EUR
    </div>
    <div class="label half_width">
        <span class="title">Uzveri x(10):</span> Tetris
    </div>
    <div class="label half_width"> 
        <span class="title">Suma:</span> 200 EUR
    </div>
    <div class="label half_width">
        <span class="title">Uzveri x(10):</span> Tetris
    </div>
    <div class="label half_width"> 
        <span class="title">Suma:</span> 200 EUR
    </div>        
  
    <div class="total">TOTAL : <span>{{ $product->present()->renderPrice($product->present()->getSalesSumm()) }}</span>
    </div>
</div>
