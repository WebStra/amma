@extends('layout')

@section('content')
    <section class="suport">
        {{--<img src="{{$page->image}}" class="wide_img">--}}
        <div class="container help-page">
            <div class="row content">
                <div class="col s2 m9 l2">
                    <ul class="collapsible" data-collapsible="accordion">
                        <li>
                            <div class="collapsible-header">Despre noi</div>
                                <div class="collapsible-body">
                                    <ul class="section table-of-contents">
                                    @foreach($helpPages as $item)
                                        @if($item->page_type == 0)
                                            <li><a href="#{{$item->slug}}">{{$item->title}}</a></li>
                                        @endif
                                     @endforeach
                                    </ul>
                                </div>
                        </li>
                        <li>
                            <div class="collapsible-header">Ajutor</div>
                                <div class="collapsible-body">
                                    <ul class="section table-of-contents">
                                        @foreach($helpPages as $item)
                                            @if($item->page_type == 1)
                                                <li><a href="#{{$item->slug}}">{{$item->title}}</a></li>
                                            @endif
                                         @endforeach
                                    </ul>
                                </div>
                        </li>
                        <li>
                            <div class="collapsible-header">Aspecte generale</div>
                                <div class="collapsible-body">
                                    <ul class="section table-of-contents">
                                        @foreach($helpPages as $item)
                                            @if($item->page_type == 2)
                                                <li><a href="#{{$item->slug}}">{{$item->title}}</a></li>
                                            @endif
                                         @endforeach
                                    </ul>
                                </div>
                        </li>
                    </ul>
                </div>
                <div class="col s10 m3 l10">
                    @foreach($helpPages as $item)
                        <div id="{{$item->slug}}" class="section scrollspy">
                            {!!$item->body!!}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    @include('pages.partials.js')
@endsection