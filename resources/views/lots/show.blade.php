@extends('layout')
@section('css')
    {!!Html::style('/assets/css/mycss.css')!!}
@endsection
@section('content')
    <div class="container">
        <div class="row">
                @if($vendor = $lot->vendor)
                    <div class="col l3 m12 s12 product_vendor_block">
                        @include('partials.about-seller')
                    </div>
                @endif
            <div class="col l9 m12 s12  show_single_lot list-lots">
                <div class="lot">
                    <div class="lot-info">
                        <div class="lot-name">
                            {{ $lot->present()->renderName() }}
                            @if(Route::currentRouteName() == 'my_lots')
                                <div style="float: right; font-size: 12px;">
                                    <a href="{{ route('edit_lot', [ 'lot' => $lot->id ]) }}" title="Edit lot"><i
                                                class="small material-icons" style="color: black">mode_edit</i></a>
                                    <a href="{{ route('delete_lot', [ 'lot' => $lot->id ]) }}" title="Delete lot"
                                       onclick="return confirm('Are you sure ?');">
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
                            <?php $vendor = $lot->vendor; ?>
                            @if($vendor)
                                <div class="label">
                                    <span class="c-gray">Vendor:</span>&nbsp;
                                    <a href="{{ route('view_vendor', [ 'vendor' => $vendor->slug ]) }}">{{ $vendor->present()->renderTitle() }}</a>
                                </div>

                                <div class="label" style=''>
                                    <div class="user-rating">
                                        <?php $positivePercent = sprintf('%s%%', $vendor->present()->renderPozitiveVotes()); ?>
                                        <span class="stars"><span class="bg"
                                                                  style="width: {{ $positivePercent }}"></span></span>
                                        <span>{{ $positivePercent }}</span>
                                        <span class="c-gray"> ({{ $vendor->likes()->count() }} de votari)</span>
                                    </div>
                                </div>
                            @endif
                            @if(! empty($lot->present()->endDate()))
                                <div class="label wrap-countdown" style=''><span class="c-gray">Data expirari:</span>
                                    @include('partials.countdown')
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
            </div>
        </div>
    </div>
@endsection