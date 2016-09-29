@extends('layout')

@section('content')
    @include('blog.partials.subscribe_form')

    <section class="produs">
        <div class="container">
            <div class="row">
                <div class="col l9 m12 s12">
                    <div class="articles">
                        @foreach($posts as $item)
                            @include('blog.partials.big-block')
                        @endforeach
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

            <div class="row">
                <div class="col l9 m12 s12">
                    <div class="paginate_container">
                        <div class="paginate_render">
                            {!! $posts->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- / container-->
    </section>
@endsection