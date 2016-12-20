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
                    <div class="row">
                        <div class="col l4 m4 s12">
                            @if(count($item->images))
                                @include('product.partials.item.gallery-slider')
                            @endif
                        </div>
                        <div class="col l8 m8 s12 product_info">
                            <h1>{{ $item->present()->renderName() }}</h1>
                            <hr>
                            {{--<div class="row">
                                <div class="col l3 m3 s12">
                                    <h5>Valabil:</h5>
                                </div>
                                <div class="col l9 m9 s12">
                                    @include('product.partials.item.countdown')
                                </div>
                            </div>--}}
                            <br>
                            @if($item->lot->verify_status != 'expired')
                            <div class="row">
                                <div class="col l3 m3 s12">
                                    <h5>Status:</h5>
                                </div>
                                <div class="col l19 m9 s12">
                                    <div class="td sell_amount">
                                        <div class="pie" data-procent="{{$productItem[0]['totalItems']}}"
                                             style="animation-delay: -{{ $productItem[0]['salePercent'] }}s"></div>
                                        <span>{{ $productItem[0]['salePercent'] }} % este vândut</span>
                                    </div>
                                </div>
                            </div>
                            <br>
                            @if($lot->vendor->user->id !== \Auth::id())
                                @if(! $user_is_involved)
                                        <form method="post"
                                              action="{{ route('involve_product', ['product' => $item->id]) }}">
                                            <div class="row">
                                                <div class="col l3 m3 s12">
                                                    <h5>Produs:</h5>
                                                </div>
                                                <div class="product_select col l6 m9 s12">
                                                    <select name="select_product" class="browser-default">
                                                        <option value="0" selected> Select Box</option>
                                                        <option value="1">Short Option</option>
                                                        <option value="2">This Is A Longer Option</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col l3 m3 s12">
                                                    <h5>Cantitate:</h5>
                                                </div>
                                                <div class="col l19 m9 s12">
                                                    <div class="counting">
                                                        <div class="wrapp_input">
                                                            <span class="minus left in"><i
                                                                        class="icon-minus"></i></span>
                                                            <input type="number" readonly="readonly" value="1"
                                                                   name="count" max="{{$item->count - $item->involved->sum('count')}}">
                                                            <span class="plus right in"><i class="icon-plus"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col l12 m12 s12">
                                                    <button type="submit"
                                                            class="btn_ full_width btn_base put_in_basket product_involve">
                                                        <span class="hide-on-med-only"><!--Adaugă în coș-->Participa</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    @endif
                                @endif
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
                                                <div class="col l6 m4 s12">
                                                    <div class="display-table td_bordered_right display-list_bloks-m-down">
                                                        <div class="td">
                                                            <p class="price">{{ $item->present()->renderPriceWithSale() }}</p>
                                                            <p class="old_price">{{ $item->present()->renderOldPrice() }}</p>
                                                        </div>
                                                        <div class="td">
                                                            <span class="conver_mdl">≈ 5220 MDL</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if($user_is_involved)
                                                    @if($item->lot->verify_status =! 'expired')
                                                        <div class="col l3 m3 s12">
                                                            <form method="post"
                                                                  action="{{ route('involve_product_cancel', ['involved' => $involved->id]) }}">
                                                                <button type="submit"
                                                                        class="btn_ full_width btn_base  put_in_basket">
                                                                    <span class="hide-on-med-only">Exit</span>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                        <div class="sell_info display-table td_bordered_right">
                                            <div class="row">
                                                <div class="td col m3 s6">
                                                    <p>{{ count($item->involved()->active()->get()) }}</p>
                                                    <h6>PARTICIPANTI</h6>
                                                </div>
                                                <div class="td col m3 s6">
                                                    <p>{{ $item->present()->renderSale() }}</p>
                                                    <h6>REDUCERE</h6>
                                                </div>
                                                <div class="td col m3 s6">
                                                    <p>{{ $item->present()->economyPrice() }}</p>
                                                    <h6>ECONOMISEȘTI</h6>
                                                </div>
                                                <div class="td col m3 s6">
                                                    <p>{{ $item->present()->renderCountItem() }}</p>
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