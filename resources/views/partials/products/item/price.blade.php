<div class="price">
    @if($item->sale > 0)
        <div class="curent_price">{{ $item->present()->renderPriceWithSale() }}</div>
        <div class="old_price">{{ $item->present()->renderPrice() }}</div>
    @else
        <div class="curent_price">{{ $item->present()->renderPrice() }}</div>
    @endif
</div>