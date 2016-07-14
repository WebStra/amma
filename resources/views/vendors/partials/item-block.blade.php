<li class="product_card">
    <div class="wrapp_img wrapp_countdown">
        <a href="{{ route('view_vendor', ['slug' => $item->slug]) }}" class=""><img src="{{ $item->present()->cover() }}"></a>
    </div>
    <div class="content">
        <h4><a href="{{ route('view_vendor', ['slug' => $item->slug]) }}" class="user__vendor_title">{{ $item->present()->renderTitle() }}</a></h4>
        @include('partials.products.ratings')

        <div class="cf"></div>
        <div class="left_side labels">
            <div class="label"><span class="title">Cantitate:</span>&nbsp;({{ count($item->products) }}) produse</div>
        </div>
        <div class="right_side">
            <button class="btn_ btn_white small show_details" data-show-id="show_detail_product_{{ $i }}"><i class="icon-more"></i> Vezi detalii</button>
            <a href="{{ route('edit_vendor', ['slug' => $item->slug]) }}" class="btn_ btn_white small"><i class="icon-arrow-right"></i> Edit vendor</a>
            <a href="{{ route('add_product', ['slug' => $item->slug]) }}" class="btn_ btn_white small"><i class="icon-plus"></i> Add product</a>
        </div>

    </div>
    <div class="cf"></div>
    <div class="sub_content" id="show_detail_product_{{ $i }}">
        <div class="body">
            {{--{{ dd($item->products) }}--}}
            @foreach($item->products as $product)
                @include('vendors.partials.item_block_more_info')
            @endforeach
        </div>
    </div><!--subcontent-->
</li>