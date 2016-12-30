<div class="product {{ isset($collapse) ? $collapse ? 'collapse' : '' : '' }}">
    <div class="product-content">
        <div class="wrap-img">
            <a href="{{ route('view_product', ['product' => $item->id]) }}">
                <img class="img-responsive"
                     src="{{ $item->present()->cover(null, '/upload/products/385/1470752847_2ca6957f36bc17bb06b3001f8b5b994b.jpg') }}"
                     alt="{{ $item->present()->renderName() }}">
            </a>
        </div>
        <div class="name">
            <a href="{{ route('view_product', ['product' => $item->id]) }}">
                {{ $item->present()->renderName()  }}
            </a>
        </div>
        @if($subcategory = $item->subcategory)
            <div class="label" style="margin-bottom: 5px;"><span class="c-gray">Subcategory: </span>
                <a href="{{ route('view_sub_category', [ $subcategory->category->slug, $subcategory->slug]) }}">{{ $subcategory->present()->renderName() }}</a>
            </div>
        @endif
        <div class="wrap-info">
            @foreach($item->specPrice as $specs)
                <div class="block-inline">
                    <div class="clearfix"></div>
                    <div class="group-labels">
                        <div class="label" style="width: 160px;">
                            <span class="c-gray"
                                  style="text-align: left;">Nume: {{ str_limit($specs->name,$limit=30,$end='..')}}</span>
                        </div>
                        <div class="label" style="width:80px;">
                            <span class="c-gray">New Price:</span>
                            <span>{{ $specs->new_price}} {{$item->lot->currency->sign}}</span>
                        </div>
                        <div class="label" style="width:80px;">
                            <span class="c-gray">Old Price:</span>
                            <span>{{ $specs->old_price }} {{$item->lot->currency->sign}}</span>
                        </div>
                        <div class="label" style="width:80px;">
                            <span class="c-gray">Sale:</span>
                            <span>{{ $specs->sale }} %</span>
                        </div>
                        @if(isset($specs->improvedSpecs))
                            @foreach($specs->improvedSpecs as $sizes)
                                <div class="label label-size">
                                    <span class="c-gray">Size: </span>
                                    <span>{{ $sizes->size }}</span>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div> {{-- /.block-inline --}}
                <br>
            @endforeach
        </div>
    </div>
</div> {{-- /.product --}}