<div class="col l3 m12 s12 product_vendor_block">
    <div class="bordered divide-top hide-on-small-only">
        <div class="block_title">DESPRE LOT</div>
        <div class="person_card">
            <div class="about_lot_single_prod">
                <span class="c-gray">Denumire:</span>
                <a href="{{ route('view_lot', [ 'id' => $lot->id ]) }}"
                   target="_blank">{{ $lot->present()->renderName() }}</a>
            </div>
            <?php $category = $lot->category; ?>
            @if($category)
                <div class="about_lot_single_prod">
                    <span class="c-gray">Categoria:</span>
                    <a href="{{ route('view_category', [ 'category' => $category->slug ]) }}">{{ $category->present()->renderName() }}</a>
                </div>
            @endif
            <?php $vendor = $lot->vendor; ?>
            <div class="about_lot_single_prod">
                <span class="c-gray">Suma lotului:</span> {{ $lot->yield_amount }}
            </div>
            <div class="about_lot_single_prod">
                <span class="c-gray">Livrare:</span> {{ $lot->yield_amount }}
            </div>
            @if(count($lot->lotDeliveryPayment))
            <div class="about_lot_single_prod">
                <span class="c-gray">Metoda de plata:</span>
                @foreach($lot->lotDeliveryPayment as $item)
                    {{ $item->title }}
                @endforeach
            </div>
            @endif
            <div class="about_lot_single_prod">
                <span class="c-gray">Nr. de produse in lot:</span> {{ $productinlot }}
            </div>
            <span class="c-gray">Data expirarii:</span>
            @if(! empty($lot->present()->endDate()))
                <div class="countdown" data-endtime="{{ $lot->present()->endDate() }}">
                    <span class="days">{{ $lot->present()->diffEndDate()->d }}</span>
                    <span class="hours">{{ $lot->present()->diffEndDate()->h }}</span>
                    <span class="minutes">{{ $lot->present()->diffEndDate()->i }}</span>
                    <span class="seconds">{{ $lot->present()->diffEndDate()->s }}</span>
                </div>
            @endif
            <div class="about_lot_single_prod">
                <span class="c-gray">{{$lot->description_delivery}}</span>
            </div>
            <div class="buttons row">
                <div class="col s12 padd_r_half">
                    <a href="{{ route('view_lot', [ 'id' => $lot->id ]) }}" target="_blank"
                       class="btn_ btn_base waves-effect waves-light f_small left full_width">Vezi
                        lotul</a>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>