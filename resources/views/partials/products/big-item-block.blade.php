<li class="product_card">
    <div class="wrapp_img wrapp_countdown">
        @include('partials.products.item.info-label')
        <a href="{{ route('view_product', ['product' => $item->id]) }}"><img class="img-responsive bascket_img"
                                                                             src="{{ $item->present()->cover() }}"></a>
    </div>
    <div class="content">
        <h4 class="title">
            <a class="product_name" href="{{route('view_single_prod_spec',['involve'=>$involved->product_hash])}}">{{ str_limit($item->present()->renderName(),$limit=20,$end='..') }}</a>
        </h4>
        <div class="price_wrapp">
            @include('partials.products.item.price')
        </div>
        <div class="col l6 m6 s12">
            <div class="colors cf">
                <span class="small">{{$meta->getMeta('involved-prod-items')}} {{$involved->count}}</span>
                <br>
                @if($item->lot->verify_status == 'verified')
                    @include('partials.countdown')
                @else
                    <span style="display: block; color: red;">{{$meta->getMeta('involved-epired')}}</span>
                @endif
            </div>
        </div>
        @if($item->lot->verify_status != 'expired')
        <div class="col l6 m6 s12">
            <form class="row " method="post"
                  action="{{ route('involve_product_cancel', ['involved' => $involved->id, 'product'=>$item->id]) }}">
                <button type="submit" class="full_width btn_base  put_in_basket bascket_button_style">
                    <span class="hide-on-med-only">{{$meta->getMeta('involved-product-exit')}}</span>
                </button>
            </form>
        </div>
        @endif
    </div>
</li>