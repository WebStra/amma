<li class="product_card">
    <div class="wrapp_img wrapp_countdown">
        <span class="info_label">
            <img src="{{ $item->present()->getInfoLabel() }}">
        </span>

        <div class="countdown" data-endtime="{{ $item->present()->endDate() }}">
            <span class="days">{{ $item->present()->diffEndDate()->d }}</span>
            <span class="hours">{{ $item->present()->diffEndDate()->h }}</span>
            <span class="minutes">{{ $item->present()->diffEndDate()->i }}</span>
            <span class="seconds">{{ $item->present()->diffEndDate()->s }}</span>
        </div>
        <img src="{{ $item->present()->cover() }}">
    </div>
    <div class="content">
        <h4><a href="{{ route('view_product', $item->id) }}" class="make_inherit">{{ $item->present()->renderNameSimple() }}</a></h4>
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

        <div class="stock">
            {{ $item->present()->renderPrice($item->present()->getSalesSumm()) }}
            /{{ $item->present()->renderPrice($item->present()->getTotalSumm()) }}
            <div class="progress">
                <div class="determinate" style="width: {{ $item->present()->getSalesPercent() }}%"></div>
            </div>
        </div>
    </div>
</li>