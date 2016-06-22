@extends('layout')

@section('content')
    <section class="produs">
        <div class="container">
            <div class="row">
                <div class="col l4 m6 s12">
                    {{--todo: do not forgot to enable .--}}
                    {{--@include('product.partials.gallery-slider')--}}

                    @include('partials.about-seller')
                </div>
                <div class="col l5 m6 s12 product_info">
                    <h1>{{ $item->present()->renderName() }}</h1>
                    <ul class="star_rating" data-rating_value="4">
                        <li class="icon-star"></li>
                        <li class="icon-star"></li>
                        <li class="icon-star"></li>
                        <li class="icon-star"></li>
                        <li class="icon-star"></li>
                    </ul>
                    <span class="star_rating_info">875 păreri</span>

                    <div class="display-table td_bordered_right display-list_bloks-m-down">
                        <div class="td">
                            @if($item->sale > 0)
                                <p class="price">{{ $item->present()->renderPriceWithSale() }}</p>
                                <p class="old_price">{{ $item->present()->renderPrice() }}</p>
                            @else
                                <p class="price">{{ $item->present()->renderPrice() }}</p>
                            @endif
                        </div>

                        <div class="td sell_amount">
                            <div class="pie" data-procent="10" style="animation-delay: -67s"></div>
                            67% este vândut
                        </div>
                    </div>

                    <div class="count_down">
                        <h5>PÂNĂ LA FINELE OFERTEI</h5>
                        <div class="countdown big" data-endtime="{{ $item->present()->endDate() }}"> <!-- m/d/Y -->
                            <span class="wrapp_span">
                              <span class="days">{{ $item->present()->diffEndDate()->d }}</span>
                              ZILE
                            </span>
                            <span class="wrapp_span">
                              <span class="hours">{{ $item->present()->diffEndDate()->h }}</span>
                              ORE
                            </span>
                            <span class="wrapp_span">
                              <span class="minutes">{{ $item->present()->diffEndDate()->i }}</span>
                              MINUTE
                            </span>
                            <span class="wrapp_span">
                              <span class="seconds">{{ $item->present()->diffEndDate()->s }}</span>
                              SECUNDE
                            </span>
                        </div>
                    </div>

                    <div class="sell_info display-table td_bordered_right">
                        <div class="td">
                            <h5>PARTICIPANTI</h5>
                            <p>7/10</p>
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

                    <form class="row childs_margin_top">
                        <div class="counting col l6 m6 s12">
                            <div class="wrapp_input">
                                <span class="minus left in"><i class="icon-minus"></i></span>
                                <input type="text" readonly="readonly" value="4">
                                <span class="plus right in"><i class="icon-plus"></i></span>
                            </div>
                        </div>
                        <div class="col l6 m6 s12">
                            <a href="#" class="btn_ full_width btn_base  put_in_basket"><i class="icon-basket"></i><span
                                        class="hide-on-med-only"><!--Adaugă în coș-->Учавствовать</span></a>
                        </div>
                    </form>

                    <div class="row">
                        <div class="col s12">
                            <ul class="tabs" style="width: 100%;">
                                <li class="tab" style="width: 50%;"><a class="active" href="#about_product">DESPRE
                                        PRODUS</a></li>
                                <li class="tab" style="width: 50%;"><a href="#feedback">FEEDBACK</a></li>
                                <div class="indicator" style="right: 235px; left: 0px;"></div>
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
                        <div id="feedback" class="feedback_rating col s12 tab_content" style="display: none;">
                            <h6>Lasati un feedbak</h6>
                            <div class="starbox">
                                <div class="positioner">
                                    <div class="stars">
                                        <div class="ghost" style="display: none; width: 0px;"></div>
                                        <div class="colorbar" style="width: 0px;"></div>
                                        <div class="star_holder">
                                            <div class="star star-0"></div>
                                            <div class="star star-1"></div>
                                            <div class="star star-2"></div>
                                            <div class="star star-3"></div>
                                            <div class="star star-4"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div><!--product_info-->
                <div class="col l3 m12 s12">
                    <div class="bordered  elements">
                        <div class="block_title">EI AU PROCURAT DEJA</div>

                        @include('product.partials.bought-block')

                    </div>
                </div>
            </div>
        </div><!-- / container-->
    </section>

    {{--@include('partials.fb-comments')--}}
@endsection