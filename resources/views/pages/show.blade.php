@extends('layout')

@section('content')
    <section class="suport">
        <div class="container">
            <h1>{{$item->title}}</h1>
        </div>
        {{--<img src="{{$page->image}}" class="wide_img">--}}
        <div class="container">
            <div class="row content">
                <div class="col l12">
                    {!!$item->body!!}
                </div>
            </div>
        </div>
    </section>
@endsection