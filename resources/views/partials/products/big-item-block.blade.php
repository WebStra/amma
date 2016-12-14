<li class="product_card">
    <div class="wrapp_img wrapp_countdown">
        @include('partials.products.item.info-label')
        <a href="{{ route('view_product', ['product' => $item->id]) }}"><img src="{{ $item->present()->cover() }}"></a>
    </div>
    <div class="content">
        @include('partials.products.item.name')
        <div class="price_wrapp">
            @include('partials.products.item.price')
        </div>
        <div class="col l6 m6 s12">
            <div class="colors cf">
                <span class="small">Colors:</span>
                <ul>
                    @foreach($item->colors as $color)
                        <li>
                            <span class="color_view"
                                  style="background-color:{{ $color->color_hash }}; border-color:#e0e0e0;"></span>
                        </li>
                    @endforeach
                </ul>
                <br>
                <span class="small">Items: {{$involved->count}}</span>
                <br>
                @include('partials.products.item.countdown')
            </div>
        </div>
        <div class="col l6 m6 s12">
            <form class="row childs_margin_top" method="post"
                  action="{{ route('involve_product_cancel', ['involved' => $involved->id]) }}">
                <button type="submit" class="full_width btn_base  put_in_basket bascket_button_style">
                    <span class="hide-on-med-only">Exit</span>
                </button>
            </form>
        </div>
        <br>
    <!--  @include('partials.products.item.stock') -->
    </div>
</li>