@foreach($similar as $item)
    <div class="item product">
        <div class="display-table">
            <div class="wrapp_img with_hover td wrapp_countdown">
                @include('product.partials.recommended.item.countdown',['lot'=>$item->lot])
                <img src="{{$item->present()->cover()}}" alt="" width="145" height="120"/>
            </div>
        </div>
        <h4 class="title"><a href="{{ route('view_product', ['product' => $item->id]) }}">{!! $item->present()->renderName() !!}</a></h4>
        <div class="wrapp_info">
            <div class="price">
                <div class="curent_price">{!! $item->present()->renderPriceWithSale() !!}</div>
                <div class="old_price">{!! $item->present()->renderOldPrice()!!}</div>
            </div>
            {{--<div class="stock">
                {{ $item->involved->sum('count') }} / {{$item->count}}
                <div class="progress">
                    <div class="determinate" style="width:{{($item->count) ?  number_format((100 * $item->involved->sum('count'))  / $item->count) : 0 }}%"></div>
                </div>
            </div>--}}
        </div>
    </div>
@endforeach