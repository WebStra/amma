@extends('layout')

@section('meta')
    @include('partials.shares.shares_social')
@endsection
@section('css')
    {!!Html::style('/assets/css/mycss.css')!!}
@endsection

@section('content')
    <section class="produs single_produs">
        <div class="container">
            <div class="row">
                <div class="col l9 m9 s12 s12">
                    <div class="lot">
                        <div class="lot-info">
                            <div class="lot-name">
                                {{ $lot->present()->renderName() }}
                            </div>
                            <div class="lot-info-bottom">
                                <?php $category = $lot->category; ?>
                                @if($category)
                                    <div class="label">
                                        <span class="c-gray">Categoria:</span><a href="{{ route('view_category', [ 'category' => $category->slug ]) }}">{{ $category->present()->renderName() }}</a>
                                    </div>
                                @endif
                                <?php $vendor = $lot->vendor; ?>

                                @if($vendor)
                                    <div class="label">
                                        <span class="c-gray">Magazin:</span><a href="{{ route('view_vendor', [ 'vendor' => $vendor->slug ]) }}">{{ $vendor->present()->renderTitle() }}</a>
                                    </div>
                                    <div class="label">
                                        <div class="user-rating">
                                            <span class="c-gray">Raitingul magazinului:</span>
                                            <?php $positivePercent = sprintf('%s%%', $vendor->present()->renderPozitiveVotes()); ?>
                                            <span class="stars"><span class="bg" style="width:{{ $positivePercent }}"></span></span>
                                            <span>{{ $positivePercent }}</span>
                                            <span class="c-gray"> ({{ $vendor->likes()->count() }} voturi)</span>
                                        </div>
                                    </div>
                                @endif
                                    <div class="label">
                                        <span class="c-gray">Suma lotului:</span><span class="c-gray">{{ $lot->yield_amount }}</span>
                                    </div>
                                    <div class="label">
                                        <span class="c-gray">Nr. de produse in lot:</span><span class="c-gray">{{ $procductinlot }}</span>
                                    </div>
                                @if(! empty($lot->present()->endDate()))
                                    <div class="label wrap-countdown" style=''><span
                                                class="c-gray">Data expirarii ofertei:</span>
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
                        </div>
                    </div>
                    <div class="row">
                        <div class="col l4 m4 s12">
                            @if(count($item->images))
                                @include('product.partials.item.gallery-slider')
                            @endif
                        </div>
                        <div class="col l8 m8 s12 product_info">
                            <h1>{{ $item->present()->renderName() }}</h1>
                            <div class="display-table td_bordered_right display-list_bloks-m-down">
                                <div class="td">
                                    @if($item->sale > 0)
                                        <p class="price">{{ $item->present()->renderPriceWithSale() }}</p>
                                        <p class="old_price">{{ $item->present()->renderOldPrice() }}</p>
                                    @else
                                        <p class="price">{{ $item->present()->renderPrice() }}</p>
                                    @endif
                                </div>

                                <div class="td sell_amount">
                                    <div class="pie" data-procent="{{$productItem[0]['totalItems']}}"
                                         style="animation-delay: -{{ $productItem[0]['salePercent'] }}s"></div>
                                    {{ $productItem[0]['salePercent'] }}% este vândut
                                </div>
                            </div>
                            @include('product.partials.item.countdown')

                            <div class="sell_info display-table td_bordered_right">
                                <div class="td">
                                    <h5>PARTICIPANTI</h5>
                                    <p>{{ count($item->involved()->active()->get()) }}</p>
                                </div>
                                <div class="td">
                                    <h5>REDUCERE</h5>
                                    <p>{{ $item->present()->renderSale() }}</p>
                                </div>
                                <div class="td">
                                    <h5>ECONOMISEȘTI</h5>
                                    <p>{{ $item->present()->economyPrice() }}</p>
                                </div>
                                <div class="td">
                                    <h5>CANTITATE</h5>
                                    <p>{{ $item->present()->renderCountItem() }}</p>
                                </div>
                            </div>

                            @include('product.partials.item.form')

                            <div class="row">
                                <div class="col s12">
                                    <p>{{ $item->description }}</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col s12">
                                    <ul class="tabs" style="width: 100%;">
                                        <li class="tab" style="width: 50%;"><a class="active cursor-default"
                                                                               href="#about_product">DESPRE
                                                PRODUS</a></li>
                                        <div class="indicator" style="right: 235px; left: 0px;"></div>
                                    </ul>
                                </div>
                                <div id="about_product" class="col s12 tab_content">
                                    <ul class="">
                                        @if(count($specifications = $item->getMetaFromGroup('spec')))
                                            @foreach($specifications as $spec)
                                                @include('product.partials.meta-spec')
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--product_info-->
                @if($lot = $item->lot)
                    @if($vendor = $lot->vendor)
                        <div class="col l3 m12 s12 product_vendor_block">
                            @include('partials.about-seller')
                        </div>
                    @endif
                @endif
                <div class="col l3 m12 s12 product_vendor_block">
                    @include('share.index')
                </div>
                @include('product.partials.item.involved_list')
            </div>
            <div class="cf row">
                <div class="col l12 m12 s12 divide-top">
                    <div class="elements bordered">
                        <div class="title">{{ strtoupper('same products') }}</div>
                        <div class="owl-carousel l-4">
                            <!----Related---->
                        @include('product.partials.recommended.related')
                        <!---END Related---->
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- / container-->
    </section>
    @include('partials.fb-comments')
@endsection