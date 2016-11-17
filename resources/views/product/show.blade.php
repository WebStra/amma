@extends('layout')

@section('meta')
    @include('partials.shares.shares_social')
@endsection

@section('content')
    <section class="produs">
        <div class="container">
            <div class="row">
                <div class="col l4 m6 s12">
                    @if(count($item->images))
                        @include('product.partials.item.gallery-slider')
                    @endif
                </div>
                <div class="col l5 m6 s12 product_info">
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
                            <div class="pie" data-procent="10"
                                 style="animation-delay: -{{ $item->present()->getSalesPercent() }}%"></div>
                            {{ $item->present()->getSalesPercent() }}% este vândut
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
                            <div class="item product">
                                <div class="display-table">
                                    <div class="wrapp_img with_hover td wrapp_countdown">
                                        <div class="countdown" data-endtime="12/8/2015">
                                            <span class="days"></span>
                                            <span class="hours"></span>
                                            <span class="minutes"></span>
                                            <span class="seconds">12</span>
                                        </div>
                                        <div class="hover">
                                            <a href="#">
                                                <i class="icon-favorite"></i>
                                                Adaugă la Favorite
                                            </a>
                                            <a href="#">
                                                <i class="icon-basket"></i>
                                                Adaugă în coș
                                            </a>
                                        </div>
                                        <img src="assets/images/produs.jpg" alt=""/>
                                    </div>
                                </div>
                                <h4 class="title"><a href="produs_interior.php">SONY EXPERIA BN-100</a></h4>
                                <div class="wrapp_info">
                                    <ul class="star_rating" data-rating_value="1">
                                        <li class="icon-star"></li>
                                        <li class="icon-star"></li>
                                        <li class="icon-star"></li>
                                        <li class="icon-star"></li>
                                        <li class="icon-star"></li>
                                    </ul>
                                    <div class="price">
                                        <div class="curent_price">8 987 Lei</div>
                                        <div class="old_price">11 987 Lei</div>
                                    </div>
                                    <div class="stock">
                                        22/50
                                        <div class="progress">
                                            <div class="determinate" style="width: 42%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item product">
                                <div class="display-table">
                                    <div class="wrapp_img with_hover td wrapp_countdown">
                                        <div class="countdown" data-endtime="12/8/2015">
                                            <span class="days"></span>
                                            <span class="hours"></span>
                                            <span class="minutes"></span>
                                            <span class="seconds">12</span>
                                        </div>
                                        <div class="hover">
                                            <a href="#">
                                                <i class="icon-favorite"></i>
                                                Adaugă la Favorite
                                            </a>
                                            <a href="#">
                                                <i class="icon-basket"></i>
                                                Adaugă în coș
                                            </a>
                                        </div>
                                        <img src="assets/images/produs.jpg" alt=""/>
                                    </div>
                                </div>
                                <h4 class="title"><a href="produs_interior.php">SONY EXPERIA BN-100</a></h4>
                                <div class="wrapp_info">
                                    <ul class="star_rating" data-rating_value="1">
                                        <li class="icon-star"></li>
                                        <li class="icon-star"></li>
                                        <li class="icon-star"></li>
                                        <li class="icon-star"></li>
                                        <li class="icon-star"></li>
                                    </ul>
                                    <div class="price">
                                        <div class="curent_price">8 987 Lei</div>
                                        <div class="old_price">11 987 Lei</div>
                                    </div>
                                    <div class="stock">
                                        22/50
                                        <div class="progress">
                                            <div class="determinate" style="width: 42%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{--@foreach($same as $product)--}}
                            {{--@include('partials.products.item-block')--}}
                            {{--@endforeach--}}
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- / container-->
    </section>
    @include('partials.fb-comments')
@endsection