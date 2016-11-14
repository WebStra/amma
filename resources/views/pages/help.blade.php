@extends('layout')

@section('content')
    <section class="suport">
        {{--<img src="{{$page->image}}" class="wide_img">--}}
        <div class="container">
            <div class="row content">
                <div class="col s2 m9 l2">
                    <ul class="collapsible" data-collapsible="accordion">
                        <li>
                            <div class="collapsible-header">First</div>
                                <div class="collapsible-body">
                                    <ul class="section table-of-contents">
                                    <li><a href="#introduction">Introduction</a></li>
                                    <li><a href="#structure">Structure</a></li>
                                    <li><a href="#initialization">Intialization</a></li>
                                    </ul>
                                </div>
                        </li>
                        <li>
                            <div class="collapsible-header">Second</div>
                                <div class="collapsible-body">
                                    <ul class="section table-of-contents">
                                    <li><a href="#introduction">Introduction</a></li>
                                    <li><a href="#structure">Structure</a></li>
                                    <li><a href="#initialization">Intialization</a></li>
                                    </ul>
                                </div>
                        </li>
                        <li>
                            <div class="collapsible-header">Third</div>
                                <div class="collapsible-body">
                                    <ul class="section table-of-contents">
                                    <li><a href="#introduction">Introduction</a></li>
                                    <li><a href="#structure">Structure</a></li>
                                    <li><a href="#initialization">Intialization</a></li>
                                    </ul>
                                </div>
                        </li>
                    </ul>
                </div>
                <div class="col s10 m3 l10">
                    @foreach($helpPages as $item)
                        <div id="initialization" class="section scrollspy">
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