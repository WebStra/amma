<div class="product {{ isset($collapse) ? $collapse ? 'collapse' : '' : '' }}">
    <div class="product-content">
        <div class="wrap-img">
            <a href="{{ route('view_product', ['product' => $item->id]) }}">
                <img class="img-responsive" src="{{ $item->present()->cover(null, '/upload/products/385/1470752847_2ca6957f36bc17bb06b3001f8b5b994b.jpg') }}"
                 alt="{{ $item->present()->renderName() }}">
            </a>
        </div>
        <div class="name">
            <a href="{{ route('view_product', ['product' => $item->id]) }}">
                {{ $item->present()->renderName()  }}
            </a>
        </div>
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
                        {{ $item->present()->renderPriceWithSale()}}
                    </div>
                    <div class="label" style="width:70px;"><span class="c-gray">Old Price:</span>
                        {{ $item->present()->renderOldPrice() }}
                    </div>
                    <div class="label" style="width:50px;"><span
                                class="c-gray">Sale:</span>{{ $item->present()->renderSalePercent() }}%
                    </div>
                </div>
            </div> {{-- /.block-inline --}}

            @if(count($specs = $item->improvedSpecs))
                <div class="block-inline group-labels model-2">
                    <div class="label label-available"><span class="c-gray">Available: </span> {{ count($specs) }} items
                    </div>
                    <?php
                    $sizes = '';
                    $specs->each(function($spec) use (&$sizes, $specs){
                        if($spec->size)
                            if($specs->first()->id == $spec->id){
                                $sizes .= sprintf('%s,', $spec->size);
                            } elseif($specs->last()->id == $spec->id) {
                                $sizes .= sprintf(' %s', $spec->size);
                            } else {
                                $sizes .= sprintf(' %s,', $spec->size);
                            }
                    });
                    ?>
                    @if(! empty($sizes))
                        <div class="label label-size">
                            <span class="c-gray">Size: </span>&nbsp;{{ $sizes }}
                        </div>
                    @endif

                    <div class="label label-color">
                        <span class="c-gray">Colors: </span>
                        <ul class="group-colors">
                            <input type="radio" name='color' value="1" id="c_1">
                            <?php
                                $colors = [];

                                $specs->each(function($spec) use (&$colors, $specs){
                                    if($spec->color_hash)
                                        $colors[$spec->id] = $spec->color_hash;
                                });
                            ?>
                            @foreach($colors as $spec_id => $color)
                                <label for="spec_{{ $spec_id }}" class="item" style='background-color:{{ $color }};'></label>
                                <input type="radio" name='color' value="{{ $spec_id }}" id="spec_{{ $spec_id }}">
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div> {{-- /.product --}}