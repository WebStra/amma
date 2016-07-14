@extends('layout')

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
                                <img src="{{ $item->present()->cover(null, '/assets/images/img3.jpg') }}" width="870" height="473">
                            </div>
                            <div class="text">
                                {!! $item->body !!}
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

            @include('partials.fb-comments' )

        </div><!-- / container-->
    </section>
@endsection