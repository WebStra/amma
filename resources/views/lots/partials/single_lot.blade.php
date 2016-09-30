<div class="lot">
    <div class="lot-info">
        <div class="lot-name">
            {{ $lot->present()->renderName() }}
            @if(Route::currentRouteName() == 'my_lots')
                <div style="float: right; font-size: 12px;">
                    <a href="{{ route('edit_lot', [ 'lot' => $lot->id ]) }}" title="Edit lot"><i class="small material-icons" style="color: black">mode_edit</i></a>
                    <a href="{{ route('delete_lot', [ 'lot' => $lot->id ]) }}" title="Delete lot" onclick="return confirm('Are you sure ?');">
                        <i class="small material-icons" style="color: black">delete</i>
                    </a>
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
            <div class="label">
                <?php $vendor = $lot->vendor; ?>
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
            <div class="label wrap-countdown" style=''><span class="c-gray">Data expirari:</span>
                <div class="countdown" data-endtime="09/12/2016">
                    <span class="days">0</span>
                    <span class="hours">0</span>
                    <span class="minutes">0</span>
                    <span class="seconds">0</span>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div> {{-- /.lot-info --}}
    @if(count($lot->products))
        <?php $i = 1?>
        @foreach($lot->products as $item)
            @include('lots.partials.lot_product', [ 'collapse' => ($i > 3) ? true : false ])
            <?php $i++ ?>
        @endforeach

        <div class="btn-see-all">
            <span class="show">See all products</span>
            <span class="hidden">See less products</span>
        </div>
    @endif
</div>{{-- /.lot --}}