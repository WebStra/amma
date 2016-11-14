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
                            
                        </li>
                        <li>
                            <div class="collapsible-header">Second</div>
                            <div class="collapsible-body"><p>Lorem ipsum dolor sit amet.</p></div>
                        </li>
                        <li>
                            <div class="collapsible-header">Third</div>
                            <div class="collapsible-body"><p>Lorem ipsum dolor sit amet.</p></div>
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