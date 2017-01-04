<li class="product">
    <div class="collapsible-header {{ $i == 1 ? 'active' : '' }}">
        <span>{{ $item->id }}</span>
        <p>{{ $item->present()->renderName() }}</p>
        <span class="line_animate"></span>
    </div>
    <div class="collapsible-body">
        <div class="display-table">
            <div class="wrapp_img with_hover td">
                <img src="{{ $item->present()->cover() }}" alt="" width="145" height="120">
            </div>
        </div>

        @include('partials.products.item.name')

        <div class="wrapp_info">
            @include('partials.products.item.price')

            @include('partials.products.item.stock')
        </div>
    </div>
</li>