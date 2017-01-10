@extends('layout')

@section('meta')
    @include('partials.shares.shares_social')
@endsection
@section('css')
    {!!Html::style('/assets/css/mycss.css')!!}
@endsection

@section('content')
    <section class="produs">
        <div class="container">
            <div class="row">
                <div class="col l12 m12 s12">
                    <div class="row">
                        <div class="col l4 m4 s12">
                            @if(count($item->images))
                                @include('product.partials.item.gallery-slider')
                            @else
                                <img class="img-responsive" src="/assets/images/product.jpg" alt="">
                            @endif
                        </div>
                        <div class="col s8">
                            <div class="" >
                                <div class="" style="padding: 0 25px 25px;">

                                    <span style="float: right; font-size: 13px; color: #aaa;">Codul produsului : <strong>{{$item->uniqid}}</strong></span>
                                    <br>
                                    <!---Status---->
                                    <div class="row display_form_items_inline">
                                        <div class="col l12 m12 s12">
                                            <h5>Produs: <strong>{{$comand->specPrice->name}}</strong></h5>
                                        </div>
                                    </div>
                                    <br>
                                    <!--sizes--->
                                    @if(isset($comand->improvedSpec))
                                    <div class="row">
                                        <div class="col l12 m12 s12">
                                            <h5>Marime: <strong>{{$comand->improvedSpec->size}}</strong></h5>
                                        </div>
                                    </div>
                                    <br>
                                    @endif
                                    @if(isset($comand->involvedColor))
                                    <!---Color---->
                                    <div class="row">
                                        <div class="col l12 m12 s12">
                                            <h5>Culoare: <strong
                                                        style="width:20px; height:20px; display:inline-block; background:{{$comand->involvedColor->color_hash}};"></strong>
                                            </h5>
                                        </div>
                                    </div>
                                    <br>
                                    @endif
                                    <!--Cantitate-->
                                    <div class="row display_form_items_inline">
                                        <div class="col l12 m12 s12">
                                            <h5>Cantitate: <strong>{{$comand->count}}</strong></h5>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                    <div class="col l12 m12 s12">
                                        <h5>Suma: <del><span>{{$comand->specPrice->old_price}} {{$item->lot->currency->sign}}</span></del> / <strong>{{$comand->specPrice->new_price}} {{$item->lot->currency->sign}}</strong></h5>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--product_info-->
            </div>
        </div><!-- / container-->
    </section>
@endsection

