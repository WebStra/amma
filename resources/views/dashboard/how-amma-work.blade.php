@extends('layout')

@section('content')
    <section class="info_video_amma">
        <div class="container">
            <div class="row">
                @include('partials.dashboard.nav-bar')
                <div class="col l9 m7 s12">
                    <div class="row">
                        @foreach($video as $item)
                            <div class="col l6 m6 s12">
                                <iframe width="100%" height="315" src="{{$item->video}}"
                                        frameborder="0" allowfullscreen></iframe>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop