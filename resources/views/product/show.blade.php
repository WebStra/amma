@extends('layout')

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
                    @include('product.partials.item.notification')
                    <h1>{{ $item->present()->renderName() }}</h1>

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
                            <div class="pie" data-procent="10"
                                 style="animation-delay: -{{ $item->present()->getSalesPercent() }}s"></div>
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
                <div class="col l3 m12 s12 product_vendor_block">
                    @include('partials.about-seller')
                </div>

                @include('product.partials.item.involved_list')
            </div>
        </div><!-- / container-->
    </section>

    @include('partials.fb-comments')
@endsection