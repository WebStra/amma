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
                <div class="col l9 m12 s12">
                    <div class="row">
                        <div class="col l4 m4 s12">
                            <div class="row">
                                <div class="col l12 m12 s12">
                                    @if(count($item->images))
                                        @include('product.partials.item.gallery-slider')
                                    @else
                                        <img class="img-responsive" src="/assets/images/product.jpg" alt="">
                                    @endif
                                </div>
                                <div class="col l12 m12 s12 product_vendor_block">
                                    <div class="bordered divide-top hide-on-small-only">
                                        <div class="block_title">DESCRIEREA LOTULUI</div>
                                        <div class="person_card">
                                            <div class="about_lot_single_prod">
                                                <span class="c-gray showmore">{{$lot->description_delivery}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col l8 m8 s12 product_info">
                            <h1>{{ $item->present()->renderName() }}</h1>
                            <hr>
                            {{--<span style="float: right; font-size: 13px; color: #aaa;">Codul produsului : <strong>{{$item->uniqid}}</strong></span>--}}
                            <br>
                            <!---Status-->
                            @if($item->lot->verify_status != 'expired')

                                {{--@if(! $user_is_involved)--}}
                                <form method="post"
                                      action="{{ route('involve_product', ['product' => $item->id]) }}">
                                    @if(count($item->colors) > 0)
                                        <input type="hidden" id="color_product" name="color_product"
                                               value="{{(isset($item->colors)) ? $item->colors->first()->id : ''}}">
                                    @endif
                                    @if(count($item->improvedSpecs))
                                        <input type="hidden" id="sizes_product" name="sizes_product"
                                               value="{{(isset($item->improvedSpecs)) ? $item->improvedSpecs->first()->id : ''}} ">
                                    @endif
                                    @if(count($item->specPrice) > 0)
                                        <div class="row display_form_items_inline">
                                            <div class="col l3 m3 s12">
                                                <h5>Produs:</h5>
                                            </div>
                                            <div class="product_select col l6 m9 s12">
                                                <select class="select_product_quantity"
                                                        name="select_product">
                                                    @foreach($item->specPrice as $prodSpec)
                                                        <option data-product-id="{{$prodSpec->id}}"
                                                                data-old-price="{{$prodSpec->old_price}}"
                                                                data-new-price="{{$prodSpec->new_price}}"
                                                                data-sale="{{$prodSpec->sale}}"
                                                                data-currency="{{$item->lot->currency->title}}"
                                                                value="{{$prodSpec->id}}">{{$prodSpec->name}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <br>
                                    @endif
                                <!--sizes-->
                                    @if(count($item->improvedSpecs) > 0)
                                        <div class="row display_form_items_inline">
                                            <div class="col l3 m3 s12">
                                                <h5>Marimi:</h5>
                                            </div>
                                            <div class="col l6 m9 s12 ">
                                                <ul class="sizes_product">
                                                    @if(count($item->specPrice->first()->improvedSpecs) > 0)
                                                        <?php $i = 1; ?>
                                                        @foreach($item->specPrice->first()->improvedSpecs as $size)
                                                            <li class="<?php if ($i == 1) {
                                                                echo 'active';
                                                            } ?>"
                                                                data-id="{{$size->id}}">{{$size->size}}</li>
                                                            <?php $i++; ?>
                                                        @endforeach
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                        <br>
                                    @endif
                                <!---Color-->
                                    @if(count($item->colors) > 0)
                                        <div class="row display_form_items_inline">
                                            <div class="col l3 m3 s12">
                                                <h5>Culori:</h5>
                                            </div>
                                            <div class="col l9 m9 s12">
                                                <ul class="color_product" style="height: 30px;">
                                                    <?php $i = 1; ?>
                                                    @foreach($item->specPrice->first()->improvedSpecs->first()->specColors as $color)
                                                        <li class="<?php if ($i == 1) echo 'active'; ?>"
                                                            data-id="{{$color->id}}"
                                                            data-count="{{$color->amount}}"
                                                            style="background: {{$color->color_hash}};"></li>
                                                        <?php $i++; ?>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    @endif
                                    <br>
                                    <div class="row display_form_items_inline">
                                        <div class="col l3 m3 s12">
                                            <h5>Cantitate:</h5>
                                        </div>
                                        <div class="col l19 m9 s12">
                                            <div class="counting">
                                                <div class="wrapp_input">
                                                            <span class="minus left in"><i
                                                                        class="icon-minus"></i></span>
                                                    <input type="number" readonly="readonly" value="1"
                                                           name="count"
                                                           max="{{ $item->present()->renderCountItem() }}">
                                                    <span class="plus right in"><i
                                                                class="icon-plus"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if($lot->vendor->user->id !== \Auth::id())
                                        <div class="product_submit_button">
                                            <button type="submit" name="type"
                                                    class="full_width btn_base product_involve" value="involve">
                                                <span>Participa</span>
                                            </button>
                                            {{--<button type="submit" name="type"
                                                    class="btn_buy full_width btn_base product_involve"
                                                    value="buy">
                                                <span>Cumpara</span>
                                            </button>--}}
                                        </div>
                                    @endif
                                    {{-- <div class="product_submit_button">
                                             <span style="color: red; font-size: 16px; font-weight: 600;" class="full_width product_involve">Stock epuizat!</span>
                                     </div>--}}
                                </form>

                            @else
                                <div class="row">
                                    <div class="col l3 m3 s12">
                                        <h5>Status:</h5>
                                    </div>
                                    <div class="col l19 m9 s12">
                                        <div class="td sell_amount">
                                            <span>Oferta a expirat!</span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <br>
                            <div class="row">
                                <div class="col s12">
                                    <div class="product_price_block">
                                        <div class="first_block_product">
                                            <div class="row">
                                                <div class="col l3 m3 s12">
                                                    <h5>Suma:</h5>
                                                </div>
                                                <div class="col l6 m9 s12">
                                                    <div class="td_bordered_right display-list_bloks-m-down">
                                                        @if(count($item->specPrice) > 0)
                                                            <div class="td">
                                                                <p class="price">
                                                                    <span>{{ $item->present()->renderPriceWithSale() }}</span>
                                                                </p>
                                                                <p class="old_price">
                                                                    <span>{{ $item->present()->renderOldPrice() }}</span>
                                                                </p>
                                                            </div>
                                                        @endif
                                                        @if($lot->currency->title != 'MDL')
                                                            <div class="td">
                                                                <div class="conver_mdl">
                                                                    ≈<span>{{$item->present()->convertAmount()}}</span>
                                                                    MDL
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="sell_info display-table td_bordered_right">
                                            <div class="row">
                                                <div class="td col m3 s6">
                                                    <p>{{ count($item->involved()->active()->get()) }}</p>
                                                    <h6>REZERVARI</h6>
                                                </div>
                                                @if(count($item->specPrice) > 0)
                                                    <div class="td col m3 s6">
                                                        <p id="salePrice">
                                                            <span>{{ $item->specPrice->first()->sale }}</span> %</p>
                                                        <h6>REDUCERE</h6>
                                                    </div>
                                                    <div class="td col m3 s6">
                                                        <p id="economy">
                                                            <span>{{$item->present()->economyPrice()}}</span> {{$item->lot->currency->title}}
                                                        </p>
                                                        <h6>ECONOMISEȘTI</h6>
                                                    </div>
                                                @endif
                                                <div class="td col m3 s6">
                                                    <p class="amount_products">{{ $item->present()->renderCountItem() }}</p>
                                                    <h6>CANTITATE</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 tab_content about_product">
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
                <div class="col l3 m12 s12">
                    <div class="row">
                        <div class="col l12 m12 s12 product_vendor_block">
                            @include('partials.about-lot')
                        </div>
                        @if($lot = $item->lot)
                            @if($vendor = $lot->vendor)
                                <div class="col l12 m12 s12 product_vendor_block">
                                    @include('partials.about-seller')
                                </div>
                            @endif
                        @endif
                        <div class="col l12 m12 s12 product_vendor_block">
                            @include('share.index')
                        </div>
                        <div class="col l12 m12 s12">
                            @include('product.partials.item.involved_list')
                        </div>
                    </div>
                </div>
            </div>
            <div class="cf row">
                <div class="col l12 m12 s12 divide-top">
                    <div class="elements bordered">
                        <div class="title">{{ strtoupper('same products') }}</div>
                        <div class="owl-carousel l-4">
                            <!--Related-->
                        @include('product.partials.recommended.related')
                        <!---END Related-->
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- / container-->
    </section>
    @include('partials.fb-comments')
@endsection
@section('js')
    <script>
    $(document).ready(function() {
        // Configure/customize these variables.
        var showChar = 156;  // How many characters are shown by default
        var ellipsestext = "...";
        var moretext = "{{ $meta->getMeta('show_more') }}";
        var lesstext = "{{ $meta->getMeta('show_less') }}";
        

        $('.showmore').each(function() {
            var content = $(this).html();
     
            if(content.length > showChar) {
     
                var c = content.substr(0, showChar);
                var h = content.substr(showChar, content.length - showChar);
     
                var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';
     
                $(this).html(html);
            }
     
        });
     
        $(".morelink").click(function(){
            if($(this).hasClass("less")) {
                $(this).removeClass("less");
                $(this).html(moretext);
            } else {
                $(this).addClass("less");
                $(this).html(lesstext);
            }
            $(this).parent().prev().toggle();
            $(this).prev().toggle();
            return false;
        });
    });
    </script>

@endsection


