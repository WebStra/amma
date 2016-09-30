<div class="product" {{ isset($collapse) ? $collapse ? 'collapse' : '' : '' }}>
    <div class="product-content">
        <div class="wrap-img">
            <img src="{{ $item->present()->cover(null, '/upload/products/385/1470752847_2ca6957f36bc17bb06b3001f8b5b994b.jpg') }}"
                 alt="image from lot">
        </div>
        <div class="name">{{ $item->present()->renderName()  }}</div>
        <div class="wrap-info">

            <div class="block-inline">
                <div class="clearfix"></div>
                <div class="group-labels">
                    @if($subcategory = $item->subcategory)
                        <div class="label"><span class="c-gray">Subcategory: </span>
                            <a href="{{ route('view_sub_category', [ $subcategory->category->slug, $subcategory->slug]) }}">{{ $subcategory->present()->renderName() }}</a>
                        </div>
                    @endif
                    <div class="label" style="width:70px;"><span class="c-gray">New Price:</span>
                        {{ $item->present()->renderPrice($item
                            ->present()
                            ->renderNewPrice(), $item->present()->renderCurrency('sign'))
                        }}
                    </div>
                    <div class="label" style="width:70px;"><span class="c-gray">Old Price:</span>
                        {{ $item->present()->renderPrice($item
                            ->present()
                            ->renderOldPrice(), $item->present()->renderCurrency('sign'))
                        }}
                    </div>
                    <div class="label" style="width:50px;"><span class="c-gray">Sale:</span>{{ $item->present()->renderSalePercent() }}%</div>
                </div>
            </div> {{-- /.block-inline --}}

            <div class="block-inline group-labels model-2">
                <div class="label label-available"><span class="c-gray">Available: </span> 14 items
                </div>
                <div class="label label-size"><span class="c-gray">Size: </span> 7, 8, 9, 9.5, 10, 20,
                    10.4, 13, 14, 15
                </div>
                <div class="label label-color">
                    <span class="c-gray">Colors: </span>
                    <ul class="group-colors">
                        <input type="radio" name='color' value="1" id="c_1">
                        <label for="c_1"
                                                                                   class="item"
                                                                                   style='background-color:#faa;'></label>
                        <input type="radio" name='color' value="2" id="c_2"><label for="c_2"
                                                                                   class="item"
                                                                                   style='background-color:#ffa;'></label>
                        <input type="radio" name='color' value="3" id="c_3"><label for="c_3"
                                                                                   class="item"
                                                                                   style='background-color:#f38;'></label>
                        <input type="radio" name='color' value="4" id="c_4"><label for="c_4"
                                                                                   class="item"
                                                                                   style='background-color:#5f0;'></label>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div> {{-- /.product --}}