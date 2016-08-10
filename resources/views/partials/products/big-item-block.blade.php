<li class="product_card">
    <div class="wrapp_img wrapp_countdown">
        @include('partials.products.item.info-label')
        @include('partials.products.item.countdown')
        <img src="{{ $item->present()->cover() }}">
    </div>
    <div class="content">
        @include('partials.products.item.name')
        <div class="price_wrapp">
            @if($item->sale > 0)
                <div class="price">{{ $item->present()->renderPriceWithSale() }}</div>
                <div class="old_price">{{ $item->present()->renderPrice() }}</div>
            @else
                <div class="price">{{ $item->present()->renderPrice() }}</div>
            @endif
        </div>
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
        </div>

        @if($item->user->id == \Auth::id())

            <div class="colors cf">
                <span class="small">Actions:</span>
                <ul>
                    <li><a href="{{ route('edit_product', ['product' => $item]) }}">Edit</a></li>
                    <li><a href="#">Delete</a></li>
                </ul>
            </div>

        @endif

       <!--  @include('partials.products.item.stock') -->
    </div>
</li>