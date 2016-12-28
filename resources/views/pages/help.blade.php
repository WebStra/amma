@extends('layout')

@section('content')
    <section class="suport">
        {{--<img src="{{$page->image}}" class="wide_img">--}}
        <div class="container help-page">
            <div class="row content">
                <div class="col l3">
                    <ul class="collapsible" data-collapsible="accordion">
                        <li>
                            <div class="collapsible-header">Despre noi</div>
                                <div class="collapsible-body">
                                    <ul class="section table-of-contents">
                                    @foreach($helpPages as $item)
                                        @if($item->page_type == 1)
                                            <li><a class="go-to" data-go-to="{{$item->slug}}" href="#{{$item->slug}}">{{$item->title}}</a></li>
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
                                            @if($item->page_type == 2)
                                                <li><a class="go-to" data-go-to="{{$item->slug}}" href="#{{$item->slug}}">{{$item->title}}</a></li>
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
                                            @if($item->page_type == 3)
                                                <li><a class="go-to" data-go-to="{{$item->slug}}" href="#{{$item->slug}}">{{$item->title}}</a></li>
                                            @endif
                                         @endforeach
                                    </ul>
                                </div>
                        </li>
                    </ul>
                </div>
                <div class="col l8">
                    @foreach($helpPages as $item)
                            <div id="{{$item->slug}}" class="section">
                                {!!$item->body!!}
                            </div>
                    @endforeach
                </div>
                <div class="col l1"></div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    @include('pages.partials.js')
@endsection