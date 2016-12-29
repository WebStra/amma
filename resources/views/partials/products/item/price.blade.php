<div class="price">
        <div class="curent_price">{{ $item->present()->renderPriceWithSale() }}</div>
        <div class="old_price">{{ $item->present()->renderOldPrice() }}</div>
</div>