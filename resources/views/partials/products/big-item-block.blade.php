<li class="product_card">
    <div class="wrapp_img wrapp_countdown">
        @include('partials.products.item.info-label')
        <a href="{{ route('view_product', ['product' => $item->id]) }}"><img class="img-responsive bascket_img"
                                                                             src="{{ $item->present()->cover() }}"></a>
    </div>
    <div class="content">
        @include('partials.products.item.name')
        <div class="price_wrapp">
            @include('partials.products.item.price')
        </div>
        <div class="col l6 m6 s12">
            <div class="colors cf">
                <span class="small">Itemi: {{$involved->count}}</span>
                <br>
                @if($item->lot->verify_status == 'verified')
                    @include('partials.countdown')
                @else
                    <span style="display: block; color: red;">Oferta a expirat</span>
                @endif
                <a class="put_in_basket"
                   href="{{route('view_single_prod_spec',['involve'=>$involved->product_hash])}}" style="font-size: 14px; color: #ff6f00;">Detalii</a>
            </div>
        </div>
        @if($item->lot->verify_status != 'expired')
        <div class="col l6 m6 s12">
            <form class="row childs_margin_top" method="post"
                  action="{{ route('involve_product_cancel', ['involved' => $involved->id, 'product'=>$item->id]) }}">
                <button type="submit" class="full_width btn_base  put_in_basket bascket_button_style">
                    <span class="hide-on-med-only">Exit</span>
                </button>
            </form>
        </div>
        @endif
        <div class="col s12">
            @include('partials.products.item.stock')
        </div>
    </div>
</li>