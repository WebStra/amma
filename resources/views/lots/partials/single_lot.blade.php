<div class="lot">
    <div class="lot-info">
        <div class="lot-name">
            {{ $lot->present()->renderName() }}
            @if(Route::currentRouteName() == 'my_lots')
                <div style="float: right; font-size: 12px;">
                    @if(in_array($lot->verify_status, array('expired','declined')))
                        <a href="{{ route('edit_lot', [ 'lot' => $lot->id ]) }}" title="Edit lot"><i class="small material-icons" style="color: black">mode_edit</i></a>
                    @endif
                    @if(in_array($lot->verify_status, array('expired','declined')))
                        <a href="{{ route('delete_lot', [ 'lot' => $lot->id ]) }}" title="Delete lot" onclick="return confirm('Are you sure ?');">
                            <i class="small material-icons" style="color: black">delete</i>
                        </a>
                    @endif
                </div>
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

                <div class="label" style=''>
                    <div class="user-rating">
                        <?php $positivePercent = sprintf('%s%%', $vendor->present()->renderPozitiveVotes()); ?>
                        <span class="stars"><span class="bg" style="width: {{ $positivePercent }}"></span></span>
                        <span>{{ $positivePercent }}</span>
                        <span class="c-gray"> ({{ $vendor->likes()->count() }} de votari)</span>
                    </div>
                </div>
            @endif
            <div class="label">
                <div class="c-gray">Status: <span class="status-lot {{$lot->verify_status}}">{{$lot->verify_status}}</span></div>
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

