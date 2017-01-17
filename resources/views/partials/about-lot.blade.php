<div class="bordered divide-top hide-on-small-only">
    <div class="block_title">DESPRE LOT</div>
    <div class="person_card">
        <div class="about_lot_single_prod">
            <span class="c-gray">Denumire:</span>
            <a href="{{ route('view_lot', [ 'id' => $lot->id ]) }}"
               target="_blank">{{ $lot->present()->renderName() }}</a>
        </div>
        @if(!empty($lot->present()->endDate()))
            <span class="c-gray">Timp Rămas:</span>
            @include('partials.countdown')
        @endif
        <?php $category = $lot->category; ?>
        @if($category)
            <div class="about_lot_single_prod">
                <span class="c-gray">Categoria:</span>
                <a href="{{ route('view_category', [ 'category' => $category->slug ]) }}">{{ $category->present()->renderName() }}</a>
            </div>
        @endif
        <div class="about_lot_single_prod">
            <span class="c-gray">Suma lotului:</span> {{ $lot->yield_amount }} {{$lot->currency->sign}}
        </div>
        @if(count($lot->lotDelivery))
            <div class="about_lot_single_prod">
                <span class="c-gray">Livrare:</span>
                <ul class="delivery_list_method">
                    @foreach($lot->lotDelivery as $item)
                        <li>{{ $item->methodDelivery->name }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(count($lot->lotDeliveryPayment))
            <div class="about_lot_single_prod">
                <span class="c-gray">Metoda de plata:</span>
                <ul class="delivery_list_method">
                    @foreach($lot->lotDeliveryPayment as $item)
                        <li>{{ $item->methodDelivery->name }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="about_lot_single_prod">
            <span class="c-gray">Nr. de produse in lot:</span> {{ $productinlot }}
        </div>
        {{--<div class="about_lot_single_prod">
            <span class="c-gray">{{$lot->description_delivery}}</span>
        </div>--}}
        <div class="buttons row">
            <div class="col s12 padd_r_half">
                <a href="{{ route('view_lot', [ 'id' => $lot->id ]) }}"
                   class="btn_ btn_base waves-effect waves-light f_small left full_width">Vezi
                    lotul</a>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>