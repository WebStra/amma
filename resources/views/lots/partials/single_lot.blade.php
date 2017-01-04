<div class="lot">
    <div class="lot-info">
        <div class="lot-name">
            {{ $lot->present()->renderName() }}
            @if(Route::currentRouteName() == 'my_lots' && (in_array($lot->verify_status, array('expired','declined')) or $lot->status == 'drafted'))
                @if($lot->sell_status != 'default' or $lot->status == 'drafted')
                    <div style="float: right; font-size: 12px;">
                        <a href="{{ route('edit_lot', [ 'lot' => $lot->id ]) }}" title="Edit lot"><i class="small material-icons" style="color: black">mode_edit</i></a>
                        <a href="{{ route('delete_lot', [ 'lot' => $lot->id ]) }}" title="Delete lot" onclick="return confirm('Are you sure ?');"> <i class="small material-icons" style="color: black">delete</i>
                        </a>
                    </div>
                @endif
            @endif
        </div>
        <div class="lot-info-bottom">
            <?php $category = $lot->category; ?>
            @if($category)
                <div class="label">
                    <span class="c-gray">Category:</span>&nbsp;
                    <a href="{{ route('view_category', [ 'category' => $category->slug ]) }}">{{ $category->present()->renderName() }}</a>
                </div>
            @endif
            <?php $vendor = $lot->vendor; ?>
            @if($vendor)
                <div class="label">
                    <span class="c-gray">Vendor:</span>&nbsp;
                    <a href="{{ route('view_vendor', [ 'vendor' => $vendor->slug ]) }}">{{ $vendor->present()->renderTitle() }}</a>
                </div>
            @endif
<!--             @if($vendor)
    <div class="label" style=''>
        <div class="user-rating">
            <?php $positivePercent = sprintf('%s%%', $vendor->present()->renderPozitiveVotes()); ?>
            <span class="stars"><span class="bg" style="width: {{ $positivePercent }}"></span></span>
            <span>{{ $positivePercent }}</span>
            <span class="c-gray"> ({{ $vendor->likes()->count() }} voturi)</span>
        </div>
    </div>
@endif -->
            <div class="label">
                <div class="c-gray">Suma vinzari: <span>{{$lot->yield_amount}} {{isset($lot->currency->title) ? $lot->currency->title : ''}}</span>
                </div>
            </div>
            <div class="label">
                <div class="c-gray">Suma acumulata:
                    <span>{{$lot->involvedTotalPrice->sum('price')}} {{isset($lot->currency->title) ? $lot->currency->title : ''}}</span></div>
            </div>
            @if(Route::currentRouteName() == 'my_lots')
                <div class="label">
                    <div class="c-gray">Comision: <span>{{$lot->comision}} MDL</span></div>
                </div>
            @endif
            <div class="label">
                <div class="c-gray">Nr. de cumparatori: <span>{{$lot->involved->groupBy('user_id')->count()}}</span>
                </div>
            </div>
            @if(! empty($lot->present()->endDate()))
                <div class="label wrap-countdown" style=''><span class="c-gray">Data expirari:</span>
                    <div class="countdown" data-endtime="{{ $lot->present()->endDate() }}">
                        <span class="days">{{ $lot->present()->diffEndDate()->d }}</span>
                        <span class="hours">{{ $lot->present()->diffEndDate()->h }}</span>
                        <span class="minutes">{{ $lot->present()->diffEndDate()->i }}</span>
                        <span class="seconds">{{ $lot->present()->diffEndDate()->s }}</span>
                    </div>
                </div>
            @endif
            @if(Route::currentRouteName() == 'my_lots')
                <div class="label">
                    <div class="c-gray">Statutul ofertei: <span class="status-lot {{$lot->verify_status}}">{{$lot->verify_status}}</span></div>
                </div>
                @if($lot->verify_status == 'expired' && $lot->sell_status == 'default' && $lot->status != 'drafted')
                    <a href="" class="waves-effect waves-light btn">Vând</a>
                    <a href="" class="waves-effect waves-light btn red">Nu vând</a>
                @endif
                @if($lot->sell_status != 'default')
                    <div class="label">
                        <div class="c-gray">Statutul vânzari: <span class="status-lot {{$lot->sell_status}}">{{$lot->sell_status == 'accept' ? 'Vândut' : 'Nu s-a vândut'}}</span></div>
                    </div>
                @endif
            @endif
            <div class="clearfix"></div>
        </div>
    </div> {{-- /.lot-info --}}
    @if(count($lot->products))
        <?php $i = 1?>
        @foreach($lot->products as $item)
            @include('lots.partials.lot_product', [ 'collapse' => ($i > 1) ? true : false ])
            <?php $i++ ?>
        @endforeach

        <div class="btn-see-all">
            <span class="show">See all products</span>
            <span class="hidden">See less products</span>
        </div>
    @endif
</div>{{-- /.lot --}}

