<div class="item product">
    @include('partials.products.item.info-label')
    <div class="display-table">
        <div class="wrapp_img with_hover td wrapp_countdown">
            @include('partials.products.item.countdown')

            @include('partials.products.item.hover')

            <img src="{{ $item->present()->cover() }}" alt="" width="279" height="180">
        </div>
    </div>

    @include('partials.products.item.name')

    <div class="wrapp_info">
        @include('partials.products.item.price')

        @include('partials.products.item.stock')
    </div>
</div>