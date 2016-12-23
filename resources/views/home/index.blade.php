@extends('layout')

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col l3 m4 s12 hide-on-small-only">
                    @include('partials.categories.l_sidebar')
                    <div class="elements divide-top">
                        <div class="title">{{ $meta->getMeta('products_recomendend') }}</div>
                        <ul class="collapsible items" data-collapsible="accordion">
                            <?php $i = 1; ?>
                            @foreach($recommended['data']() as $item)
                                @include('partials.products.recommended')
                                <?php $i++ ?>
                            @endforeach
                        </ul>
                    </div>

                    <div class="elements bordered mt-15  hide-on-small-only">
                        <div class="title">{{ $meta->getMeta('blogs_article_recomendend') }}</div>
                        <div class="owl-carousel l-single">
                            @foreach($posts['data']() as $item)
                                <div class="item article">
                                    <img src="{{ $item->present()->cover() }}">
                                    <h4 class="title">{{ $item->present()->renderTitle(true) }}</h4>
                                    {!!  $item->present()->renderShortDescription(175) !!}
                                    <a class="link" href="{{ route('view_post', ['slug' => $item->slug]) }}">
                                       {!! $meta->getMeta('blog_home_read') !!}  <i class="icon-arrow-to-right" style="font-size: initial; vertical-align: baseline"></i>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col l9 m8 s12">
                        <div class="row top_block">
                            @if($popular_category)
                                <div class="col l8 m12 s12">
                                    <a href="{{ route('view_category', ['category' => str_slug($popular_category->slug)]) }}" class="wrapp_img categorie img_hover_over">
                                        <div class="text">
                                            <h6>{{ $popular_category->present()->renderName(true) }}</h6>
                                            <h3>CATEGORIE POPULARĂ</h3>
                                        </div>
                                        <img src="{{ $popular_category->present()->cover() }}">
                                    </a>
                                </div>
                            @endif
                            <div class="col l4 hide-on-med-and-down">
                                <div class="elements">
                                    <div class="owl-carousel m-l-single">
                                        @foreach($expire['data'](5) as $item)
                                            @include('partials.products.item-block')
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @include('partials.banners.small')
                            @include('partials.banners.r_sidebar')
                        </div>


                        @if(isset($expire))
                            <?php $items = $expire['data']() ?>

                            @if(count($items))
                                <?php $name = $meta->getMeta('expire_soon') ?>

                                    @include('home.partials.carousel')
                            @endif
                        @endif

                        @include('partials.banners.wide')

                        @if(isset($popular))
                            <?php $items = $popular['data']() ?>

                            @if(count($items))
                                <?php $name = $popular['name'] ?>

                                @include('home.partials.carousel')
                            @endif
                        @endif

                    </div><!-- / top_block-->
            </div>

            @include('partials.banners.big')

            @if(isset($category_1))
                <?php $items = $category_1['data']() ?>

                @if(count($items))
                    <?php $name = $category_1['name'] ?>

                    @include('home.partials.carousel')
                @endif
            @endif

            @if(isset($category_2) && $category_2)
                <?php $items = $category_2['data']() ?>

                @if(count($items))
                    <?php $name = $category_2['name'] ?>

                    @include('home.partials.carousel')
                @endif
            @endif
            @if(isset($latest) && $latest)
                <?php $items = $latest['data']() ?>

                @if(count($items))
                    <?php $name = $meta->getMeta('products_latest_homepage') ?>

                    @include('home.partials.carousel')
                @endif
            @endif
        </div><!--container-->
    </div><!--content-->
@endsection