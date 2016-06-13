@extends('layout')

@section('breadcrumbs')
    <div class="container">
        <ul class="breadcrumbs">
            <li><a href="#" class="icon-home"></a></li>
            <li><a href="{{ route('view_blog') }}">Blog</a> \ {{ $item->present()->renderTitle() }}</li>
        </ul>
    </div>
@endsection

@section('content')
    <section class="">
        <div class="container">
            <div class="row">
                <div class="col l9 m12 s12">
                    <div class="articles">
                        <div class="article">
                            <h2 class="title">{{ $item->present()->renderTitle() }}</h2>
                            <p>
                                <span><i class="icon-clock"></i> Postat <span
                                            class="c_base">{{ $item->present()->renderPublishedDate() }}</span></span>
                                <span><i class="icon-watch"></i> Vizualizări  <span class="c_base">{{ $item->present()->renderPostViews() }}</span></span>
                            </p>
                            <div class="wrapp_img">
                                <img src="/assets/images/img3.jpg">
                            </div>
                            <div class="text">
                                {{ $item->body }}
                            </div>
                        </div>
                    </div>
                </div>
                <!--l9-->
                <div class="col l3 m12 s12">
                    <div class="bordered  elements aside">
                        <div class="block_title">ARTICOLE POPULARE</div>

                        @include('blog.partials.popular-sidebar')
                    </div>
                </div>
            </div>
            <div>
                <div id="fb-root"></div>

                <div class="fb-comments"
                     data-href="{{ Request::url() }}"
                     data-width="1154" data-numposts="3"></div>
            </div>
        </div><!-- / container-->
    </section>
@endsection

@section('js')
    <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.6&appId=907351076004785";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
@endsection